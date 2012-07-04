<?php

require_once 'BaseEditAction.php';

class PlanningIndicatorsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningIndicator','Planning');
	}

	protected function preEdit() {
		parent::preEdit();
		$this->module = "Planning";
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Indicators");
		$this->smarty->assign("indicatorTypes", PlanningIndicator::getIndicatorTypes());
	}
}
