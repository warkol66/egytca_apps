<?php

class VialidadConstructionsListAction extends BaseAction {

	function VialidadConstructionsListAction() {
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
		$section = "Constructions";
		$smarty->assign("section",$section);

		$smarty->assign("message",$_GET["message"]);

		$filters = $_GET["filters"];
		$pager = ConstructionQuery::create()->createPager($filters, $_GET["page"], $filters["perPage"]);

		$url = "Main.php?do=vialidadConstructionsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);
		
		if (!empty($filters["contractid"]))
			$smarty->assign("defaultContractValue",ContractQuery::create()->findPk($filters["contractid"]));
		
		if (!empty($filters["verifierid"]))
			$smarty->assign("defaultVerifierValue",VerifierQuery::create()->findPk($filters["verifierid"]));

		$smarty->assign("filters", $filters);
		$smarty->assign("constructions",$pager->getResults());
		$smarty->assign("pager",$pager);

		if ($_GET['toPrint']) {
			$this->template->template = 'TemplatePrint.tpl';
			$smarty->assign('toPrint', true);
		}
		return $mapping->findForwardConfig('success');
	}

}
