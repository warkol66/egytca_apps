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
		$return_var;
		$output = array();
		exec($this->command . ' ' . $url . ' ' . $image,
			&$output, $return_var);
		
		if ($return_var != 0)
			throw new RenderException("No se pudo capturar la imagen.");
	}
	
}
