<?php

class ModulesListAction extends BaseAction {

	function ModulesListAction() {
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

		$message=$_GET["message"];
		$smarty->assign("message",$message);

		$installedModules = $modulePeer->getAll();
		$smarty->assign("installedModules",$installedModules);
		
		return $mapping->findForwardConfig('success');
	}

}
