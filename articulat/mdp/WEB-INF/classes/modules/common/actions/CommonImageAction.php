<?php
	/*
	* CommonImageAction
	* Author: Egytca
	* Guarda en $_SESSION['security_code'] el codigo generado en el cpatcha y en $_SESSION['security_codeGenerationTimes'] la 
	* cantidad de veces que se ha generado el código en la misma session
	*/

if (file_exists("WEB-INF/lib-phpmvc/captcha/CaptchaSecurityImages.php"))
	require_once("WEB-INF/lib-phpmvc/captcha/CaptchaSecurityImages.php");
else {
	global $appServerRootDir;
	require_once($appServerRootDir . "/WEB-INF/lib/captcha/CaptchaSecurityImages.php");
}

class CommonImageAction extends BaseAction {

	function CommonImageAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$smarty->assign("module",$module);

		$captcha = new CaptchaSecurityImages();


		$width = isset($_GET['width']) ? $_GET['width'] : '240';
		$height = isset($_GET['height']) ? $_GET['height'] : '50';
		$characters = isset($_GET['characters']) && $_GET['characters'] > 1 ? $_GET['characters'] : '5';

		$captcha->setConfig();

		if ($_GET['font'])
			$captcha->setFont($_GET['font']);

		$captcha->setWidth($width);
		$captcha->setHeight($height);
		$captcha->setChars($characters);

		$captcha->generateImage();
		$image = $captcha->getImage();

		header('Content-Type: image/jpeg');
		header('Cache-Control: no-cache');
		imagejpeg($image);
		die;

	}

}