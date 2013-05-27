<?php
/**
 * VialidadInvoicesDoEditAction
 *
 * Crea o guarda cambios de Facturas (Invoice)
 *
 * @package    vialidad
 * @subpackage    invoices
 */

class VialidadInvoicesDoEditAction extends BaseAction {

	function VialidadInvoicesDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$id = $request->getParameter("id");
		$params = $_POST["params"];

		if (isset($params["advancePayment"]))
			$params["advancePayment"] = Common::convertToMysqlNumericFormat($params["advancePayment"]);
		if (isset($params["advancePaymentRecovery"]))
			$params["advancePaymentRecovery"] = Common::convertToMysqlNumericFormat($params["advancePaymentRecovery"]);
		if (isset($params["withholding"]))
			$params["withholding"] = Common::convertToMysqlNumericFormat($params["withholding"]);
		if (isset($params["totalPrice"]))
			$params["totalPrice"] = Common::convertToMysqlNumericFormat($params["totalPrice"]);

		if (!empty($id))
			$invoice = BaseQuery::create("Invoice")->findOneByID($id);
		else
			$invoice = new Invoice();

		$invoice->fromArray($params, BasePeer::TYPE_FIELDNAME);

		try {
			$invoice->save();
			if (isset($invoiceLog)) {
				try {
					$invoiceLog->save();
				} catch (Exception $e) {
					if (ConfigModule::get("global","showPropelExceptions")) {
						print_r($e->__toString());
					}
				}
			}
		} catch (Exception $e) {
			if (ConfigModule::get("global","showPropelExceptions")) {
				print_r($e->__toString());
			}
			return $this->returnFailure($mapping, $smarty, $this->entity, 'failure-edit');
		}

		if (isset($id))
			$logSufix = ', ' . Common::getTranslation('action: create','common');
		else
			$logSufix = ', ' . Common::getTranslation('action: edit','common');

		Common::doLog('success', $invoice->getContractorNumber() . $logSufix);

		$params = array();
		$params["id"] = $invoice->getId();
		return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success-edit');

	}

}
