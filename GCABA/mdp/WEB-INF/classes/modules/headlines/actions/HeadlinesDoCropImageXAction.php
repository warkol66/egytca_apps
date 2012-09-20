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
		
		if (isset($_POST["temp"]) && $_POST["temp"] == '1') 
				$filename = ConfigModule::get('headlines', 'clippingsTmpPath').$_POST["imageFile"];
			else
				$filename = ConfigModule::get('headlines', 'clippingsPath').$_POST["imageFile"];
		
		$imagesPath = ConfigModule::get('headlines', 'clippingsPath');
		$newImageFilename = $imagesPath . $_POST['headlineId'].'.jpg';
 
		// Get dimensions of the original image
		list($currentWidth, $currentHeight) = getimagesize($filename);

		$left = intval(($_POST['relativeX'] / $_POST['displayedWidth']) * $currentWidth);
		$top = intval(($_POST['relativeY'] / $_POST['displayedHeight']) * $currentHeight);

		$cropWidth = intval(($_POST['relativeWidth'] / $_POST['displayedWidth']) * $currentWidth);
		$cropHeight = intval(($_POST['relativeHeight'] / $_POST['displayedHeight']) * $currentHeight);
 
		// Resample the image
		$canvas = imagecreatetruecolor($cropWidth, $cropHeight);
		$currentImage = imagecreatefromjpeg($filename);
		imagecopy($canvas, $currentImage, 0, 0, $left, $top, $cropWidth, $cropHeight);

		if (!file_exists($imagesPath))
			mkdir ($imagesPath, 0777, true);

		$tempName = $imagesPath.'temp-'.uniqid();

		imagejpeg($canvas, $tempName, 100);

		if (file_exists($newImageFilename))
			unlink($newImageFilename);
		rename($tempName, $newImageFilename);

		return;
	}
}