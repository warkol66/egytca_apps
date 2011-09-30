<?php

class ModulesEditAction extends BaseAction {

	function ModulesEditAction() {
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

		$modulo = "Modules";
		$smarty->assign("modulo",$modulo);

		$modulePeer = new ModulePeer();

		$moduleName = $_GET["moduleName"];
		$currentModule = $modulePeer->get($moduleName);

		if(is_null($currentModule))
			$smarty->assign("notValidId",true);

		$smarty->assign("currentModule",$currentModule);

		return $mapping->findForwardConfig('success');
	}

}
