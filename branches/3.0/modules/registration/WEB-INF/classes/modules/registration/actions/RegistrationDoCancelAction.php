<?php

class RegistrationDoCancelAction extends BaseAction {

	function RegistrationDoCancelAction() {
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

		if ($user != null && ($registrationUserPeer->cancelUserByHash($user,$_GET['hash']))) {
			$smarty->assign('error',false);
		}
		else {
			$smarty->assign('error',true);
		}

		return $mapping->findForwardConfig('success');

	}

}