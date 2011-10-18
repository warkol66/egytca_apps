<?php

class VialidadContractsViewXAction extends BaseAction {

	function VialidadContractsViewXAction() {
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
		$section = "Contracts";
		$smarty->assign("section",$section);

		$id = $_GET["id"];

		$contract = ContractPeer::get($id);
		$smarty->assign("contract",$contract);

		return $mapping->findForwardConfig('success');
	}

}
