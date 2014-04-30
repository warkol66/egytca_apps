<?php

class AutoProcessor {
	
	private static $queueDir;
	
	static function init() {
		self::$queueDir = __DIR__.'/queue';
	}
	
	static function putInQueue($script, $data, $filename) {
		
		if (is_null($filename))
			$filename = uniqid('auto-');
		
		$fullFilename = self::$queueDir."/$filename";
		
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

AutoProcessor::init();
