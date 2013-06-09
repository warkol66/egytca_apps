<?php

class VialidadCertificateInvoicesEditAction extends BaseEditAction {
	
	public function __construct() {
		parent::__construct('CertificateInvoice', 'Vialidad');
	}
	
	protected function postEdit() {
		parent::postEdit();
		
		if (!empty($_GET['returnToInvoicesList']))
			$this->smarty->assign('returnToInvoicesList', true);
		
		if (!$this->entity->isNew())
			$this->smarty->assign('calculatedValues', $this->entity->calculateValues());
	}
}