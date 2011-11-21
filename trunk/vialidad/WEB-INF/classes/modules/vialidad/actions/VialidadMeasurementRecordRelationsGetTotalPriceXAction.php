<?php

class VialidadMeasurementRecordRelationsGetTotalPriceXAction extends BaseAction {

	function VialidadMeasurementRecordRelationsGetTotalPriceXAction() {
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
		$section = "MeasurementRecordRelations";
		$smarty->assign("section",$section);

		if (!empty($_POST['id']))
			$relation = MeasurementRecordRelationQuery::create()->findPk($_POST["id"]);

		$smarty->assign("totalPrice",$relation->getTotalPrice());
		return $mapping->findForwardConfig('success');
	}
}