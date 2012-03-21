<?php
/** 
 * AffiliatesUsersDoPasswordRecoveryAction
 *
 * @package affiliates 
 */

class AffiliatesUsersDoPasswordRecoveryAction extends BaseAction {

	function AffiliatesUsersDoPasswordRecoveryAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);
    
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
		$section = "Users";

		if (!empty($_POST["username"]) && !empty($_POST["mailAddress"])) {
			$userAndPassword = AffiliateUserPeer::generatePassword($_POST["username"],$_POST["mailAddress"]);
			if (!empty($userAndPassword)) {

				$this->template->template = "TemplateMail.tpl";

				$smarty->assign("user",$userAndPassword[0]);
				$smarty->assign("password",$userAndPassword[1]);
				$subject = Common::getTranslation('New password','users');
				$body = $smarty->fetch("UsersPasswordRecoveryMail.tpl");

				$mailTo = $_POST["mailAddress"];

				global $system;
				$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];

				require_once("EmailManagement.php");
				$manager = new EmailManagement();

				$message = $manager->createHTMLMessage($subject,$body);
				$result = $manager->sendMessage($mailTo,$mailFrom,$message);

				Common::doLog('success','username: ' . $_POST["username"] . ' Mail Address: ' . $_POST["mailAddress"]);
				return $mapping->findForwardConfig('success');
			}
		}
		
		$this->template->template = "TemplateLogin.tpl";		
    $smarty->assign("message","wrongUser");

		Common::doLog('failure','username: ' . $_POST["username"] . ' Mail Address: ' . $_POST["mailAddress"]);
		return $mapping->findForwardConfig('failure');
	}

}
