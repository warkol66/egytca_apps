<?php

class QueueManager {
	
	private $queueDir;
	
	public function __construct() {
		$configData = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'config.ini');
		preg_match("/(^|\n)queue=([^\n]*)(\n|$)/", $configData, $matches);
		$this->queueDir = __DIR__.'/'.$matches[2];
	}
	
	function putInQueue($script, $data, $filename) {
		
		if (is_null($filename))
			$filename = uniqid('auto-');
		
		$fullFilename = $this->queueDir."/$filename";
		
		if (!file_exists($script))
			throw new Exception("$script not found.");
		
		$fileData = array(
			'script' => realpath($script),
			'data' => $data
		);
		
		file_put_contents($fullFilename, serialize($fileData));
		
		if (!file_exists($fullFilename))
			throw new Exception("No se pudo escribir $fullFilename. Verifique la configuraci&oacute;n de permisos.");
	}
}
