<?php

class RegistrationPasswordRecoveryAction extends BaseAction {

	function RegistrationPasswordRecoveryAction() {

	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);



		$loggedUser = Common::getLoggedUser();

		if (!$loggedUser || get_class($loggedUser) != "User")
			$this->template->template = "TemplatePublic.tpl";

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Registration";

		return $mapping->findForwardConfig('success');
	}

}
