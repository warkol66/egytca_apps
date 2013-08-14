<?php
class SmartyActionDispatcher extends ActionDispatcher {
	function SmartyActionDispatcher($uri = '', $wrapper = '', $servletPath = '', $pathInfo = '', $queryString = '', $name = '') {   		parent::ActionDispatcher($uri = '', $wrapper = '', $servletPath = '', $pathInfo = '', $queryString = '', $name = '');
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isInfoEnabled', False);
		$this -> log -> setLog('isTraceEnabled', False);
	}
	function serviceResponse(&$request, &$response) {  		$debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace)
			$this -> log -> trace('Start: OOHFormsActionDispatcher->serviceResponse(..)[' . __LINE__ . ']');
		$as = &$this -> getActionServer();
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = &$as -> getPlugIn($plugInKey);
		if ($smarty == NULL) { 			echo 'No PlugIn found matching key: ' . $plugInKey . "<br>\n";
		}  		$requestURI = $this -> uri;
		$pageBuff = '';
		ob_start();
		$smarty -> display($requestURI);
		$pageBuff = ob_get_contents();
		ob_end_clean();
		$response -> setResponseBuffer($pageBuff);
	}

}
?>
