<?php

class NewslettersTemplatesSendPreviewAction extends BaseAction {

	function NewslettersTemplatesSendPreviewAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Newsletters";
		$smarty->assign("module",$module);
		$section = "NewsletterTemplates";
		$smarty->assign("section",$section);

		if (!empty($_POST["id"])) {

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
