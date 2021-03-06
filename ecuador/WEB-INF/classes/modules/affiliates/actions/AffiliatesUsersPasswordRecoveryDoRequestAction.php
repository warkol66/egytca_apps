<?php
/**
 * AffiliatesUsersPasswordRecoveryDoRequestAction
 *
 * @package affiliates
 */

class AffiliatesUsersPasswordRecoveryDoRequestAction extends BaseAction {

	function AffiliatesUsersPasswordRecoveryDoRequestAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$this->template->template = "TemplatePlain.tpl";

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
		$section = "Users";

		if (!empty($_POST["username"]) && !empty($_POST["mailAddress"])) {
			if (Common::validateCaptcha($_POST['securityCode'])) {
				$user = AffiliateUserPeer::authenticateByUserAndMail($_POST["username"], $_POST["mailAddress"]);
				if ( !empty($user)) {
					if (!$user->recoveryRequestAlredyMade()) {
						$subject = Common::getTranslation('New password','users');
						$smarty->assign("user",$user);
						$recoveryHash = $user->createRecoveryHash();
						$smarty->assign("recoveryHash",$recoveryHash);
						$body = $smarty->fetch("AffiliatesUsersPasswordRecoveryRequest.tpl");

						$mailTo = $user->getMailAddress();

						global $system;
						$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];

						require_once("EmailManagement.php");
						$manager = new EmailManagement();
						$message = $manager->createHTMLMessage($subject,$body);
						$result = $manager->sendMessage($mailTo,$mailFrom,$message);

						Common::doLog('success','username: ' . $_POST["username"] . ' => ' . $_POST["mailAddress"]);
						return $mapping->findForwardConfig('success');
					}
					else {
						$this->template->template = "TemplateLogin.tpl";
						$smarty->assign("message","requestAlredyMade");
						return $mapping->findForwardConfig('failure');
					}
				}
			}
			else {
				$this->template->template = "TemplateLogin.tpl";
				$smarty->assign("message","wrongCaptcha");
				return $mapping->findForwardConfig('failure');
			}
		}

		$this->template->template = "TemplateLogin.tpl";

		$smarty->assign("message","wrongUser");
		Common::doLog('failure','username: ' . $_POST["username"] . ' => ' . $_POST["mailAddress"]);
		return $mapping->findForwardConfig('failure');
	}

}
