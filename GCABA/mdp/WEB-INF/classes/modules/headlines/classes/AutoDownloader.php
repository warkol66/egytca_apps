<?php

//throw new Exception('renombrar');
//
//throw new Exception('deharcodear');
//require_once 'WEB-INF/lib-phpmvc/AutoProcessor/AutoProcessor.php';
//
//throw new Exception('renombrar putInQueue2 a putInQueue y eliminar la vieja cuando este listo');

class AutoDownloader {
	
	public function putInQueue2($attachment, $mustResample = false) {
		$url = $attachment->getUrl();
		$outputFile = $attachment->getRealpath();
		$id = $attachment->getId();
		
		if (is_null($outputFile))
			$outputFile = 'autonamed-'.uniqid();
		
		$data = array(
			'id' => $id,
			'url' => $url,
			'outputFile' => $outputFile,
			'mustResample' => $mustResample
		);
		
		throw new Exception('deharcodear');
		AutoProcessor::putInQueue('WEB-INF/lib-phpmvc/AutoProcessor/test-process.php', $data);
	}
	
	public function putInQueue($attachment, $mustResample = false) {
		
		$url = $attachment->getUrl();
		$outputFile = $attachment->getRealpath();
		$id = $attachment->getId();
		
		if (is_null($outputFile))
			$outputFile = 'autonamed-'.uniqid();
		
		$content = "url=$url\n"."output=$outputFile\n";
		$content .= "mustResample=" . ($mustResample ? "1" : "0") . "\nid=$id";
		
		$queueParentDir = './WEB-INF/classes/modules/headlines/classes/autodwnlder';
		
		$queueDir = $queueParentDir . '/' . 'queue';
		if (!file_exists($queueDir)) {
			if (Common::isWritable($queueParentDir))
				mkdir($queueDir, 0777, true);
			else
				throw new Exception("No se puede escribir en el directorio $queueParentDir. Verifique la configuración de permisos.");
		}
		
		if (Common::isWritable($queueDir)) {
			$filename = $queueDir.'/'.uniqid();
			file_put_contents($filename, $content);
		} else {
			throw new Exception("No se puede escribir en el directorio $queueDir. Verifique la configuración de permisos.");
		}
	}
}
