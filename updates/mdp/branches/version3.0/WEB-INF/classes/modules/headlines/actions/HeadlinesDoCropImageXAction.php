<?php

class HeadlinesDoCropImageXAction extends BaseAction {
	
	function HeadlinesDoCropImageXAction() {
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
		
		$filename = $_POST["image_file"];
		$images_path = ConfigModule::get('headlines', 'clippingsPath');
		$new_image_filename = $images_path . $_POST['headline_id'].'.jpg';
 
		// Get dimensions of the original image
		list($current_width, $current_height) = getimagesize($filename);

		$left = intval(($_POST['relative_x'] / $_POST['displayed_width']) * $current_width);
		$top = intval(($_POST['relative_y'] / $_POST['displayed_height']) * $current_height);

		$crop_width = intval(($_POST['relative_width'] / $_POST['displayed_width']) * $current_width);
		$crop_height = intval(($_POST['relative_height'] / $_POST['displayed_height']) * $current_height);
 
		// Resample the image
		$canvas = imagecreatetruecolor($crop_width, $crop_height);
		$current_image = imagecreatefromjpeg($filename);
		imagecopy($canvas, $current_image, 0, 0, $left, $top, $crop_width, $crop_height);

		if (!file_exists($images_path))
			mkdir ($images_path, 0777, true);

		$tempName = $images_path.'temp-'.uniqid();

		imagejpeg($canvas, $tempName, 100);

		if (file_exists($new_image_filename))
			unlink($new_image_filename);
		rename($tempName, $new_image_filename);

		return $mapping->findForwardConfig('success');
	}
}