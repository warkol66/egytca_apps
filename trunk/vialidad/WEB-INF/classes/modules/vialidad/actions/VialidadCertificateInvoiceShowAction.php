<?php

class VialidadCertificateInvoiceShowAction extends BaseEditAction {
	
	public function __construct() {
		parent::__construct('CertificateInvoice', 'Vialidad');
	}

	function execute($mapping, $form, &$request, &$response) {
		
		if (empty($_GET['hack-create-one'])) {
		
			return parent::execute($mapping, $form, $request, $response);
			
		} else {

			BaseAction::execute($mapping, $form, $request, $response);

			$smarty =& $this->actionServer->getPlugIn('SMARTY_PLUGIN');

			$invoice = CertificateInvoiceQuery::create()->findOneOrCreate();
			$invoice->setCertificate(CertificateQuery::create()->findOne());
			$invoice->setStatus('paid');
			
			$contractId = $invoice->getCertificate()->getMeasurementRecord()->getConstruction()->getContractid();
			$advancePaymentInvoice = AdvancePaymentInvoiceQuery::create()->filterByContractId($contractId)->findOneOrCreate();
			$advancePaymentInvoice->setAdvancepayment(50);
			$advancePaymentInvoice->save();
			
			$invoice->save();

			$smarty->assign('certificateInvoice', $invoice);

			return $mapping->findForwardConfig('success');
		}
	}
}
