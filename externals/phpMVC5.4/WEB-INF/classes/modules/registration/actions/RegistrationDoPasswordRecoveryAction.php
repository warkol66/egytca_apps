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

		if (!empty($_POST["email"]) ) {

			$user=RegistrationUserQuery::create()->findOneByMailaddress($_POST["email"]);

			if(!$user){
				$smarty->assign("message","wrongUser");
				return $mapping->findForwardConfig('failure');
			}

			$new_password=RegistrationUser::getNewPassword(10);

			$smarty->assign("user",$user);
			$smarty->assign("password",$new_password);
			$body = $smarty->fetch("RegistrationPasswordRecoveryMail.tpl");

			global $system;

			$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
			$mailTo = $user->getMailaddress();

			$subject ="Nueva Contraseña";

			$manager = new EmailManagement();
			$message = $manager->createHTMLMessage($subject, $body);
			$result = $manager->sendMessage($mailTo, $mailFrom, $message);

			$smarty->assign("email", $mailTo);

			$this->template->template = "TemplatePublic.tpl";
			return $mapping->findForwardConfig('success');
		}

		$this->template->template = "TemplatePublic.tpl";


			$smarty->assign("message","wrongUser");
		return $mapping->findForwardConfig('failure');
	}

}
