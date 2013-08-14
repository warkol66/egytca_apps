<?php
class HttpAppServer {
	var $log = NULL;
	function HttpAppServer() { $this -> log = new PhpMVC_Log();
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isInfoEnabled', False);
		$this -> log -> setLog('isTraceEnabled', False);
	}
	function doGet($request, $response) {
	}
	function doPost($request, $response) {
	}
	function service($request, $response) { $debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace)
			$this -> log -> trace('Start: HttpAppServer->service(..)');
	}

}
