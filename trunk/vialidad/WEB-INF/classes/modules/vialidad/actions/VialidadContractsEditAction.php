<?php

class VialidadContractsEditAction extends BaseAction {

	function VialidadContractsEditAction() {
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

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		$smarty->assign("types",Contract::getTypes());
		$smarty->assign("termTypes",Contract::getTermTypes());


		if ($_GET['id']) {
			$contract =  ContractPeer::get($_GET['id']);
			if (empty($contract)) {
				$smarty->assign("notValidId","true");
				return $mapping->findForwardConfig('success');
			}
			else
				$smarty->assign("action","edit");

			$constructions = $contract->getConstructions();
			$smarty->assign("constructions",$constructions);

		}
		else {
			$contract = new Contract();
			$smarty->assign("action","create");
		}
		$smarty->assign("contract",$contract);
		$smarty->assign("currencies",CurrencyQuery::create()->find());
		return $mapping->findForwardConfig('success');
	}
}