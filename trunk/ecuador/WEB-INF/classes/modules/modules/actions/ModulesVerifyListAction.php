<?php

require_once 'ModuleVerify.class.php';

class ModulesVerifyListAction extends BaseAction {

	function ModulesVerifyListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = "Modules";
		$smarty->assign("module",$module);
		
		$smarty->assign("moduleColl",ModuleVerify::getDirs());
		
		return $mapping->findForwardConfig('success');
	}

}
