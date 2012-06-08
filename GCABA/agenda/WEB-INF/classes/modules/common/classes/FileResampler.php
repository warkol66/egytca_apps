<?php

class FileResampler {
	
	public static function resampleTmp($tmpFile, $newFilename, $newWidth = null, $newHeight = null) {
		
		switch (strtolower(pathinfo($tmpFile['name'], PATHINFO_EXTENSION))) {
			case 'jpeg':
			case 'jpg' :
				$readImgFn = 'imagecreatefromjpeg';
				break;
			case 'gif':
				$readImgFn = 'imagecreatefromgif';
				break;
			case 'png':
				$readImgFn = 'imagecreatefrompng';
				break;
		}
		
		switch (strtolower(pathinfo($newFilename, PATHINFO_EXTENSION))) {
			case 'jpeg':
			case 'jpg' :
				$saveImgFn = 'imagejpeg';
				break;
			case 'gif':
				$saveImgFn = 'imagegif';
				break;
			case 'png':
				$saveImgFn = 'imagepng';
				break;
		}
		
		$tmpImage = $readImgFn($tmpFile['tmp_name']);
		list($oldWidth, $oldHeight) = getimagesize($tmpFile['tmp_name']);
		
		if ($newWidth == null)
			$newWidth = $oldWidth;
		if ($newHeight == null)
			$newHeight = $oldHeight;
		
		$resized = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($resized, $tmpImage, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
		$saveImgFn($resized, $newFilename);
		
		if (!file_exists($newFilename))
			throw new Exception("cannot create file $newFilename. check dir existance and permissions");
	}
}