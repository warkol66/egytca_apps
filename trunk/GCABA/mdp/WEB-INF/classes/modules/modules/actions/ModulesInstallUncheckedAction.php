<?php
/**
 * InstallUncheckedAction
 *
 * @package install
 */

require_once("includes/assoc_array2xml.php");

class ModulesInstallUncheckedAction extends BaseAction {

	function ModulesInstallUncheckedAction() {
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
		
		if (isset($_POST['modules']) && !empty($_POST['modules'])) {
			
			$languages = Common::getAllLanguages();
			$smarty->assign('languages',$languages);
			
			$smarty->assign('modules',$_POST['modules']);
			
			return $mapping->findForwardConfig('success');
		} else {
			$smarty->assign('noModules', true);
			return $mapping->findForwardConfig('success');
		}
	}

}
