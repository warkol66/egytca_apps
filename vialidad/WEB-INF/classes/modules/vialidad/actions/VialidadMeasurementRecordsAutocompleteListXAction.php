<?php

class VialidadMeasurementRecordsAutocompleteListXAction extends BaseAction {

	function VialidadMeasurementRecordsAutocompleteListXAction() {
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
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$records = MeasurementRecordQuery::create()
			->filterBySearchString($searchString)
			->_if($_GET['noCertificate'])
				->filterByHasNoCertificate()
			->_endif()
			->_if($_GET['noInvoice'])
				->filterByHasNoInvoice()
			->_endif()
			->limit($_REQUEST['limit'])
			->find();

		$smarty->assign("records",$records);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
