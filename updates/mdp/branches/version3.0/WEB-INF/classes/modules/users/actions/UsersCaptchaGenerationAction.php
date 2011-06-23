<?php

require_once("includes/captcha/CaptchaSecurityImages.php");

class UsersCaptchaGenerationAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function UsersCaptchaGenerationAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code></code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

    	BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "users";
		$smarty->assign("module",$module);
				
		//$this->template->template = "TemplateAjax.tpl";
		
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