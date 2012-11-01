<?php

require_once("EmailManagement.php");

class RegistrationDoPasswordRecoveryAction extends BaseAction {


	function RegistrationDoPasswordRecoveryAction() {
		;
	}


	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$this->template->template = "TemplateMail.tpl";

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Registration";

		if (!empty($_POST["username"]) ) {
			$userAndPassword = RegistrationUserPeer::generatePassword($_POST["username"],$_POST["mailAddress"]);
			if ( !empty($userAndPassword) ) {
						$smarty->assign("user",$userAndPassword[0]);
						$smarty->assign("password",$userAndPassword[1]);
						$body = $smarty->fetch("RegistrationPasswordRecoveryMail.tpl");

				$userInfo = $userAndPassword[0]->getUserInfo();

				global $system;

				$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];

				if (isset($_POST['alternateMailSend']) && ($_POST['alternateMailSend'])) {
					$mailTo = $userInfo->getAlternateMailAddress();
				}
				else {
					$mailTo = $userInfo->getMailAddress();
				}

				$subject = 'Nueva Contraseña';

				$manager = new EmailManagement();
				$message = $manager->createHTMLMessage($subject,$body);
				$result = $manager->sendMessage($mailTo,$mailFrom,$message);

				$smarty->assign('mailTo',$mailTo);

				if ($result) {
					$this->template->template = "TemplatePublic.tpl";
					return $mapping->findForwardConfig('success');
				}

			}
		}

		$this->template->template = "TemplatePublic.tpl";


			$smarty->assign("message","wrongUser");
		return $mapping->findForwardConfig('failure');
	}

}
