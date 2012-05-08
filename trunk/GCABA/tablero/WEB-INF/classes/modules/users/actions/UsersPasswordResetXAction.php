<?php
require_once("EmailManagement.php");

class UsersPasswordResetXAction extends BaseAction {

	function UsersPasswordResetXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$this->template->template = 'TemplateAjax.tpl';

		$module = "Users";
		$smarty->assign('module',$module);

		$fieldname = 'userParams[username]';
		$exist = 1;

		$user = UserPeer::get($_POST['id']);
		$password = $user->resetPassword();
		if ($password) {
			$smarty->assign("user",$user);
			$smarty->assign("password",$password);
			$subject = Common::getTranslation('New password','users');
			$body = $smarty->fetch("UsersPasswordRecoveryMail.tpl");

			$mailTo = $user->getMailAddress();

			global $system;
			$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];

			$manager = new EmailManagement();
			$message = $manager->createHTMLMessage($subject,$body);
			$result = $manager->sendMessage($mailTo,$mailFrom,$message);
		}
			
		$smarty->assign('name',$fieldname);
		$smarty->assign('value',$exist);
		$smarty->assign('message',$message);

		return $mapping->findForwardConfig('success');

	}

}
