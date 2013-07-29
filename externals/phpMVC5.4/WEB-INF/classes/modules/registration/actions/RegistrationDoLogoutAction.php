<?php

class RegistrationDoLogoutAction extends BaseAction {

	function RegistrationDoLogoutAction() {
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

		if(isset($_SESSION["loginRegistrationUser"]))
			unset($_SESSION["loginRegistrationUser"]);

		return $mapping->findForwardConfig('success');

	}

}
