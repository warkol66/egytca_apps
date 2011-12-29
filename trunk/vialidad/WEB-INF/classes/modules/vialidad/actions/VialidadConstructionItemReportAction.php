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
		
		/* Cosas para usar el ExcelManagement. No probadas. No pensadas a fondo
		
		$dataMatrix = array();
		foreach ($items as $item) {
			$newRow = array($item->getName());
			foreach ($supplies as $supply) {
				$newRow[] = $item->getProportionForSupply($supply);
			}
			$dataMatrix[] = $newRow;
		}
		
		$excelManagment = new ExcelManagement();
		$excelManagment->setTableHeaders($supplies->toArray('name'));
		$excelManagment->setData($dataMatrix);
		$excelManagment->sendToClient();
		
		fin cosas para usar el ExcelManagement */
		
		// Cosas para crear el csv, y descargarlo.
		// Si queda esto el Action probablemente deberia tener un Do por algun lado
		ob_end_clean();
		header('Content-type: text/csv');
		header('Content-Disposition: attachment; filename="reporte.csv"');
		$delimiter = ',';
		// table header
		foreach ($supplies as $supply)
			print $delimiter.$supply->getName();
		print "\n";
		// table body
		foreach ($items as $item) {
			print $item->getName();
			foreach ($supplies as $supply)
				print $delimiter.$item->getProportionForSupply($supply).' %';
			print "\n";
		}
		return;
		// fin cosas para crear el csv
		
		/* Cosas para ver el reporte en un template en el browser
		
		$this->template->template = 'TemplatePrint.tpl';
		
		$smarty->assign('supplies', $supplies);
		$smarty->assign('items', $items);

		return $mapping->findForwardConfig("success");
		
		fin cosas para ver el reporte */
	}
		
}
