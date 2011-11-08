<?php

class VialidadMeasurementRecordRelationsEditFieldXAction extends BaseAction {

	function VialidadMeasurementRecordRelationsEditFieldXAction() {
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

		$relation = MeasurementRecordRelationQuery::create()->findOneById($_POST['id']);

		if (!empty($_POST['paramName']) && !empty($_POST['paramValue'])) {
			$relation->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
			$relation->save();
		}

		if (!empty($_POST['paramName']))
			$smarty->assign("paramValue", $relation->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));

		return $mapping->findForwardConfig('success');
	}

}
