<?php
/**
 * UsersPasswordDoRecoverAction
 *
 * @package users
 */

class CommonPasswordDoRecoverAction extends BaseAction {

	function CommonPasswordDoRecoverAction() {
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
		$section = "Users";

		//////////
		// Use a different template
		$this->template->template = "TemplateLogin.tpl";

		$user = Common::getByRecoveryHash($_GET["recoveryHash"]);

		if (!empty($user) && $user->recoveryRequestIsValid()) {
			if (ConfigModule::get(strtolower($user->getModule()),'askForNewPasswordOnRecovery')) {
				$smarty->assign("recoveryHash", $_GET["recoveryHash"]);
				return $mapping->findForwardConfig('askNewPass');
			}
			else {
				$username = $user->getUserName();
				$userMail = $user->getMailAddress();

				$userNewPassword = $user->resetPassword();
				if (!empty($userNewPassword)) {

					//////////
					// Use a different template
					$this->template->template = "TemplatePlain.tpl";

					$smarty->assign("user",$user);
					$smarty->assign("password",$userNewPassword);
					$subject = Common::getTranslation('New password','users');
					$body = $smarty->fetch("CommonPasswordRecoveryMail.tpl");

					$mailTo = $userMail;

					global $system;
					$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];

					require_once("EmailManagement.php");
					$manager = new EmailManagement();
					$message = $manager->createHTMLMessage($subject,$body);
					$result = $manager->sendMessage($mailTo,$mailFrom,$message);

					$user->setRecoveryhash(null);
					$user->save();

					return $mapping->findForwardConfig('success');
				}
			}
		}

		if (empty($user))
			$smarty->assign("message","wrongHash");
		else if (!$user->recoveryRequestIsValid())
			$smarty->assign("message","expiredHash");
		else
			$smarty->assign("message","anotherError");

		return $mapping->findForwardConfig('failure');
	}

}
