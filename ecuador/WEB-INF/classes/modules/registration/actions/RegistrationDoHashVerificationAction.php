<?php

class RegistrationDoHashVerificationAction extends BaseAction {

	function RegistrationDoHashVerificationAction() {

	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if ($smarty == NULL) {
			echo 'No PlugIn found matching key: ' . $plugInKey . "<br>\n";
		}

		$module = "Registration";
		$smarty->assign("module", $module);

		$loggedUser = Common::getLoggedUser();

		if (!$loggedUser || get_class($loggedUser) != "User")
			$this->template->template = "TemplatePublic.tpl";

		$type = Common::getRegistrationMode();

		if (($type == 'Moderated') || ($type == 'Open')) {
			//si estan activos estos tipos, no hay verificacion
			return $mapping->findForwardConfig('disabled');
		}

		$user = RegistrationUserQuery::create()->findOneByVerificationhash($_GET["hash"]);

		if ($type == 'Email Verification') {

			if ($user != null) {
				$user->setVerified(1);
				$user->setActive(1);
				$user->setVerificationhash("");
				$user->save();
				$smarty->assign('userActive', $user);
			} else {
				$smarty->assign('error', true);
			}

		}

		if ($type == 'Moderated with Email Verification') {

			if ($user != null) {
				$user->setVerified(1);
				$user->setVerificationhash("");
				$user->save();
				$smarty->assign('userVerified', $user);
			} else {
				$smarty->assign('error', true);
			}

		}

		return $mapping->findForwardConfig('success');

	}

}