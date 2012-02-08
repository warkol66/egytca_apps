<?php

class VialidadSourcesEditFieldXAction extends BaseAction {

	function VialidadSourcesEditFieldXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		$source = SourcePeer::retrieveByPK($_POST['id']);
		
		if (!empty($_POST['paramName']) && !empty($_POST['paramValue'])) {
			$source->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
			$source->save();
		}
		
		if (!empty($_POST['paramName'])) {
			$smarty->assign("paramValue", $source->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));
		}
		
		return $mapping->findForwardConfig('success');
	}

}
