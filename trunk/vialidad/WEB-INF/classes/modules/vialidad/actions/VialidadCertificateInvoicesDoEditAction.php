<?php

class VialidadCertificateInvoicesDoEditAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('CertificateInvoice');
	}
	
	protected function preUpdate() {
		
		if (isset($this->entityParams["advancePayment"]))
			$this->entityParams["advancePayment"] = Common::convertToMysqlNumericFormat($this->entityParams["advancePayment"]);
		if (isset($this->entityParams["advancePaymentRecovery"]))
			$this->entityParams["advancePaymentRecovery"] = Common::convertToMysqlNumericFormat($this->entityParams["advancePaymentRecovery"]);
		if (isset($this->entityParams["withholding"]))
			$this->entityParams["withholding"] = Common::convertToMysqlNumericFormat($this->entityParams["withholding"]);
		if (isset($this->entityParams["totalPrice"]))
			$this->entityParams["totalPrice"] = Common::convertToMysqlNumericFormat($this->entityParams["totalPrice"]);
		
		parent::preUpdate();
	}
}