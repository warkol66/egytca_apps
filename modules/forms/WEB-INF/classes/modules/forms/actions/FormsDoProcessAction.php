<?php

require_once("BaseAction.php");
require_once("FormPeer.php");
require_once("ProcessedFormPeer.php");

class FormsDoProcessAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function FormsDoProcessAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
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

		$module = "Forms";
		$smarty->assign("module",$module);
		$section = "Forms";
		$smarty->assign("section",$section);		
		
		$moduleConfig = Common::getModuleConfiguration($module);

		$form = FormPeer::get($_POST['formId']);
		
		if ($$moduleConfig['answerOnDOMForm'] == "YES")
			$processedForm = ProcessedFormPeer::createFromPOST($form,$_POST);
		else
			$processedForm = ProcessedFormPeer::createFromPOSTDOM($form,$_POST);

		$redirectUrl = $form->getRedirecturl();

		//tiene validacion por captcha
		if($form->getHasCaptcha() == 1)
			if (!Common::validateCaptcha($_POST['captcha'])) {
				$referer = getenv("HTTP_REFERER");
				header("Location: " . $referer . '&captchaError=1');
				exit(-1);				
			}
		
		$emails = $form->getMailsTo();

		//notificaciones de email
		//envio a destinatario
		$processedForm->notifyDestinationMail($form->getName());
		//envio a otros interesados
		if (!empty($emails)) {
			$emailsArray = explode(',',$emails);
			foreach ($emailsArray as $email)
				$processedForm->notify($form->getName(),$email);
		}

		//si hay url de redireccionamiento redireccionamos a la misma
		if (!empty($redirectUrl))
			header("Location: " . $redirectUrl);
		
		//Por default redireccionamos a la misma pagina donde estaba el form
		$referer = getenv("HTTP_REFERER");
		header("Location: " . $referer . '&formId=' . $form->getId());
		
	}

}