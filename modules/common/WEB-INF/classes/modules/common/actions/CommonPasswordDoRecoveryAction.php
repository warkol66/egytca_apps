<?php
/**
 * UsersPasswordDoRecoveryAction
 *
 * @package users
 */

require_once("EmailManagement.php");

class CommonPasswordDoRecoveryAction extends BaseAction {

	function CommonPasswordDoRecoveryAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		$this->template->template = "TemplatePlain.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$section = "Users";
		
		$userPeer = new UserPeer();

		$user = $userPeer->getByRecoveryHash($_GET["recoveryHash"]);
		if (!empty($user) && $user->recoveryRequestIsValid()) {
			$userName = $user->getUserName();
			$userMail = $user->getMailAddress();
			$userAndPassword = $userPeer->generatePassword($userName, $userMail);
			if (!empty($userAndPassword)) {
				$smarty->assign("user",$userAndPassword[0]);
				$smarty->assign("password",$userAndPassword[1]);
				$subject = Common::getTranslation('New password','users');
				$body = $smarty->fetch("CommonPasswordRecoveryMail.tpl");

				$mailTo = $userMail;

				global $system;
				$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];

				$manager = new EmailManagement();
				$message = $manager->createHTMLMessage($subject,$body);
				$result = $manager->sendMessage($mailTo,$mailFrom,$message);
				
				$user->setRecoveryhash(null);
				$user->save();
				
				return $mapping->findForwardConfig('success');
			}
		}

		$this->template->template = "TemplateLogin.tpl";
		
		if (empty($user)) {
			$smarty->assign("message","wrongHash");
		} else if (!$user->recoveryRequestIsValid()){
			$smarty->assign("message","expiredHash");
		} else {
			$smarty->assign("message","anotherError");
		}
		return $mapping->findForwardConfig('failure');
	}

}
