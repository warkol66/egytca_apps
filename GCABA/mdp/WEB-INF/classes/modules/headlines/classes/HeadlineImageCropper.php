<?php

class HeadlineImageCropper {
	
	public static function relativeCrop($input, $output, $rx, $ry, $rw, $rh, $type = 'jpeg') {
		
		if ($type == 'jpg')
			$type = 'jpeg';
		
		// image manipulation functions
		$imageCreateFromType = "imagecreatefrom$type";
		$imageType = "image$type";
		if (!function_exists($imageCreateFromType) || !function_exists($imageType))
			throw new Exception("$type is not a valid type");
		
		// Get dimensions of the original image
		list($currentWidth, $currentHeight) = getimagesize($input);

		$left = intval($rx * $currentWidth);
		$top = intval($ry * $currentHeight);

		$cropWidth = intval($rw * $currentWidth);
		$cropHeight = intval($rh * $currentHeight);
 
		// Resample the image
		$canvas = imagecreatetruecolor($cropWidth, $cropHeight);
		$currentImage = $imageCreateFromType($input);
		
		imagecopy($canvas, $currentImage, 0, 0, $left, $top, $cropWidth, $cropHeight);
		
		$tempName = $output.'-temp-'.uniqid();
		
		$imageType($canvas, $tempName, 100);
		
		if (file_exists($output))
			unlink($output);
		rename($tempName, $output);
		
		return;
	}
}