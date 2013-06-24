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

		if (!empty($_GET['returnToContract']))
			{$smarty->assign('returnContractId', $_GET['returnToContract']);
			$contract = ContractQuery::create()->findOneById($_GET["returnToContract"]);
			 if (!empty($contract))
	  			 $smarty->assign('contract', $contract);}
		else
			{
			$contracts = ContractQuery::create()->find();
			$smarty->assign("contracts",$contracts);
			}


		if ($_GET['id']) {
			$construction =  ConstructionPeer::get($_GET['id']);
			if (empty($construction)) {
				$smarty->assign("notValidId","true");
				return $mapping->findForwardConfig('success');
			}
			else
				$smarty->assign("action","edit");
			$order = ConstructionItemQuery::create()->orderByOrder();
			$smarty->assign("items",$construction->getConstructionItems($order));
			
			$smarty->assign("fines", FineQuery::create()->filterByConstruction($construction)->find());
			
			$smarty->assign("dailyWorks", DailyWorkQuery::create()->filterByConstruction($construction)->find());
			
			$smarty->assign("adjustments", AdjustmentQuery::create()->filterByConstruction($construction)->find());

			$smarty->assign("others", OtherQuery::create()->filterByConstruction($construction)->find());

		}
		else {
			$construction = new Construction();
			$smarty->assign("action","create");
		}
		
		$smarty->assign("currencies",CurrencyQuery::create()->find());
		$smarty->assign("measureUnits",MeasureUnitQuery::create()->find());
		$smarty->assign("departments",DepartmentQuery::create()->find());
		$smarty->assign("types",ConstructionTypeQuery::create()->find());

		$smarty->assign("construction",$construction);

		$smarty->assign("termTypes",Contract::getTermTypes());
		return $mapping->findForwardConfig('success');
	}
}