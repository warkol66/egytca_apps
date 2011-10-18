<?php

class VialidadSuppliersAutocompleteListXAction extends BaseAction {

	function VialidadSuppliersAutocompleteListXAction() {
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
		$section = "Suppliers";
		$smarty->assign("section",$section);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);


		$filters = array("searchString" => $searchString, "limit" => $_REQUEST['limit']);

		$supplierPeer = new SupplierPeer();
		$this->applyFilters($supplierPeer,$filters);
		$supplier = $supplierPeer->getAll();

		$smarty->assign("supplier",$supplier);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
