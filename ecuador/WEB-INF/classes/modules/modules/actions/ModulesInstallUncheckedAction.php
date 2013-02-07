<?php
/**
 * InstallUncheckedAction
 *
 * @package install
 */

class ModulesInstallUncheckedAction extends BaseAction {

	function ModulesInstallUncheckedAction() {
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

		if (isset($_POST['modules']) && !empty($_POST['modules'])) {

			$languages = Common::getAllLanguages();
			$smarty->assign('languages',$languages);
			$smarty->assign('modules',$_POST['modules']);
			return $mapping->findForwardConfig('success');
		}
		else {
			$smarty->assign('noModules', true);
			return $mapping->findForwardConfig('success');
		}
	}

}
