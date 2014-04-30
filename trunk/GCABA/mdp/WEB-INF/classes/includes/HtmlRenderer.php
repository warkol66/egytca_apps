<?php

abstract class HtmlRenderer {
	
	static function create() {
		
		$renderer = ConfigModule::get('headlines', 'htmlRenderer');

		include_once "$renderer.php";
		include_once "$renderer/$renderer.php";
		
		return new $renderer();
	}
	
	/**
	 *
	 * @param string $url
	 * @param string $image
	 */
	abstract function render($url, $image = 'default_image.jpg', $defaultSettings = false, $backgrounded = false);
	
	protected function getDefaultSettings() {
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
}
