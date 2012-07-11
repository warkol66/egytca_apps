<?php

require_once 'BaseEditAction.php';

class PlanningMinistryObjectivesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('MinistryObjective');
	}
	
	protected function postEdit() {
		parent::postEdit();

		//Constantes y opciones posibles
		$this->smarty->assign("regions", RegionQuery::create()->filterByType('11')->find());
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		$this->smarty->assign("goalTypes", MinistryObjective::getGoalTypes());
		$this->smarty->assign("goalTrends", MinistryObjective::getGoalTrends());

		//Constantes y opciones posibles para la creación de indicadores
		$this->smarty->assign("planningIndicator", new PlanningIndicator());
		$this->smarty->assign("indicatorTypes", PlanningIndicator::getIndicatorTypes());
		$this->smarty->assign("measureFrecuencyTypes", PlanningIndicator::getMeasureFrecuencyTypes());
		$this->smarty->assign("expectedResultsTypes", PlanningIndicator::getExpectedResultsTypes());
		$this->smarty->assign("goalTypes", PlanningIndicator::getGoalTypes());
		$this->smarty->assign("trendTypes", PlanningIndicator::getTrendTypes());

		//Para asignar directamente el Objetivo de Impacto navegando desde ese objetivo
		if (isset($_GET["fromImpactObjectiveId"])) {
			$impactObjective = BaseQuery::create("ImpactObjective")->findOneById($_GET["fromImpactObjectiveId"]);
			if (!empty($impactObjective)) {
				$this->smarty->assign("impactObjective", $impactObjective);
				$this->smarty->assign("fromImpactObjectiveId", $_GET["fromImpactObjectiveId"]);
			}
		}

	}
}
