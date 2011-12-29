<?php

class VialidadConstructionItemReportAction extends BaseAction {

	function VialidadConstructionItemReportAction() {
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

		$supplies = SupplyQuery::create()->find();
		$items = ConstructionItemQuery::create()->find();
		
		$this->template->template = 'TemplatePrint.tpl';
		
		$smarty->assign('supplies', $supplies);
		$smarty->assign('items', $items);

		return $mapping->findForwardConfig("success");
	}
		
}
