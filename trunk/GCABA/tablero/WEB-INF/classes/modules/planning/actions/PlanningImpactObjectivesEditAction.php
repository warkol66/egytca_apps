<?php

require_once 'BaseEditAction.php';

class PlanningImpactObjectivesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('ImpactObjective');
	}
	
	protected function postEdit() {
		parent::postEdit();

		//Constantes y opciones posibles
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		$this->smarty->assign("policyGuidelines", ImpactObjective::getPolicyGuidelines());
		$this->smarty->assign("expectedResults", ImpactObjective::getExpectedResults());
		// TODO
		// if ($this->entity->isNew())
		// {
		// 	$this->entity->setResponsibleCode()=$positionCode;

		// }
		//Constantes y opciones posibles para la creación de indicadores
		$this->smarty->assign("planningIndicator", new PlanningIndicator());
		$this->smarty->assign("indicatorTypes", PlanningIndicator::getIndicatorTypes());
		$this->smarty->assign("measureFrecuencyTypes", PlanningIndicator::getMeasureFrecuencyTypes());
		$this->smarty->assign("expectedResultsTypes", PlanningIndicator::getExpectedResultsTypes());
		$this->smarty->assign("goalTypes", PlanningIndicator::getGoalTypes());
		$this->smarty->assign("trendTypes", PlanningIndicator::getTrendTypes());

	}
}
