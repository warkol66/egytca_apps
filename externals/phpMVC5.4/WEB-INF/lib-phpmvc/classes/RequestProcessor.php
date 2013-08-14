<?php
class RequestProcessor {
	var $INCLUDE_PATH_INFO = 'phpmvc.appserver.include.path_info';
	var $INCLUDE_APPSERVER_PATH = 'phpmvc.appserver.include.appserver_path';
	var $actions = array();
	var $appConfig = NULL;
	var $log = NULL;
	var $actionServer = NULL;
	function RequestProcessor() {  		$this -> log = new PhpMVC_Log();
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isInfoEnabled', False);
		$this -> log -> setLog('isTraceEnabled', False);
	}
	function destroy() {  		$actions = array_keys($this -> actions);
		foreach ($actions as $action) { 			$action -> setActionServer(NULL);
		} 		$this -> actions = array();
		$this -> actionServer = NULL;
	}
	function init(&$actionServer, &$appConfig) {  		$this -> actions = array();
		$this -> actionServer = &$actionServer;
		$this -> appConfig = &$appConfig;
	}
	function process($request, $response) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->process(...)' . '[' . __LINE__ . ']');
		}   		$shutdown = False;
		while (!$shutdown) {  			$path = $this -> processPath($request, $response);
			if ($debug) { 				$this -> log -> debug("RequestProcessor->process()[" . __LINE__ . "]: Processing a '" . $request -> getMethod() . "' request for path '" . $path . "'");
			}  			$this -> processContent($request, $response);
			$this -> processNoCache($request, $response);
			if (!$this -> processPreprocess($request, $response, $path)) {
				return;
			}  			$mapping = $this -> processMapping($request, $response, $path);
			if ($mapping == NULL) {
				return;
			}
			if (!$this -> processRoles($request, $response, $mapping)) {
				return;
			}  			$form = $this -> processActionForm($request, $response, $mapping);
			$this -> processPopulate($request, $response, $form, $mapping);
			if (!$this -> processValidate($request, $response, $form, $mapping)) {
				return;
			}
			if (!$this -> processForward($request, $response, $mapping)) {
				return;
			}
			if (!$this -> processInclude($request, $response, $mapping)) {
				return;
			}  			$action = $this -> processActionCreate($request, $response, $mapping);
			if ($action == NULL) {
				return;
			}  			$forward = $this -> processActionPerform($request, $response, $action, $form, $mapping);
			$shutdown = $this -> processActionChain($request, $forward);
			$this -> processActionForward($request, $response, $forward);
		}
	}
	function processActionCreate($request, $response, $mapping) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->processActionCreate(...)' . '[' . __LINE__ . ']');
		}  		$className = $mapping -> getType();
		if ($debug) { 			$this -> log -> debug(" Looking for Action instance for class '" . $className . "'");
		}  		$instance = NULL;
		if (array_key_exists($className, $this -> actions))
			$instance = $this -> actions[$className];
		if ($instance != NULL) {
			if ($trace) { 				$this -> log -> trace("  Returning existing Action instance");
			}
			return $instance;
		}
		if ($trace) { 			$this -> log -> trace("  Creating new Action instance '" . $className . "'");
		}  		$requestUtils = new RequestUtils;
		$instance = $requestUtils -> classLoader($className);
		$instance -> setActionServer($this -> actionServer);
		$this -> actions['className'] = &$instance;
		return $instance;
	}
	function processActionForm($request, $response, $mapping) {  		$requestUtils = new RequestUtils;
		$instance = $requestUtils -> createActionForm($request, $mapping, $this -> appConfig, $this -> actionServer);
		if ($instance == NULL) {
			return NULL;
		}  		$debug = $this -> log -> getLog('isDebugEnabled');
		if ($debug) { 			$this -> log -> debug(" Storing ActionForm bean instance in scope '" . $mapping -> getScope() . "' under attribute key '" . $mapping -> getAttribute() . "'");
		}
		if ('request' == $mapping -> getScope()) { 			$request -> setAttribute($mapping -> getAttribute(), $instance);
		} else {
		}
		return $instance;
	}
	function processActionForward(&$request, &$response, $forward) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->processActionForward(...)' . '[' . __LINE__ . ']');
		}
		if ($forward == NULL) {
			return;
		}  		$path = $forward -> getPath();
		if ($path == NULL) {
			return;
		}
		if (strtolower($forward -> getRedirect()) == True) {  			$host = $_SERVER['HTTP_HOST'];
			if (substr($path, 0, 1) == '/') {
				if ($forward -> getContextRelative()) { 					$path = $request -> getContextPath() . $path;
				} else { 					$path = $request -> getContextPath() . $this -> appConfig -> getPrefix() . $path;
				}
			}  			$pathScheme = '';
			$scheme = '';
			if (is_array($_SERVER)) { 				$scheme = (@$_SERVER['HTTPS'] == 'on' ? 'https' : 'http');
			} elseif (is_array($HTTP_SERVER_VARS)) { 				$scheme = (@$HTTP_SERVER_VARS['HTTPS'] == 'on' ? 'https' : 'http');
			} else { 				$scheme = 'http';
			}
			if (!preg_match("/^([a-z]+):\/\//i", $path)) {
				if ($scheme == 'http' || $scheme == 'https' || $scheme == 'ftp') { 					$pathScheme = $scheme . '://';
				}
				if (substr($path, 0, 1) != '/') { 					$path = "/" . $path;
				}  				$redirPath = $pathScheme . $host . $path;
			} else {  				$redirPath = $path;
			}  			header("Location: $redirPath");
			exit ;
		} else {  			$leadingPathSlash = False;
			if (substr($path, 0, 1) == '/') { 				$leadingPathSlash = True;
			}
			if ($leadingPathSlash && !$forward -> getContextRelative()) { 				$path = $this -> appConfig -> getPrefix() . $path;
			}  			$this -> doForward($path, $request, $response);
		}
	}
	function processActionPerform(&$request, &$response, $action, $form, $mapping) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->processActionPerform(...)' . '[' . __LINE__ . ']');
		}   		$actionForward = NULL;
		$actionForward = $action -> execute($mapping, $form, $request, $response);
		if ($actionForward == NULL) {
			return NULL;
		}
		return $actionForward;
	}
	function processActionChain(&$request, $forward) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->processActionChain(...)' . '[' . __LINE__ . ']');
		}
		if ($forward == NULL) {
			return True;
		}  		$nextActionPath = '';
		$nextActionPath = $forward -> getNextActionPath();
		if ($nextActionPath == '') {
			return True;
		} else { 			$request -> setAttribute('ACTION_DO_PATH', $nextActionPath);
			return False;
		}
	}
	function processContent($request, $response) {  		$controllerConfig = $this -> appConfig -> getControllerConfig();
		$contentType = $controllerConfig -> getContentType();
		if ($contentType != NULL) { 			$response -> setContentType($contentType);
		}
	}
	function processForward($request, $response, $mapping) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->processForward(...)' . '[' . __LINE__ . ']');
		}   		$forward = $mapping -> getForward();
		if ($forward == NULL) {
			return True;
		}
		if (is_a($request, 'MultipartRequestWrapper')) {	 			$request = $request -> getRequest();
		}  		$uri = $this -> appConfig -> getPrefix() . $forward;
		if ($debug) { 			$this -> log -> debug(" Delegating via forward to '" . $uri . "'");
		}  		$this -> doForward($uri, $request, $response);
		return False;
	}
	function processInclude($request, $response, $mapping) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$include = $mapping -> getInclude();
		if ($include == NULL) {
			return True;
		}
		if (is_a($request, 'MultipartRequestWrapper')) {	 			$request = $request -> getRequest();
		}  		$uri = $this -> appConfig -> getPrefix() . $include;
		if ($debug) { 			$this -> log -> debug(" Delegating via include to '" . $uri + "'");
		}  		$this -> doInclude($uri, $request, $response);
		return False;
	}
	function processMapping($request, $response, $path) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->processMapping(...)' . '[' . __LINE__ . ']');
		}  		$mapping = $this -> appConfig -> findActionConfig($path);
		if ($mapping != NULL) { 			$request -> setAttribute(Action::getKey('MAPPING_KEY'), $mapping);
			return $mapping;
		} 		 		$match = preg_split("/[A-Z]/", $path);
		if (count($match) > 1) { 			$module = $match[0];
			global $moduleRootDir;
			$expectedFile = $moduleRootDir . "WEB-INF/classes/modules/" . $module . "/actions/" . ucwords($path) . "Action.php";
			if (file_exists($expectedFile)) {  				$newActionConfig = new ActionConfig();
				$newActionConfig -> setName($path);
				$newActionConfig -> setPath($path);
				$newActionConfig -> setType(ucwords($path) . "Action");
				$forwardsRules = array();
				$forwardsRules["DoEdit"] = array();
				$forwardsRules["DoEdit"]["success"] = "/Main.php?do=MODULEList&message=ok";
				$forwardsRules["DoEdit"]["success-add"] = "/Main.php?do=MODULEEdit&message=ok";
				$forwardsRules["DoEdit"]["success-edit"] = "/Main.php?do=MODULEEdit&message=ok";
				$forwardsRules["DoEdit"]["failure"] = "MODULEEdit.tpl";
				$forwardsRules["DoEdit"]["failure-edit"] = "MODULEEdit.tpl";
				$forwardsRules["DoEdit"]["failure-error"] = "Error.tpl";
				$forwardsRules["DoEdit"]["failure-list"] = "/Main.php?do=MODULEList&message=not_edited";
				$forwardsRules["DoDelete"] = array();
				$forwardsRules["DoDelete"]["success"] = "/Main.php?do=MODULEList&message=deleted_ok";
				$forwardsRules["DoDelete"]["failure"] = "/Main.php?do=MODULEList&message=not_deleted";
				$action = str_replace($module, "", $path);
				$forwards = false;
				$moduleSection = "";
				function strstrb($h, $n) {
					return array_shift(explode($n, $h, 2));
				}

				foreach ($forwardsRules as $key => $rules) {
					if (preg_match("/" . $key . "$/", $action)) { 						$forwards = $rules;
						$moduleSection = strstrb($action, $key);
					}
				}
				if (!empty($forwards)) {
					foreach ($forwards as $forwardName => $forwardPath) { 						$forwardObject = new ForwardConfig();
						$forwardObject -> setName($forwardName);
						if (substr($forwardPath, strlen($forwardPath) - 3) != "tpl") { 							$forwardObject -> setRedirect(true);
							$moduleForPath = $module . $moduleSection;
						} else { 							$moduleForPath = ucwords($module) . $moduleSection;
						} 							 						$forwardObject -> setPath(str_replace("MODULE", $moduleForPath, $forwardPath));
						$newActionConfig -> addForwardConfig($forwardObject);
					}
				} else { 					$successForward = new ForwardConfig();
					$successForward -> setName("success");
					$successForward -> setPath(ucwords($path) . ".tpl");
					$newActionConfig -> addForwardConfig($successForward);
					$successForward = new ForwardConfig();
					$successForward -> setName("failure");
					$successForward -> setPath("Error.tpl");
					$newActionConfig -> addForwardConfig($successForward);
				} 				 				$this -> appConfig -> addActionConfig($newActionConfig);
				$mapping = $this -> appConfig -> findActionConfig($path);
				return $mapping;
			}
		} 		 		$configs = NULL;
		$configs = $this -> appConfig -> findActionConfigs();
		if ($configs != NULL) {
			foreach ($configs as $config) {
				if ($config -> getUnknown() === True) { 					$mapping = $config;
					$request -> setAttribute(Action::getKey('MAPPING_KEY'), $mapping);
					return $mapping;
				}
			}
		}   		$this -> log -> error("RequestProcessor->processMapping()[" . __LINE__ . "]: Invalid path '$path' was requested");
		return NULL;
	}
	function processMultipart($request) {
		if ('POST' != $request -> getMethod()) {
			return $request;
		}  		$contentType = $request -> getContentType();
		$multiPart = False;
		if (ereg("^multipart/form-data", $contentType))
			$multiPart = True;
		if (($contentType != NULL) && ($multiPart == True)) { 			$multiPartWrapper = new MultipartRequestWrapper($request);
			return $multiPartWrapper;
		} else {
			return $request;
		}
	}
	function processNoCache($request, $response) {  		$controllerConfig = $this -> appConfig -> getControllerConfig();
		if ($controllerConfig -> getNocache()) { 			$response -> setHeader("Pragma", "No-cache");
			$response -> setHeader("Cache-Control", "no-cache");
			$response -> setDateHeader("Expires", 1);
		}
	}
	function processPath(&$request, &$response) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->processPath(...)' . '[' . __LINE__ . ']');
		}  		$path = NULL;
		$path = $request -> getAttribute('INCLUDE_PATH_INFO');
		if ($path == NULL) { 			$path = $request -> getPathInfo();
		}
		if (($path != NULL) && (strlen($path) > 0)) {
			return $path;
		}  		$path = $request -> getAttribute('INCLUDE_APPSERVER_PATH');
		if ($path == NULL) { 			$path = $request -> getAppServerPath();
		}  		$prefix = $this -> appConfig -> getPrefix();
		if (!preg_match("/^$prefix/", $path)) {
			return NULL;
		}  		$path = substr($path, strlen($prefix));
		$slash = $period = 0;
		$slash = strrpos($path, '/');
		$period = strrpos($path, '.');
		if (($period >= 0) && ($period > $slash)) { 			$path = substr($path, 0, $period);
		}   		$path = $request -> getAttribute('ACTION_DO_PATH');
		if ($path != '') {
			if ($trace)
				$this -> log -> debug('  RequestProcessor->processPath(...)' . 'Found an Action path "' . $path . '" for this request' . '[' . __LINE__ . ']');
		} else {
			return NULL;
		}
		return $path;
	}
	function processPopulate($request, $response, &$form, $mapping) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->processPopulate(...)' . '[' . __LINE__ . ']');
		}
		if ($form == NULL) {
			return;
		}
		if ($debug) { 			$this -> log -> debug(" Populating bean properties from this request");
		}  		$form -> reset($mapping, $request);
		if ($mapping -> getMultipartClass() != NULL) { 			$request -> setAttribute(Action::getKey('MULTIPART_KEY'), $mapping -> getMultipartClass());
		}  		RequestUtils::populate($form, $mapping -> getPrefix(), $mapping -> getSuffix(), $request);
		$form -> setActionServer($this -> actionServer);
	}
	function processPreprocess(&$request, &$response, &$path) {
		return True;
	}
	function processRoles($request, $response, $mapping) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$roles = NULL;
		$roles = $mapping -> getRoleNames();
		if (($roles == NULL) || (count($roles) < 1)) {
			return True;
		}  		$appServerContext = &$this -> actionServer -> appServerConfig -> getAppServerContext();
		if ($request -> getUserPrincipal() == Null) { 			$oPrincipal = AuthenticatorBase::invoke($request, $response, $appServerContext);
			$request -> setUserPrincipal($oPrincipal);
			if ($oPrincipal == Null) {
				if ($debug) { 					$this -> log -> debug(" Failed to create a Principal for user '" . $request -> getRemoteUser() . "'");
				}
				return False;
			}
		}  		$oRealm = $appServerContext -> getRealm();
		foreach ($roles as $role) {
			if ($request -> isUserInRole($role, $oRealm)) {
				if ($debug) { 					$this -> log -> debug(" User '" . $request -> getRemoteUser() . "' has role '" . $role . "', granting access");
				}
				return True;
			}
		}
		if ($debug) { 			$this -> log -> debug(" User '" . $request -> getRemoteUser() . "' does not have any required role, denying access");
		}
		return False;
	}
	function processValidate(&$request, &$response, &$form, &$mapping) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->processValidate(...)' . '[' . __LINE__ . ']');
		}
		if ($form == NULL) {
			return True;
		}
		if (($request -> getParameter('CANCEL_PROPERTY') != NULL) || ($request -> getParameter('CANCEL_PROPERTY_X') != NULL)) {
			if ($debug) { 				$this -> log -> debug(" Cancelled transaction, skipping validation");
			}
			return True;
		}
		if ($mapping -> getValidate() == False) {
			return True;
		}
		if ($debug) { 			$this -> log -> debug(" Validating input form properties");
		}    		$errors = NULL;
		$errors = $form -> validate($mapping, $request);
		$errorsEmpty = True;
		if (is_object($errors)) { 			$errorsEmpty = $errors -> isEmpty();
		}
		if ($errors == NULL || $errorsEmpty) {
			if ($trace) { 				$this -> log -> trace("  No errors detected, accepting input");
			}
			return True;
		}
		if ($form -> getMultipartRequestHandler() != NULL) {
			if ($trace) { 				$this -> log -> trace("  Rolling back multipart request");
			}  			$mpReqHandler = $form -> getMultipartRequestHandler();
			$mpReqHandler -> rollback();
		}  		$input = $mapping -> getInput();
		if ($input == NULL) {
			if ($trace) { 				$this -> log -> trace("  Validation failed but no input form available");
			}
			return False;
		}
		if ($debug) { 			$this -> log -> debug(" Validation failed, returning to '" . $input . "'");
		}  		$request -> setAttribute(Action::getKey('FORM_BEAN_KEY'), $form);
		$request -> setAttribute(Action::getKey('ERROR_KEY'), $errors);
		if (get_class($request) == 'MultipartRequestWrapper') { 			$request = $request -> getRequest();
		}  		$uri = $input;
		$this -> doForward($uri, $request, $response);
		return False;
	}
	function doForward($uri, &$request, &$response) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { 			$this -> log -> trace('Start: RequestProcessor->doForward(...)' . '[' . __LINE__ . ']');
		}  		$appServerContext = $this -> actionServer -> appServerConfig -> getAppServerContext();
		$actionDispatcher = $appServerContext -> getInitParameter('ACTION_DISPATCHER');
		$ad = new $actionDispatcher;
		if ($ad == NULL) {
			return;
		}  		$ad -> setActionServer($this -> actionServer);
		$ad -> forward($uri, $request, $response);
	}
	function doInclude($uri, $request, $response) {  		$appServerContext = $this -> actionServer -> appServerConfig -> getAppServerContext();
		$rd = $appServerContext -> getRequestDispatcher($uri);
		if ($rd == NULL) {
			return;
		}  		$rd -> include($request, $response);
	}
	function getDebug() {
		return $this -> actionServer -> getDebug();
	}
	function getInternal() {
		return $this -> actionServer -> getInternal();
	}
	function getServletContext() {  		$appServerContext = $this -> actionServer -> appServerConfig -> getAppServerContext();
		return $appServerContext;
	}
	function log($message, $exception = '') {          $actionServer -> log($message, $exception);
	}

}
?>
