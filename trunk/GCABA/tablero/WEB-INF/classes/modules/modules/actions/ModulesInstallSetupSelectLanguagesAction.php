<?php
/**
 * InstallSetupModuleInformationAction
 *
 * @package install
 */

require_once("includes/assoc_array2xml.php");

class ModulesInstallSetupSelectLanguagesAction extends BaseAction {

	function ModulesInstallSetupSelectLanguagesAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		global $PHP_SELF;
		//////////
		// Call our business logic from here

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
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

		$languages = Common::getAllLanguages();
		$smarty->assign('languages',$languages);

		$smarty->assign('nextDo',$_GET['nextDo']);
		$smarty->assign('moduleName',$_GET['moduleName']);

		$smarty->assign('mode',$_GET['mode']);

		return $mapping->findForwardConfig('success');
	}

}
