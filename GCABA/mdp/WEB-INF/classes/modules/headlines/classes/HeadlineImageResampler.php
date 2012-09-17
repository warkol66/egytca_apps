<?php

class HeadlineImageResampler {
	
	static function resample($filename) {
		
		if (!file_exists($filename))
			throw new Exception("$filename doesn't exist");
		
		global $system;
		
		$resampledWidth = $system['config']['headlines']['clippingSize']['width'];
		$resampledHeight = $system['config']['headlines']['clippingSize']['height'];
		list($originalWidth, $originalHeight) = getimagesize($filename);
		
		// quiero mantener la proporcion de la imagen
		if ( ($originalWidth / $resampledWidth) > ($originalHeight / $resampledHeight) ) {
			$resampledHeight = intval($originalHeight / $originalWidth * $resampledWidth);
		} else {
			$resampledWidth = intval($originalWidth / $originalHeight * $resampledHeight);
		}
		// ------------------------------------------
		
		$canvas = imagecreatetruecolor($resampledWidth, $resampledHeight);
		$originalImage = imagecreatefromjpeg($filename);
		imagecopyresampled ($canvas, $originalImage, 0, 0, 0, 0, $resampledWidth, $resampledHeight, $originalWidth, $originalHeight);
		imagejpeg($canvas, $filename, 100);
	}
}