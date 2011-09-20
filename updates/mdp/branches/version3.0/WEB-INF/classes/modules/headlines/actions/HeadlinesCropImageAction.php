<?php

class HeadlinesCropImageAction extends BaseAction {
	
	private $IMAGES_PATH = './WEB-INF/classes/modules/headlines/files/clipping';

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
		
		$filename = $_POST["image_file"];
 
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
		imagejpeg($canvas, $this->IMAGES_PATH.'/'.$_POST["headlineId"].'.jpeg', 100);
		
		unlink($filename); // delete temp image
		
		// para borrar
		echo '<a href="Main.php?do=headlinesRenderUrl&id=1">Main.php?do=headlinesRenderUrl&id=1</a>';
		
		return $mapping->findForwardConfig('success');
	}
}