<?php
class RequestUtils {
	var $log = NULL;
	var $PREFIXES_KEY = "PREFIXES";
	function RequestUtils() { $this -> log = new PhpMVC_Log();
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isInfoEnabled', False);
		$this -> log -> setLog('isTraceEnabled', False);
	}
	function classLoader($className) { $debug = $this -> log -> getLog('isDebugEnabled');
		$classFileName = $className . '.php';
		if ($debug) { $this -> log -> debug("  RequestUtils->classLoader()[" . __LINE__ . "]: Loading class file '" . $classFileName . "'");
		}
		if (!class_exists($className)) {
			include_once $classFileName;
		} $oClass = new $className;
		return $oClass;
	}
	function createActionForm($request, $mapping, $appConfig, $actionServer) { $log_trace = $this -> log -> getLog('isTraceEnabled');
		$attribute = $mapping -> getAttribute();
		if ($attribute == NULL) {
		} $name = $mapping -> getName();
		$config = $appConfig -> findFormBeanConfig($name);
		if ($config == NULL) {
			return NULL;
		} $controllerCfg = $appConfig -> getControllerConfig();
		$debug = $controllerCfg -> getDebug();
		if ($debug >= 2) {
		} $instance = NULL;
		$session = NULL;
		if ('request' == $mapping -> getScope()) {
		} else {
		}
		if ($instance != NULL) {
			if ($config -> getDynamic()) { $className = '';
				$actionForm = NULL;
				$actionForm = $instance -> getDynaClass();
				$className = $actionForm -> getName();
				if ($className == $config -> getName()) { $controllerConfig = $appConfig . getControllerConfig();
					if ($controllerConfig -> getDebug() >= 2) {
					}
					return $instance;
				}
			} else { $className = $instance -> getName();
				if ($className == $config -> getType()) {
					if ($controllerConfig -> getDebug() >= 2) {
					}
					return $instance;
				}
			}
		}
		if ($config -> getDynamic()) { $dynaClass = DynaActionFormClass::createDynaActionFormClass($config);
			$instance = $dynaClass -> newInstance();
		} else { $actionForm = $config -> getType();
			$instance = $this -> classLoader($actionForm);
		}
		if ($log_trace) { $this -> log -> trace("RequestUtils->createActionForm()[" . __LINE__ . "]: ActionForm:  '" . $actionForm . "' extends " . "'" . get_parent_class($actionForm) . "'");
		} $instance -> setActionServer($actionServer);
		$instance -> reset($mapping, $request);
		return $instance;
	}
	function populate(&$bean, $prefix, $suffix, $request) { $properties = array();
		$names = NULL;
		$multipartElements = NULL;
		$contentType = $request -> getContentType();
		$method = strtoupper($request -> getMethod());
		$isMultipart = False;
		$multiPart = False;
		if (ereg("^multipart/form-data", $contentType)) { $multiPart = True;
		}
		if (($contentType != NULL) && ($multiPart == True) && ($method == 'POST')) { $multipartHandler = NULL;
			if ($multipartHandler != NULL) { $isMultipart = True;
			} $request -> removeAttribute(Action::getKey('MAPPING_KEY'));
		}
		if (!$isMultipart) { $names = $request -> getParameterNames();
		}
		foreach ($names as $name) {
		}
		if ($method == 'GET') { $properties = $request -> getGetVars();
		} elseif ($method == 'POST') { $getProperties = $request -> getGetVars();
			$postProperties = $request -> getPostVars();
			$properties = array_merge($getProperties, $postProperties);
		}
		$beanUtils = new PhpBeanUtils;
		$beanUtils -> populate($bean, $properties);
	}
	function getMultipartHandler($request, $actionServer) {
	}
	function requestURL($request) {
	}
	function serverURL($request) {
	}
	function selectApplication(&$request, $context) { $matchPath = $request -> getAppServerPath();
		$prefix = '';
		$prefixes = $this -> getApplicationPrefixes($context);
		if ($prefixes != NULL) {
			foreach ($prefixes as $prefixVal) {
				if (ereg("^$prefixVal", $matchPath)) { $prefix = $prefixVal;
					break;
				}
			}
		} $config = $context -> getAttribute(Action::getKey('APPLICATION_KEY') . $prefix);
		if ($config != NULL)
			$request -> setAttribute(Action::getKey('APPLICATION_KEY'), $config);
		$resources = $context -> getAttribute(Action::getKey('MESSAGES_KEY') . $prefix);
		if ($resources != NULL)
			$request -> setAttribute(Action::getKey('MESSAGES_KEY'), $resources);
	}
	function getApplicationPrefixes($context) {
		return NULL;
	}

}
