<?php

class RegistrationDoImportUsersAction extends BaseAction {

	function RegistrationDoImportUsersAction() {
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

		$registrationImporter = new RegistrationImporter($_FILES['users']['tmp_name']);
		$report = $registrationImporter->performImport();

		$smarty->assign('report',$report);

		return $mapping->findForwardConfig('success');


	}

}
