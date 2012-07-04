<?php

require_once 'BaseEditAction.php';

class PlanningImpactObjectivesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('ImpactObjective','Planning');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		$this->smarty->assign("policyGuidelines", ImpactObjective::getPolicyGuidelines());
		$this->smarty->assign("expectedResults", ImpactObjective::getExpectedResults());
		
		//Para la creación de indicadores
		$this->smarty->assign("planningIndicator", new PlanningIndicator());
		$this->smarty->assign("indicatorTypes", PlanningIndicator::getIndicatorTypes());

	}
}
