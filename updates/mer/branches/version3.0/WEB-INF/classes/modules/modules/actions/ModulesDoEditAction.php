<?php

class ModulesDoEditAction extends BaseAction {

	function ModulesDoEditAction() {
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

		$modulePeer = new ModulePeer();

		$moduleName = $_POST["moduleName"];
		$description = $_POST["description"];
		$label = $_POST["label"];

		$updateModule= $modulePeer->updateModule($moduleName,$description,$label);

		return $mapping->findForwardConfig('success');
	}

}
