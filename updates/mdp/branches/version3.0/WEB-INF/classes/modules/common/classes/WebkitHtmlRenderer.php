<?php

class RenderException extends Exception {}

class WebkitHtmlRenderer {
	
	private $command;
	
	function WebkitHtmlRenderer() {
		$this->command = realpath('./' . ConfigModule::get("headlines","clippingApp"));
	}
	
	/**
	 *
	 * @param string $url
	 * @param string $image
	 */
	function render($url, $image = 'default_image.jpg', $defaultSettings = false) {
		global $system;
		$quality = $system['config']['clippings']['quality'];
		
		if ($defaultSettings) {
			$height = $system['config']['clippings']['height'];
			$width = $system['config']['clippings']['width'];
			$sizeSettings = " --width " . $width . " --height " . $height;

		}
        
		if (!stristr(PHP_OS,"WIN")) { //No hay renderer para win
			$return_var = shell_exec($this->command.' --quality ' . $quality . $sizeSettings . ' "' . $url . '" ' . $image);
			if (!file_exists($image) || filesize($image) <= 0)
				throw new RenderException("No se pudo capturar la imagen.");
		}
	}
	
}
