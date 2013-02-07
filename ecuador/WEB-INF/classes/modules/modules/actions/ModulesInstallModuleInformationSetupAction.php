<?php
/**
 * InstallModuleInformationSetupAction
 *
 * @package install
 */

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

		if (!isset($_GET['moduleName']))
			return $mapping->findForwardConfig('failure');

		return $mapping->findForwardConfig('success');
	}

}
