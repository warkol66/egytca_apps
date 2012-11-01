<?php

class HeadlineImageCropper {
	
	/**
	 * 
	 * @param string $input path to the image to be cropped
	 * @param string $output path to the cropped image
	 * @param float $rx [0..1] contained value representing the x starting position of the crop relative to the total image width
	 * @param float $ry [0..1] contained value representing the y staring position of the crop relative to the total image height
	 * @param float $rw [0..1] contained value representing the width of the crop relative to the total image width
	 * @param float $rh [0..1] contained value representing the height of the crop relative to the total image height
	 * @param string $type image type (jpeg, png, ...)
	 * @throws Exception
	 */
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