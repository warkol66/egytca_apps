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
		
		if (empty($_POST['source']))
			$_POST['source'] = 'clipping';
		
		switch ($_POST['source']) {
			case 'attachment':
				list($input, $output, $type, $rOutput) = $this->getAttachmentFileData();
				break;
			case 'clipping':
				list($input, $output, $type, $rOutput) = $this->getClippingFileData();
				break;
			default:
				throw new Exception('invalid source');
		}
		
		$rx = $_POST['relativeX'] / $_POST['displayedWidth'];
		$ry = $_POST['relativeY'] / $_POST['displayedHeight'];
		$rw = $_POST['relativeWidth'] / $_POST['displayedWidth'];
		$rh = $_POST['relativeHeight'] / $_POST['displayedHeight'];
		
		require_once 'HeadlineImageCropper.php';
		HeadlineImageCropper::relativeCrop($input, $output, $rx, $ry, $rw, $rh, $type);
		
		require_once 'HeadlineImageResampler.php';
		HeadlineImageResampler::copyResampled($output, $rOutput, $type);

		return;
	}
	
	private function getClippingFileData() {
		if (isset($_POST["temp"]) && $_POST["temp"] == '1') 
			$filename = ConfigModule::get('headlines', 'clippingsTmpPath').$_POST["imageFile"];
		else
			$filename = ConfigModule::get('headlines', 'clippingsPath').$_POST["imageFile"];

		$imagesPath = ConfigModule::get('headlines', 'clippingsPath');
		if (!file_exists($imagesPath))
			mkdir ($imagesPath, 0777, true);

		$newImageFilename = $imagesPath . $_POST['headlineId'].'.jpg';
		
		$headline = HeadlineQuery::create()->findOneById($_POST['headlineId']);
		$resampledImageRealpath = $headline->getClippingFullname(Headline::CLIPPING_RESIZED);

		return array($filename, $newImageFilename, 'jpg', $resampledImageRealpath);
	}
	
	private function getAttachmentFileData() {
		if (empty($_POST['id']))
			return $this->returnAjaxFailure('attachment source needs an id');

		$attachment = HeadlineAttachmentQuery::create()->findOneById($_POST['id']);
		if (is_null($attachment))
			return $this->returnAjaxFailure($_POST['id'].' is not a valid id');
		
		$input = $attachment->getRealpath();
		$output = $input;
		$type = str_replace('image/', '', $attachment->getType());
		$attachment->setSecondaryDataName('r-'.$attachment->getName());
		$rOutput = $attachment->getSecondaryDataRealpath();
		return array($input, $output, $type, $rOutput);
	}
}