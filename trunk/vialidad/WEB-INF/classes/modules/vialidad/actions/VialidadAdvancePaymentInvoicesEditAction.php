<?php

class VialidadAdvancePaymentInvoicesEditAction extends BaseEditAction {
	
	public function __construct() {
		parent::__construct('AdvancePaymentInvoice');
	}
	
	protected function postEdit() {
		parent::postEdit();
		if (!empty($_GET['returnToInvoicesList']))
			$this->smarty->assign('returnToInvoicesList', true);
	}
}