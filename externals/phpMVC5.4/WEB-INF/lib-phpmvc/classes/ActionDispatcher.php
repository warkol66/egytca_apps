<?php
class ActionDispatcher {
	var $appRequest = NULL;
	var $appResponse = NULL;
	var $context = NULL;
	var $debug = 0;
	var $including = False;
	var $info = 'phpmvc.ApplicationDispatcher/1.0';
	var $name = NULL;
	var $pathInfo = NULL;
	var $queryString = NULL;
	var $appServerPath = NULL;
	var $log = NULL;
	var $uri = NULL;
	var $actionServer = NULL;
	function getInfo() {
		return $this -> info;
	}
	function & getActionServer() {
		return $this -> actionServer;
	}
	function setActionServer(&$actionServer) { $this -> actionServer = &$actionServer;
	}
	function ActionDispatcher($uri = '', $wrapper = '', $servletPath = '', $pathInfo = '', $queryString = '', $name = '') { $this -> log = new PhpMVC_Log();
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isInfoEnabled', False);
		$this -> log -> setLog('isTraceEnabled', False);
		$this -> uri = $uri;
		$this -> wrapper = $wrapper;
		$this -> servletPath = $servletPath;
		$this -> pathInfo = $pathInfo;
		$this -> queryString = $queryString;
		$this -> name = $name;
		$debug = $this -> log -> getLog('isDebugEnabled');
		if ($debug) { $this -> log -> debug('ActionDispatcher::Constructor(' . 'uri=' . $this -> uri . ', servletPath=' . $this -> servletPath . ', pathInfo=' . $this -> pathInfo . ', queryString=' . $this -> queryString . ', name=' . $this -> name . ')');
		}
	}
	function forward($uri, &$request, &$response) { $debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace)
			$this -> log -> trace('Start: ActionDispatcher->forward(..)[' . __LINE__ . ']');
		$this -> uri = $uri;
		if ($response -> isCommitted()) {
			if ($debug) { $this -> log -> debug('  Forward on committed response --> ' . 'IllegalStateException');
				return 'IllegalStateException';
			} $e = $response -> resetBuffer();
			if ($e != NULL) {
				if ($debug)
					$this -> log -> debug('  Forward resetBuffer()' . ' returned IllegalStateException: ' . $e);
				return $e;
			}
		} $this -> setup($request, $response, False);
		$hrequest = NULL;
		if (is_subclass_of($request, 'HttpRequestBase'))
			$hrequest = $request;
		$hresponse = NULL;
		if (is_subclass_of($response, 'HttpResponseBase')) { $hresponse = $response;
		}
		if (($hrequest == NULL) || ($hresponse == NULL)) {
			if ($debug)
				$this -> log -> debug(' Non-HTTP Forward');
			$this -> invoke($request, $response);
		} elseif (($this -> $appServerPath == NULL) && ($this -> pathInfo == NULL)) {
			if ($debug)
				$this -> log -> debug(' Named Dispatcher Forward');
			$this -> invoke($request, $response);
		} else {
			if (debug)
				$this -> log -> debug(' HTTP Path Based Forward');
			$this -> invoke($outerRequest, $response);
		}
		if ($debug)
			$this -> log -> debug(' Committing and closing response');
		$respBuff = $response -> getResponseBuffer();
		$mode = '';
		if ($mode == 'smtp') {
		} else {; echo $respBuff;
		}
	}
	function invoke(&$request, &$response) { $debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace)
			$this -> log -> trace('Start: ActionDispatcher->invoke(..)[' . __LINE__ . ']');
		$servlet = NULL;
		$ioException = NULL;
		$servletException = NULL;
		$runtimeException = NULL;
		if ((is_subclass_of($request, 'HttpRequestBase')) && (is_subclass_of($response, 'HttpResponseBase'))) {
			if ($debug)
				$this -> log -> debug('  Calling HTTP-specific $this->serviceResponse() (' . $this -> uri . ')');
			$this -> serviceResponse($request, $response);
		} else {
			if ($debug)
				$this -> log -> debug('  Calling Non-HTTP-specific $this->serviceResponse() (' . $this -> uri . ')');
			$this -> serviceResponse($request, $response);
		}
	}
	function serviceResponse(&$request, &$response) { $debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace)
			$this -> log -> trace('Start: ActionDispatcher->serviceResponse(..)[' . __LINE__ . ']');
		$resourceURI = $this -> uri;
		$firstChar = substr($resourceURI, 0, 1);
		if ($firstChar == '/' || $firstChar == '\\') { $resourceURI = substr($resourceURI, 1);
		} $form = $request -> getAttribute(Action::getKey('FORM_BEAN_KEY'));
		$errors = $request -> getAttribute(Action::getKey('ERROR_KEY'));
		$data = $request -> getAttribute(Action::getKey('VALUE_OBJECT_KEY'));
		$appConfig = NULL;
		$appConfig = $request -> getAttribute(Action::getKey('APPLICATION_KEY'));
		$viewConfig = NULL;
		$viewConfig = &$appConfig -> getViewResourcesConfig();
		$pageBuff = '';
		ob_start();
		include $resourceURI;
		$pageBuff = ob_get_contents();
		ob_end_clean();
		$response -> setResponseBuffer($pageBuff);
	}
	function setup($request, $response, $including) { $this -> appRequest = $request;
		$this -> appResponse = $response;
		$this -> including = $including;
	}
	function unwrapRequest() {
	}
	function unwrapResponse() {
	}
	function wrapRequest() {
	}
	function wrapResponse() {
	}

}
?>
