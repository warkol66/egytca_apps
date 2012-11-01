<?php

require_once("includes/captcha/CaptchaSecurityImages.php");

class RegistrationCaptchaGenerationAction extends BaseAction {

	function RegistrationCaptchaGenerationAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "NewsComments";
		$smarty->assign("module",$module);

		$width = isset($_GET['width']) ? $_GET['width'] : '120';
		$height = isset($_GET['height']) ? $_GET['height'] : '40';
		$characters = isset($_GET['characters']) && $_GET['characters'] > 1 ? $_GET['characters'] : '6';

		$captcha = new CaptchaSecurityImages($width,$height);

		$image = $captcha->getImage();

		header('Content-Type: image/jpeg');
		header('Cache-Control: no-cache');
		imagejpeg($image);
		die;

	}

}