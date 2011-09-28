<?php
/** 
 * AffiliatesUsersPasswordResetXAction
 *
 * @package affiliates 
 */

class AffiliatesUsersPasswordResetXAction extends BaseAction {

	function AffiliatesUsersPasswordResetXAction() {
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
		$smarty->assign('module',$module);

		$fieldname = 'userParams[username]';
		$exist = 1;

		$user = AffiliateUserPeer::get($_POST['id']);
		$password = $user->resetPassword();

		if ($password) {
			$smarty->assign("user",$user);
			$smarty->assign("password",$password);
			$subject = Common::getTranslation('New password','users');
			$body = $smarty->fetch("AffiliatesUsersPasswordRecoveryMail.tpl");

			$mailTo = $user->getMailAddress();

			global $system;
			$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];

			require_once("EmailManagement.php");

			$manager = new EmailManagement();
			$message = $manager->createHTMLMessage($subject,$body);
			$result = $manager->sendMessage($mailTo,$mailFrom,$message);
		}
			
		$smarty->assign('name',$fieldname);
		$smarty->assign('value',$exist);

		return $mapping->findForwardConfig('success');

	}

}
