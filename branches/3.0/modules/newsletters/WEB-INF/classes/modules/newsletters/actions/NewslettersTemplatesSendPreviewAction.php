<?php

require_once("BaseAction.php");
require_once("NewsletterTemplatePeer.php");
require_once("NewsArticlePeer.php");

class NewslettersTemplatesSendPreviewAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewslettersTemplatesSendPreviewAction() {
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

		$module = "Newsletters";
		$smarty->assign("module",$module);
		$section = "NewsletterTemplates";
		$smarty->assign("section",$section);

    	if ( !empty($_POST["id"]) ) {
			
			$template = NewsletterTemplatePeer::get($_POST["id"]);
			
			require_once('NewsletterTemplateRenderFactory.php');
			$renderFactory = new NewsletterTemplateRenderFactory();
			$render = $renderFactory->build($template);
			
			require_once('EmailManagement.php');
			$manager = new EmailManagement();			

			$subject = $render->getSubject();
			$body = $render->getBody();
			
			global $system;
			$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
			
			$emails = split(',',$_POST['emails']);
	
			foreach ($emails as $mail) {

				$message = $manager->createMultipartMessage($subject,$body);
				//realizamos el envio
				$result = $manager->sendMessage($mail,$mailFrom,$message);
								
			}


		}

		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		$queryData = '&id='.$_POST["id"];
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

	}

}