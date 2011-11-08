<?php

class VialidadMeasurementRecordsDoDeleteAction extends BaseAction {

	function VialidadMeasurementRecordsDoDeleteAction() {
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
		$section = "MeasurementRecords";
		$smarty->assign("section",$section);

		$record = MeasurementRecordQuery::create()->findPk($_POST["id"]);
		$record->delete();

		if ($record->isDeleted())
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('failure');

	}

}
