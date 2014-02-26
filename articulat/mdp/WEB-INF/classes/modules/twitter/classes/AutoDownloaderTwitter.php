<?php

class AutoDownloaderTwitter {
	
	public function putInQueue($attachment, $mustResample = false) {
		
		$url = $attachment->getUrl();
		$outputFile = $attachment->getRealpath();
		//return $outputFile;
		$id = $attachment->getId();
		
		if (is_null($outputFile))
			$outputFile = 'autonamed-'.uniqid();
		
		$content = "url=$url\n"."output=$outputFile\n";
		$content .= "mustResample=" . ($mustResample ? "1" : "0") . "\nid=$id";
		
		$queueParentDir = './WEB-INF/classes/modules/twitter/classes/autodwnlder';
		
		$queueDir = $queueParentDir . '/' . 'queue';
		if (!file_exists($queueDir)) {
			if (Common::isWritable($queueParentDir))
				mkdir($queueDir, 0755, true);
			else
				echo "no uno";
				throw new Exception("No se puede escribir en el directorio $queueParentDir. Verifique la configuración de permisos.");
		}
		
		if (Common::isWritable($queueDir)) {
			$filename = $queueDir.'/'.uniqid();
			file_put_contents($filename, $content);
		} else {
			echo "no dos";
			throw new Exception("No se puede escribir en el directorio $queueDir. Verifique la configuración de permisos.");
		}
	}
}
