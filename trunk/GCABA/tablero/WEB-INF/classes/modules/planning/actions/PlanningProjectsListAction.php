<?php

require_once 'BaseListAction.php';

class PlanningProjectsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('PlanningProject');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Projects");
	}
}
