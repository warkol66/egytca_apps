<?php

class VialidadSuppliersEditAction extends BaseAction {

	function VialidadSuppliersEditAction() {
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

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		if ($_GET['id']) {
			$supplier = SupplierQuery::create()->findPk($_GET["id"]);
			if (empty($supplier)) {
				$smarty->assign("notValidId","true");
				$supplier = new Supplier();
			}
			else
				$smarty->assign("action","edit");
		}
		else {
			$supplier = new Supplier();
			$smarty->assign("action","create");
		}
		$smarty->assign("supplier",$supplier);
		return $mapping->findForwardConfig('success');
	}
}