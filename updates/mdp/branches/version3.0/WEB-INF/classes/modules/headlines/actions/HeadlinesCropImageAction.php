<?php

class HeadlinesCropImageAction extends BaseAction {

	function HeadlinesCropImageAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		// Original image
		$filename = 'temp_headlineImage.jpg';
 
		// Get dimensions of the original image
		list($current_width, $current_height) = getimagesize($filename);
 
		// The x and y coordinates on the original image where we
		// will begin cropping the image
		$left = intval(($_POST['relative_x'] / $_POST['displayed_width']) * $current_width);
		$top = intval(($_POST['relative_y'] / $_POST['displayed_height']) * $current_height);
 
		// This will be the final size of the image (e.g. how many pixels
		// left and down we will be going)
		$crop_width = intval(($_POST['relative_width'] / $_POST['displayed_width']) * $current_width);
		$crop_height = intval(($_POST['relative_height'] / $_POST['displayed_height']) * $current_height);
		
		echo 'relative_x: '.$_POST['relative_x'].'<br>';
		echo 'relative_y: '.$_POST['relative_y'].'<br>';
		echo 'relative_width: '.$_POST['relative_width'].'<br>';
		echo 'relative_height: '.$_POST['relative_height'].'<br>';
		echo 'displayed_width: '.$_POST['displayed_width'].'<br>';
		echo 'displayed_height: '.$_POST['displayed_height'].'<br>';
		echo 'top: '.$top.'<br>';
		echo 'left: '.$left.'<br>';
		echo 'crop_width: '.$crop_width.'<br>';
		echo 'crop_height: '.$crop_height.'<br>';
		echo 'current_width: '.$current_width.'<br>';
		echo 'current_height: '.$current_height.'<br>';
		//return $mapping->findForwardConfig('success');
 
		// Resample the image
		$canvas = imagecreatetruecolor($crop_width, $crop_height);
		$current_image = imagecreatefromjpeg($filename);
		imagecopy($canvas, $current_image, 0, 0, $left, $top, $crop_width, $crop_height);
		imagejpeg($canvas, 'croped.jpeg', 100);
		
		return $mapping->findForwardConfig('success');
	}
}