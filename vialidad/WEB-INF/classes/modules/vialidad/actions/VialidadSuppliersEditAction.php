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

		$module = "VialidadSuppliers";
		$smarty->assign("module",$module);

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		if ($_GET['id']) {
			$affiliate =  AffiliatePeer::get($_GET['id']);
			if (empty($affiliate)) {
				$smarty->assign("notValidId","true");
				$affiliate = new Affiliate();
			}
			else
				$smarty->assign("action","edit");
		}
		else {
			$affiliate = new Affiliate();
			$smarty->assign("action","create");
		}
		$smarty->assign("affiliate",$affiliate);
		return $mapping->findForwardConfig('success');
	}
}