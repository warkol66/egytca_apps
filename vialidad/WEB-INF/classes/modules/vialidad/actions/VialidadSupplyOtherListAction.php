<?php

class VialidadSupplyOtherListAction extends BaseAction {

	function VialidadSupplyOtherListAction() {
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

    if (!isset($filters["perPage"]))
			$filters["perPage"] = Common::getRowsPerPage();

		$pager = SupplyQuery::create()->filterByType(2)->createPager($filters, $_GET["page"], $filters["perPage"]);
		
		$smarty->assign('filters', $filters);
		$smarty->assign('supplies',$pager->getResults());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=vialidadSupplyOtherList";
		foreach ($filters as $key => $value)
			if(is_array($value)) {
				$nKey = $key;
				foreach ($value as $key => $value)
					$url .= "&filters[$nKey][$key]=" . htmlentities(urlencode($value));
			}
			$url .= "&filters[$key]=" . htmlentities(urlencode($value));
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		
		$units = MeasureUnitQuery::create()->find();
		/*
		$allUnits = array();
		foreach (ConfigModule::get('vialidad', 'units') as $unit => $desc) {
			array_push($allUnits, $unit);
		}
		$smarty->assign('allUnits', $allUnits);*/
		
		$smarty->assign('units', $units);
		
		return $mapping->findForwardConfig('success');
	}
	
}
