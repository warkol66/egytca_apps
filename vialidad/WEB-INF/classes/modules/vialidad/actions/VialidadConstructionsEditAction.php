<?php

class VialidadConstructionsEditAction extends BaseAction {

	function VialidadConstructionsEditAction() {
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

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		$contracts = ContractQuery::create()->find();
		$smarty->assign("contracts",$contracts);

		if ($_GET['id']) {
			$construction =  ConstructionPeer::get($_GET['id']);
			if (empty($construction)) {
				$smarty->assign("notValidId","true");
				return $mapping->findForwardConfig('success');
			}
			else
				$smarty->assign("action","edit");
			
			$items = $construction->getConstructionItems();
			$smarty->assign("items",$items);
			
			$fines = FineQuery::create()->filterByConstruction($construction)->find();
			$smarty->assign("fines", $fines);
			
			$dailyWorks = DailyWorkQuery::create()->filterByConstruction($construction)->find();
			$smarty->assign('dailyWorks', $dailyWorks);
			
			$adjustments = AdjustmentQuery::create()->filterByConstruction($construction)->find();
			$smarty->assign('adjustments', $adjustments);
		}
		else {
			$construction = new Construction();
			$smarty->assign("action","create");
		}
		
		if (!empty($_GET['returnToContract']))
			$smarty->assign('returnContractId', $_GET['returnToContract']);
		
		$smarty->assign("departments",DepartmentQuery::create()->find());
		$smarty->assign("types",ConstructionTypeQuery::create()->find());

		$smarty->assign("construction",$construction);
		return $mapping->findForwardConfig('success');
	}
}