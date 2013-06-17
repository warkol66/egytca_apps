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

		$certificates = CertificateQuery::create()
			->filterBySearchString($searchString)
			->_if($_GET['noCertificateInvoice'])
				->filterByHasNoCertificateInvoice()
			->_endif()
			->limit($_REQUEST['limit'])
			->find();

		$smarty->assign("certificates",$certificates);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
