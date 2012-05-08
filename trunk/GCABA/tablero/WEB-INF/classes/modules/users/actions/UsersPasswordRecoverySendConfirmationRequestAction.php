<?php
/**
 * UsersPasswordRecoverySendConfirmationRequestAction
 *
 * @package users
 */

require_once("BaseAction.php");
require_once("EmailManagement.php");

class UsersPasswordRecoverySendConfirmationRequestAction extends BaseAction {

	function UsersPasswordRecoverySendConfirmationRequestAction() {
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

		$module = "Users";

		if ( !empty($_POST["username"]) && !empty($_POST["mailAddress"]) ) {
			if (Common::validateCaptcha($_POST['securityCode'])) {
				$user = UserPeer::authenticateByUserAndMail($_POST["username"],$_POST["mailAddress"]);
				if ( !empty($user)) {
					if (!$user->recoveryRequestAlredyMade()) {
						$subject = Common::getTranslation('New password','users');
						$smarty->assign("user",$user);
						$recoveryHash = $user->createRecoveryHash();
						$smarty->assign("recoveryHash",$recoveryHash);
						$body = $smarty->fetch("UsersPasswordRecoveryConfirmationRequestMail.tpl");
		
						$mailTo = $user->getMailAddress();
		
						global $system;
						$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
		
						$manager = new EmailManagement();
						$message = $manager->createHTMLMessage($subject,$body);
						$result = $manager->sendMessage($mailTo,$mailFrom,$message);
						
						Common::doLog('success','username: ' . $_POST["username"] . ' Mail Address: ' . $_POST["mailAddress"]);
						return $mapping->findForwardConfig('success');
					} else {
						$this->template->template = "TemplateLogin.tpl";
						$smarty->assign("message","requestAlredyMade");
						return $mapping->findForwardConfig('failure');
					}
				}
			} else {
				$this->template->template = "TemplateLogin.tpl";
				$smarty->assign("message","wrongCaptcha");
				return $mapping->findForwardConfig('failure');
			}
		}

		$this->template->template = "TemplateLogin.tpl";

		$smarty->assign("message","wrongUser");
		Common::doLog('failure','username: ' . $_POST["username"] . ' Mail Address: ' . $_POST["mailAddress"]);
		return $mapping->findForwardConfig('failure');
	}

}
