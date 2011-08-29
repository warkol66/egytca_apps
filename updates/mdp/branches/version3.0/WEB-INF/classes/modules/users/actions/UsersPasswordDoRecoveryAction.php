<?php
/**
 * UsersPasswordDoRecoveryAction
 *
 * @package users
 */

class UsersPasswordDoRecoveryAction extends BaseAction {

	function UsersPasswordDoRecoveryAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Users";
		$section = "Users";

		$userPeer = new UserPeer();

		$user = $userPeer->getByRecoveryHash($_GET["recoveryHash"]);
		if (!empty($user) && $user->recoveryRequestIsValid()) {
			$userName = $user->getUserName();
			$userMail = $user->getMailAddress();
			$userAndPassword = $userPeer->generatePassword($userName, $userMail);
			if (!empty($userAndPassword)) {

				$this->template->template = "TemplatePlain.tpl";

				$smarty->assign("user",$userAndPassword[0]);
				$smarty->assign("password",$userAndPassword[1]);
				$subject = Common::getTranslation('New password','users');
				$body = $smarty->fetch("UsersPasswordRecoveryMail.tpl");

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

		$this->template->template = "TemplateLogin.tpl";
		
		if (empty($user))
			$smarty->assign("message","wrongHash");
		else if (!$user->recoveryRequestIsValid())
			$smarty->assign("message","expiredHash");
		else
			$smarty->assign("message","anotherError");

		return $mapping->findForwardConfig('failure');
	}

}
