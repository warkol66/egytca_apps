<?php

class VialidadContractsListAction extends BaseAction {

	function VialidadContractsListAction() {
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

		$smarty->assign("message",$_GET["message"]);

		$contractPeer = new ContractPeer;
		$filters = $_GET["filters"];

		$this->applyFilters($contractPeer, $filters, $smarty);

		$pager = $contractPeer->getAllPaginatedFiltered($_GET["page"]);

		$url = "Main.php?do=vialidadContractsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("contracts",$pager->getResult());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}
