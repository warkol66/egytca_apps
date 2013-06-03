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

		if ($_GET['noCertificate'])
			$existentCertificates = CertificateQuery::create()->select('Id')->find();

		if ($_GET['noInvoice']) {
			$existentInvoices = InvoiceQuery::create()->select('Id')->find();
			$existentCertificates = CertificateQuery::create()
																				->useInvoiceQuery()
																					->filterByid($existentInvoices, Criteria::NOT_IN)
																				->endUse()
																		->select('Id')
																		->find();
		}

		$recordsQuery = MeasurementRecordQuery::create()
												->useConstructionQuery()
													->where('Construction.Name LIKE ?', "%" . $searchString . "%")
												->endUse()
												->useCertificateQuery()
													->filterByid($existentCertificates, Criteria::NOT_IN)
												->endUse()
												->limit($_REQUEST['limit']);

		$records = $recordsQuery->find();

		$smarty->assign("records",$records);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
