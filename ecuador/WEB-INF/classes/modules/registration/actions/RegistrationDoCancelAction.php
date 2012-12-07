<?php

class RegistrationDoCancelAction extends BaseAction {

	function RegistrationDoCancelAction() {

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

		$user = RegistrationUserQuery::create()->findOneByVerificationhash($_GET["hash"]);

		if ($user != null  ) {
			try{
				// Cuando un objeto es archivable y timespable no se borra correctamente.
				$user->delete();
				$smarty->assign('error', false);
			}
			catch(Exception $e){
				$smarty->assign('error', true);
			}
		} else $smarty->assign('error', true);

		return $mapping->findForwardConfig('success');
	}

}