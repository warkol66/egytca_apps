<?php

require_once 'BaseEditAction.php';

class PlanningOperativeObjectivesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('OperativeObjective');
	}
	
	protected function postEdit() {
		parent::postEdit();

		//Constantes y opciones posibles
		$this->smarty->assign("productKinds", OperativeObjective::getProductKinds());
		$this->smarty->assign("populationGenders", OperativeObjective::getPopulationGender());
		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());

		//Constantes y opciones posibles para la creación de indicadores
		$this->smarty->assign("planningIndicator", new PlanningIndicator());
		$this->smarty->assign("indicatorTypes", PlanningIndicator::getIndicatorTypes());
		$this->smarty->assign("measureFrecuencyTypes", PlanningIndicator::getMeasureFrecuencyTypes());
		$this->smarty->assign("expectedResultsTypes", PlanningIndicator::getExpectedResultsTypes());
		$this->smarty->assign("goalTypes", PlanningIndicator::getGoalTypes());
		$this->smarty->assign("trendTypes", PlanningIndicator::getTrendTypes());

		//Para asignar directamente el Objetivo Ministerial navegando desde ese objetivo
		if (isset($_GET["fromMinistryObjectiveId"])) {
			$ministryObjective = BaseQuery::create("MinistryObjective")->findOneById($_GET["fromMinistryObjectiveId"]);
			if (!empty($ministryObjective)) {
				$this->entity->setMinistryObjectiveId($_GET["fromMinistryObjectiveId"]);
				$this->smarty->assign("ministryObjective", $this->entity);

				$this->smarty->assign("ministryObjective", $ministryObjective);
				$this->smarty->assign("fromMinistryObjectiveId", $_GET["fromMinistryObjectiveId"]);
			}
		}

	}
}
