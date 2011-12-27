<?php

class RenderException extends Exception {}

class WebkitHtmlRenderer {
	
	private $command;
	
	function WebkitHtmlRenderer() {
		$this->command = './' . ConfigModule::get("headlines","clippingApp");
	}
	
	/**
	 *
	 * @param string $url
	 * @param string $image
	 */
	function render($url, $image = 'default_image.jpg') {
		global $system;
		$quality = $system['config']['clippings']['quality'];
		
		$return_var = shell_exec($this->command.' --quality '.$quality.' '.$url.' '.$image);
		if (!file_exists($image))
			throw new RenderException("No se pudo capturar la imagen.");
	}
	
}
