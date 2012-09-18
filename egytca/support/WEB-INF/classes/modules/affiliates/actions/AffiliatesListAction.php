<?php

require_once 'BaseListAction.php';

class AffiliatesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Affiliate');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Affiliates";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
	}
}
