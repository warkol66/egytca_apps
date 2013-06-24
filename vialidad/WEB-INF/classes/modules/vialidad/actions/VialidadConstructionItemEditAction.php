<?php

class VialidadConstructionItemEditAction extends BaseAction {

	function VialidadConstructionItemEditAction() {
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
		
		if (!empty($_GET["id"])) {
			//voy a editar un objeto
			$item = ConstructionItemQuery::create()->findOneById($_GET["id"]);
			if (is_null($item)) {
				$smarty->assign("notValidId", "true");
				return $mapping->findForwardConfig('success');
			}
			
			$components = ConstructionItemRelationQuery::create()->filterByConstructionItem($item)->find();
			$allSupplies = SupplyQuery::create()->find();
			
			$smarty->assign('components', $components);
			$smarty->assign('allSupplies', $allSupplies);
			$smarty->assign('action', 'edit');
			
		} else {
			//voy a crear un objeto nuevo
			$item = new ConstructionItem();
			$smarty->assign('action', 'create');
		}
		
		$units = MeasureUnitQuery::create()->find();
		/*
		$units = array();
		foreach (ConfigModule::get('vialidad', 'units') as $unit => $desc) {
			array_push($units, $unit);
		}*/
		
		if (!empty($_REQUEST['constructionId']))
			$smarty->assign('constructionId', $_REQUEST['constructionId']);
		
		if (!empty($_GET['returnToConstruction']))
			$smarty->assign('returnConstructionId', $_GET['returnToConstruction']);

		if (!empty($_REQUEST['returnConstructionId']))
			$smarty->assign('returnConstructionId', $_REQUEST['returnConstructionId']);

		$smarty->assign('units', $units);
		$smarty->assign('message', $_GET['message']);
		$smarty->assign('item', $item);
		
		if ($_GET['toPrint']) {
			$this->template->template = 'TemplatePrint.tpl';
			$smarty->assign('toPrint', true);
		}
		return $mapping->findForwardConfig('success');
	}

}
