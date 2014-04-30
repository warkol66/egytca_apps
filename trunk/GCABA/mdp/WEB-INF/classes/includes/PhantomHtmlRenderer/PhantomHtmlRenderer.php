<?php

require_once 'HtmlRenderer.php';

class PhantomHtmlRenderer extends HtmlRenderer {
	
	private $phantomjs;
	private $renderjs;
	
	public function __construct() {
		
		$this->phantomjs = realpath(ConfigModule::get('headlines', 'phantomjsBin'));
		$this->renderjs = realpath(__DIR__.'/render.js');
		if (!$this->phantomjs)
			throw new Exception('No se encontr&oacute; el binario de phantomjs ('.$this->phantomjs.')');
		if (!$this->renderjs)
			throw new Exception('No se encontr&oacute; el script de captura de im&aacute;genes ('.$this->renderjs.')');
	}
	
	/**
	 *
	 * @param string $url
	 * @param string $image
	 */
	function render($url, $image = 'default_image.jpg', $defaultSettings = false, $backgrounded = false) {
		
		if ($defaultSettings) {
			list($quality, $width, $height) = $this->getDefaultSettings();
			$size = "$width*$height";
		}
		
		$command = $this->phantomjs.' '.$this->renderjs." $url $image";
		if (isset($size))
			$command .= " $size";

		if (!stristr(PHP_OS,"WIN")) { //No hay renderer para win
			
			if ($backgrounded)
				$command .= ' > /dev/null 2>/dev/null &';
			
			$return_var = shell_exec($command);
			
			if (!$backgrounded) { // if backgrounded, file doesn't have to exist yet
				if (!file_exists($image) || filesize($image) <= 0)
					throw new Exception("No se pudo capturar la imagen.");
			}
		} else {
			throw new Exception('Windows is not supported');
		}
	}
	
//	public function putInQueue($url, $image = 'default_image.jpg', $defaultSettings = false) {
//		
//		if ($defaultSettings)
//			list($quality, $width, $height) = $this->getDefaultSettings();
//		
//		$content = "quality=$quality\n"."width=$width\n"."height=$height\n";
//		$content .= "url=$url\n"."image=$image\n";
//		
//		$queueParentDir = './WEB-INF/classes/modules/headlines/classes/urlcaptor';
//		
//		$queueDir = $queueParentDir . '/' . 'queue';
//		if (!file_exists($queueDir)) {
//			if (Common::isWritable($queueParentDir))
//				mkdir($queueDir, 0777, true);
//			else
//				throw new Exception("No se puede escribir en el directorio $queueParentDir. Verifique la configuración de permisos.");
//		}
//		
//		if (Common::isWritable($queueDir)) {
//			$filename = $queueDir.'/'.uniqid();
//			file_put_contents($filename, $content);
//		} else {
//			throw new Exception("No se puede escribir en el directorio $queueDir. Verifique la configuración de permisos.");
//		}
//	}
	
}
