<?php
/**
 * ModulesInstallModuleInformationSetupAction
 *
 * @package modules
 */

require_once("includes/assoc_array2xml.php");

class ModulesInstallModuleInformationSetupAction extends BaseAction {

	function ModulesInstallModuleInformationSetupAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Install";
		$smarty->assign("module",$module);

		$modulePeer = new ModulePeer();

		if (!isset($_GET['moduleName']))
			return $mapping->findForwardConfig('failure');

		if (!isset($_GET['reinstall']))
			return $mapping->findForwardConfig('success');
	}

}
