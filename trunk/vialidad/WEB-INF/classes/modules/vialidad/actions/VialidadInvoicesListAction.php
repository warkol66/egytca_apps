<?php

class VialidadInvoicesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Invoice');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Actor";
	}

	protected function postList() {
		parent::postList();
	}
}