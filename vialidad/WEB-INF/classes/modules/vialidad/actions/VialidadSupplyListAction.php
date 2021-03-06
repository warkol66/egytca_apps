<?php

// TODO: Filtros no andan.

class VialidadSupplyListAction extends BaseAction {

	function VialidadSupplyListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = 'Vialidad';
		$smarty->assign('module',$module);

		$filters = $_GET["filters"];
		$pager = SupplyQuery::create()->filterByType(1)->createPager($filters, $_GET["page"], $filters["perPage"]);
		
		$smarty->assign('filters', $filters);
		$smarty->assign('supplies',$pager->getResults());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=vialidadSupplyList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		
		$units = MeasureUnitQuery::create()->find();	
		$smarty->assign('units',$units);
		
		return $mapping->findForwardConfig('success');
	}
	
}
