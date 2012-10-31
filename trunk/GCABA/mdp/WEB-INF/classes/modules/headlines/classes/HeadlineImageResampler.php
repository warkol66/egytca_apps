<?php

class HeadlineImageResampler {
	
	/**
	 * Crea una nueva imagen resampleada a partir de otra imagen imagen para
	 * que el tamanio no exceda los valores maximos establecidos en la 
	 * configuracion del sistema manteniendo las proporciones.
	 *  
	 * @param string $inputFilename nombre de la imagen original a resamplear
	 * @param string $outputFilename nombre de la imagen copia resampleada
	 */
	private static function doResample($inputFilename, $outputFilename, $type = 'jpeg') {
		
		if ($type == 'jpg')
			$type = 'jpeg';
		
		// image manipulation functions
		$imageCreateFromType = "imagecreatefrom$type";
		$imageType = "image$type";
		if (!function_exists($imageCreateFromType) || !function_exists($imageType))
			throw new Exception("$type is not a valid type");
		
		if (empty($inputFilename))
			throw new Exception('$inputFilename cannot be an empty string');
		
		if (empty($outputFilename))
			throw new Exception('$outputFilename cannot be an empty string');
		
		if (!file_exists($inputFilename))
			throw new Exception("$inputFilename doesn't exist");
		
		global $system;
		
		$maxWidth = $system['config']['headlines']['clippingSize']['width'];
		$maxHeight = $system['config']['headlines']['clippingSize']['height'];
		
		if (empty($maxWidth))
			$maxWidth = 640;
		if (empty($maxHeight))
			$maxHeight = 480;

		list($originalWidth, $originalHeight) = getimagesize($inputFilename);
		
		if (($originalWidth <= $maxWidth) && ($originalHeight <= $maxHeight))
			return; //No hago resample

		// quiero mantener la proporcion de la imagen
		$porportion = max(($originalWidth / $maxWidth),($originalHeight / $maxHeight));
		$resampledWidth = intval($originalWidth / $porportion);
		$resampledHeight =  intval($originalHeight / $porportion);
		// ------------------------------------------
		
		$canvas = imagecreatetruecolor($resampledWidth, $resampledHeight);
		$originalImage = $imageCreateFromType($inputFilename);
		imagecopyresampled ($canvas, $originalImage, 0, 0, 0, 0, $resampledWidth, $resampledHeight, $originalWidth, $originalHeight);
		$imageType($canvas, $outputFilename, 100);
		
		if (!file_exists($outputFilename))
			throw new Exception("failed to create $outputFilename - please check write permissions");
	}
	
	/**
	 * Crea una nueva imagen resampleada a partir de otra imagen imagen para
	 * que el tamanio no exceda los valores maximos establecidos en la 
	 * configuracion del sistema manteniendo las proporciones.
	 *  
	 * @param string $inputFilename nombre de la imagen original a resamplear
	 * @param string $outputFilename nombre de la imagen copia resampleada
	 */
	public static function copyResampled($inputFilename, $outputFilename, $type = 'jpeg') {
		self::doResample($inputFilename, $outputFilename, $type);
	}

	/**
	 * Hace el resample de una imagen para que el tamanio no exceda los valores maximos establecidos
	 * en la configuracion del sistema manteniendo las proporciones.
	 * 
	 * @param string $filename nombre de la imagen a resamplear
	 */
	public static function resample($filename, $type = 'jpeg') {
		self::doResample($filename, $filename, $type);
	}
}