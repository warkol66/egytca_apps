<?php

class VialidadAdvancePaymentInvoicesDoEditAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('AdvancePaymentInvoice');
	}

	protected function preUpdate() {
		parent::preUpdate();
			$this->entityParams['advancePayment'] = Common::convertToMysqlNumericFormat($this->entityParams['advancePayment']);
	}

}