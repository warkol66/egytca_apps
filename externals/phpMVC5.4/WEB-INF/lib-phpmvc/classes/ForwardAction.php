<?php
class ForwardAction extends Action {
	var $log = NULL;
	function ForwardAction() { $this -> log = new PhpMVC_Log();
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isInfoEnabled', False);
		$this -> log -> setLog('isTraceEnabled', False);
	}
	function execute($mapping, $form, $request, $response) { $debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { $this -> log -> trace('Start: ForwardAction->execute(...)' . '[' . __LINE__ . ']');
		} $path = $mapping -> getParameter();
		if ($path == NULL) {
			return NULL;
		} $appServerContext = $this -> actionServer -> appServerConfig -> getAppServerContext();
		$actionDispatcher = $appServerContext -> getInitParameter('ACTION_DISPATCHER');
		$ad = new $actionDispatcher;
		if ($ad == NULL) {
			return;
		} $ad -> setActionServer($this -> actionServer);
		$ad -> forward($path, $request, $response);
		return NULL;
	}

}
?>
