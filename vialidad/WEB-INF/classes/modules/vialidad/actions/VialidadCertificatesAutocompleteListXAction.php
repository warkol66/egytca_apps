<?php

class VialidadCertificatesAutocompleteListXAction extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$certificatesQuery = CertificateQuery::create()->useMeasurementRecordQuery()->useConstructionQuery()
			->where('Construction.Name LIKE ?', "%" . $searchString . "%")
			->endUse()->endUse()->limit($_REQUEST['limit']);
		
		if ($_GET['noCertificateInvoice']) {
			$existentCertificateInvoices = CertificateInvoiceQuery::create()->find();
			foreach ($existentCertificateInvoices as $existentCertificateInvoice)
				$certificatesQuery->filterByInvoice($existentCertificateInvoice, Criteria::NOT_EQUAL);
		}
		
		$certificates = $certificatesQuery->find();

		$smarty->assign("certificates",$certificates);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
