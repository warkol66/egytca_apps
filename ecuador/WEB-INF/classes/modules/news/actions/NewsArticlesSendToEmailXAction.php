<?php

require_once("EmailManagement.php");

class NewsArticlesSendToEmailXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsArticlesSendToEmailXAction() {
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

		$module = "News";
		$smarty->assign("module",$module);
		$section = "Article";
		$smarty->assign("section",$section);				
		
		//por ser un action ajax
		$this->template->template = 'TemplateAjax.tpl';
 		
		if (empty($_POST['id']) && $_POST['email'])
			return $mapping->findForwardConfig('failure');
		
		global $system;
		$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];		
		$sendMailSubjectSufix = $system["config"]["news"]["sendMailSubjectSufix"];		
		$mailTo = $_POST['email'];
		$mailReplyTo = $_POST["emailReplyTo"];
		
		
		//validacion de captcha
		if ( (empty($_POST['securityCode'])) || !Common::validateCaptcha($_POST['securityCode'])) {
			$smarty->assign('captcha',true);
			return $mapping->findForwardConfig('failure');
		}

		//validacion de email
		if(!(Common::validateEmail($mailTo) && Common::validateEmail($mailReplyTo))) {
			$smarty->assign('invalidEmail',true);
			return $mapping->findForwardConfig('failure');
		}
		
		$article = NewsArticleQuery::create()->findOneById($_POST['id']);
		
		if (empty($article))
			return $mapping->findForwardConfig('failure');
		
		$manager = new EmailManagement();
		//creamos el mensaje multipart
		$message = $manager->createMultipartMessage($sendMailSubjectSufix,$article->toXHTML(false));

		//realizamos el envio
		$result = $manager->sendMessage($mailTo,$mailFrom,$message,$mailReplyTo);
		
		//Registramos en el Log el envio
		Common::doLog('success','to: ' . $_POST["email"].' from: '.$_POST["emailReplyTo"]." (".$_SERVER[REMOTE_ADDR].")");
	
		return $mapping->findForwardConfig('success');
	}

}
