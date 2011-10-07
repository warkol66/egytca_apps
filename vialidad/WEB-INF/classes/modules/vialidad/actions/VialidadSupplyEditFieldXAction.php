<?php

class VialidadSupplyEditFieldXAction extends BaseAction {

	function VialidadSupplyEditFieldXAction() {
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

		$module = "Vialidad";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		$supply = SupplyPeer::retrieveByPK($_POST['id']);
		
		if (!empty($_POST['paramName']) && !empty($_POST['paramValue'])) {
			$supply->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
			$supply->save();
		}
		
		if (!empty($_POST['paramName'])) {
			$smarty->assign("paramValue", $supply->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));
		}
		
		return $mapping->findForwardConfig('success');
	}

}
