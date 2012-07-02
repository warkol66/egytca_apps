<?php

require_once 'BaseListAction.php';

class PlanningConstructionsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('PlanningConstruction');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Constructions");
	}
}
