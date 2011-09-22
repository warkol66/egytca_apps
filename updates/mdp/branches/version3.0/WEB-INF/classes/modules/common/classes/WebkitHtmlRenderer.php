<?php

class RenderException extends Exception {}

class WebkitHtmlRenderer {
	
	private $system_command = array(
			'Linux' => './wkhtmltoimage-i386'
		);
	
	private $command;
	
	function WebkitHtmlRenderer() {
		$this->command = $this->system_command[php_uname('s')];
	}
	
	/**
	 *
	 * @param string $url
	 * @param string $image
	 */
	function render($url, $image = 'default_image.jpg') {
		$quality = 20;
		$return_var = shell_exec($this->command.' --quality '.$quality.' '.$url.' '.$image);
		if (!file_exists($image))
			throw new RenderException("No se pudo capturar la imagen.");
	}
	
}
