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

		$filters = $_GET["filters"];
		$pager = ContractQuery::create()->createPager($filters, $_GET["page"], $filters["perPage"]);

		$url = "Main.php?do=vialidadContractsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		if (!empty($filters["contractorid"]))
			$smarty->assign("defaultContractorValue",ContractorQuery::create()->findPk($filters["contractorid"]));
		
		$smarty->assign("filters", $filters);
		$smarty->assign("contracts",$pager->getResults());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}
