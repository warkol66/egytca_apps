<?php

class VialidadInvoicesViewXAction extends BaseAction {

	function VialidadInvoicesViewXAction() {
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
		$section = "Invoices";
		$smarty->assign("section",$section);

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		if ($_GET['id']) {
			$invoice = InvoiceQuery::create()->findPk($_GET["id"]);
			if (empty($invoice)) {
				$smarty->assign("notValidId","true");
				return $mapping->findForwardConfig('success');
			}
			else {

				$certificate = $invoice->getCertificate();
				
				$relations = MeasurementRecordRelationQuery::create()
					->filterByMeasurementrecordid($certificate->getMeasurementrecordid())
					->useConstructionItemQuery()
					->filterByClassKey(ConstructionItemPeer::CLASSKEY_CONSTRUCTIONITEM)
					->endUse()
					->find();

				$smarty->assign("relations", $relations);
			}
		}

		$smarty->assign("invoice",$invoice);
		return $mapping->findForwardConfig('success');
	}
}