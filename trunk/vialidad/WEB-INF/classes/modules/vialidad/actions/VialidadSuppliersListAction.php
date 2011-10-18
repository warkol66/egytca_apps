<?php

class VialidadSuppliersListAction extends BaseAction {

	function VialidadSuppliersListAction() {
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

		$smarty->assign("message",$_GET["message"]);

		$supplierPeer = new SupplierPeer;
		$filters = $_GET["filters"];

		$this->applyFilters($supplierPeer, $filters, $smarty);

		$pager = $supplierPeer->getAllPaginatedFiltered($_GET["page"]);

		$url = "Main.php?do=vialidadSuppliersList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("suppliers",$pager->getResult());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}
