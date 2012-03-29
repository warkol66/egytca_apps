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
		$width = $system['config']['clippings']['width'];
		$height = $system['config']['clippings']['height'];
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
			$sizeSettings = " --width " . $width . " --height " . $height;
		}
		
		$fullCommand = $this->command.' --quality ' . $quality . $sizeSettings . ' "' . $url . '" ' . $image;
        
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
		
		$urlcaptorDir = './WEB-INF/classes/modules/headlines/classes/urlcaptor';
		
		$queueDir = $urlcaptorDir . '/' . 'queue';
		if (!file_exists($qeueDir))
			mkdir ($queueDir, 0777, true);
		if (!file_exists($queueDir))
			throw new Exception('No se pudo crear el directorio '.$queueDir.'. Verifique la configuración de permisos');
		
		$filename = $queueDir.'/'.uniqid();
		file_put_contents($filename, $content);
		
		if (!file_exists($filename))
			throw new Exception('No se pudo crear el archivo '.$filename.'. Verifique la configuración de permisos');
	}
	
}
