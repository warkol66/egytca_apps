<?php

class VialidadConstructionItemListAction extends BaseAction {

	function VialidadConstructionItemListAction() {
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
		$section = "ConstructionItem";
		$smarty->assign("section",$section);

		$smarty->assign("message",$_GET["message"]);

		$filters = $_GET["filters"];

    if (!isset($filters["perPage"]))
			$filters["perPage"] = Common::getRowsPerPage();

		$pager = ConstructionItemQuery::create()->createPager($filters, $_GET["page"], $filters["perPage"]);
		
		$url = "Main.php?do=vialidadConstructionItemList";
		foreach ($filters as $key => $value)
			if(is_array($value)) {
				$nKey = $key;
				foreach ($value as $key => $value)
					$url .= "&filters[$nKey][$key]=" . htmlentities(urlencode($value));
			}
			$url .= "&filters[$key]=" . htmlentities(urlencode($value));
		$smarty->assign("url",$url);
		
		if (!empty($filters["constructionid"]))
			$smarty->assign("defaultConstructionValue",ConstructionQuery::create()->findPk($filters["constructionid"]));
		
		if (!empty($filters["contractid"]))
			$smarty->assign("defaultContractValue",ContractQuery::create()->findPk($filters["contractid"]));

		$smarty->assign("filters",$filters);
		$smarty->assign("items",$pager->getResults());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig("success");
	}
		
}
