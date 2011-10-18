<?php

class VialidadSuppliersViewXAction extends BaseAction {

	function VialidadSuppliersViewXAction() {
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

		$id = $_GET["id"];

		$supplier = SupplierPeer::get($id);
		$smarty->assign("supplier",$supplier);

		return $mapping->findForwardConfig('success');
	}

}
