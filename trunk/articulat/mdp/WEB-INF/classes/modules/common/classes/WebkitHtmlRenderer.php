<?php

class RenderException extends Exception {}

class WebkitHtmlRenderer {
	
	private $command;
	
	function WebkitHtmlRenderer() {
		$this->command = realpath('./' . ConfigModule::get("headlines","clippingApp"));
	}
	
	private function getDefaultSettings() {
		global $system;
		$quality = $system['config']['clippings']['quality'];
		if (empty($quality))
			$quality = 90;
		$width = $system['config']['clippings']['width'];
		if (empty($width))
			$width = 1024;
		$height = $system['config']['clippings']['height'];
		if (empty($height))
			$height = 600;
		return array($quality, $width, $height);
	}
	
	/**
	 *
	 * @param string $url
	 * @param string $image
	 */
	function render($url, $image = 'default_image.jpg', $defaultSettings = false, $backgrounded = false) {
		
		if ($defaultSettings) {
			list($quality, $width, $height) = $this->getDefaultSettings();
			$sizeSettings = " --quality " . $quality . " --width " . $width . " --height " . $height;
		}
		
		$fullCommand = $this->command. $sizeSettings . ' --disable-javascript "' . $url . '" ' . $image;

		if (!stristr(PHP_OS,"WIN")) { //No hay renderer para win
			
			if ($backgrounded)
				$fullCommand .= ' > /dev/null 2>/dev/null &';
			
			$return_var = shell_exec($fullCommand);
			
			if (!$backgrounded) { // if backgrounded file doesn't have to exist yet
				if (!file_exists($image) || filesize($image) <= 0)
					throw new RenderException("No se pudo capturar la imagen.");
			}
		}
	}
	
	public function putInQueue($url, $image = 'default_image.jpg', $defaultSettings = false) {
		
		if ($defaultSettings)
			list($quality, $width, $height) = $this->getDefaultSettings();
		
		$content = "quality=$quality\n"."width=$width\n"."height=$height\n";
		$content .= "url=$url\n"."image=$image\n";
		
		$queueParentDir = './WEB-INF/classes/modules/headlines/classes/urlcaptor';
		
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
