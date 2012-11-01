<?php

class RegistrationDoHashVerificationAction extends BaseAction {

	function RegistrationDoHashVerificationAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Registration";
		$smarty->assign("module",$module);

			if (!isset($_SESSION["login_user"]))
				$this->template->template = "TemplatePublic.tpl";

		$type = Common::getRegistrationMode();

		$registrationUserPeer = new RegistrationUserPeer();

		$user = $registrationUserPeer->getByHash($_GET['hash']);

		$type = Common::getRegistrationMode();

		if (($user != null) && $user->isImported()) {

			if ($user != null && ($registrationUserPeer->activateUserByHash($user,$_GET['hash']))) {
				$password = $registrationUserPeer->assignRandomPassword($user);
				$smarty->assign('userActive',$user);
				$smarty->assign('password',$password);
				return $mapping->findForwardConfig('success');
			}
			else {
				$smarty->assign('error',true);
			}

		}

		if ( ($type == 'Moderated') || ($type == 'Open') ) {
			//si estan activos estos tipos, no hay verificacion
			return $mapping->findForwardConfig('disabled');
		}

		if ($type == 'Email Verification') {

			if ($user != null && ($registrationUserPeer->activateUserByHash($user,$_GET['hash']))) {
				$smarty->assign('userActive',$user);
			}
			else {
				$smarty->assign('error',true);
			}

		}

		if ($type == 'Moderated with Email Verification') {

			if ($user != null && ($registrationUserPeer->verifyUserByHash($user,$_GET['hash']))) {
				$smarty->assign('userVerified',$user);
			}
			else {
				$smarty->assign('error',true);
			}

		}

		return $mapping->findForwardConfig('success');

	}

}