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

		if (!empty($_GET['id'])) {

			$construction = ConstructionQuery::create()->findPK($_GET["id"]);
			if (is_null($construction)) {
				$smarty->assign('message', 'id inválido');
				$smarty->assign('url', $_SERVER['HTTP_REFERER']);
				return $mapping->findForwardConfig('failure');
			}
			$supplies = SupplyQuery::create()->filterByType(1)->find();
			$items = ConstructionItemQuery::create()->filterByConstruction($construction)->find();

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

			if ($_GET['action'] != 'show') {

				// crear el csv, y descargarlo.

				ob_end_clean();
				header("Content-type: text/csv;");
				header("Content-Disposition: attachment; filename=Reporte.csv");
				echo "\xEF\xBB\xBF"; // UTF-8 BOM

				global $system;

				$thousandsSeparator = $system['config']['system']['parameters']['thousandsSeparator'];
				$decimalSeparator = $system['config']['system']['parameters']['decimalSeparator'];
				$numberOfDecimals = $system['config']['system']['parameters']['numberOfDecimals'];

				$config = Common::getModuleConfiguration("system");
				if ($decimalSeparator == ".")
					$delimiter = ",";
				else
					$delimiter = ";";

				$lineFeed = "\r\n";

				// Document header
				print "Contrato: " . $construction->getContract().$lineFeed;
				print "Obra: " . $construction.$lineFeed;

				// table header
				print "Código" . $delimiter. "Item";

				foreach ($supplies as $supply)
					print $delimiter . '"' . $supply->getName(). '"';
				print $lineFeed;
				// table body
				foreach ($items as $item) {
					print $item->getName() . $delimiter . $item->getName();
					foreach ($supplies as $supply) {
						if ($decimalSeparator == ".")
							print $delimiter.$item->getProportionForSupply($supply).'%';
						else
							print $delimiter.number_format($item->getProportionForSupply($supply),$numberOfDecimals,$decimalSeparator,$thousandsSeparator).'%';
					}
					print $lineFeed;
				}
				return;

			} else {
				// ver el reporte en un tpl en el browser

				$this->template->template = 'TemplatePrint.tpl';

				$smarty->assign('construction', $construction);
				$smarty->assign('supplies', $supplies);
				$smarty->assign('items', $items);

				return $mapping->findForwardConfig("success");
			}
		} else {
			$smarty->assign('message', 'parámetros incorrectos');
			return $mapping->findForwardConfig('failure');
		}
	}
}
