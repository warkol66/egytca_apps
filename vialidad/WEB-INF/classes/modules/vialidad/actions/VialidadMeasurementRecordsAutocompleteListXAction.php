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

		$recordsQuery = MeasurementRecordQuery::create()->useConstructionQuery()
			->where('Construction.Name LIKE ?', "%" . $searchString . "%")
			->endUse()->limit($_REQUEST['limit']);
		
		if ($_GET['noCertificate']) {
			$existentCertificates = CertificateQuery::create()->find();
			foreach ($existentCertificates as $existentCertificate)
				$recordsQuery->filterByCertificate($existentCertificate, Criteria::NOT_EQUAL);
		}
		
		$records = $recordsQuery->find();

		$smarty->assign("records",$records);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
