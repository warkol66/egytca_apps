<?php

require_once 'BaseListAction.php';

class PlanningIndicatorsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('PlanningIndicator');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Indicators");
	}
}
