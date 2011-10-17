<?php

class VialidadSuppliersDoDeleteAction extends BaseAction {

	function VialidadSuppliersDoDeleteAction() {
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

		$affiliate = AffiliatePeer::get($_POST["id"]);

		if ($affiliate->delete())
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('failure');

		return $mapping->findForwardConfig('success');
	}

}
