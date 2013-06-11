<?php
/**
 * PlanningProjectsShowHistoryXAction
 *
 * Acceso a versiones de Proyectos (PlanningProject) extendiendo BaseEditAction
 *
 * @package    planning
 * @subpackage    planningProjects
 */
include_once 'BaseEditAction.php';

class PlanningProjectsShowHistoryXAction extends BaseEditAction {
    
	function __construct() {
		parent::__construct('PlanningProjectLog');
	}

	protected function postEdit() {
		parent::postEdit();

		// Si esta seteada $this->entity (PlanningProjectLog), se pasa en smarty a Project
		// para utilizar el mismo form de edicion
		if (!empty($this->entity))
			$this->smarty->assign("planningProject", $this->entity);

		$this->smarty->assign("showLog", true);
		//Constantes y opciones posibles
		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());
		$this->smarty->assign("ministryPriorities", PlanningProject::getMinistryPriorities());
		$this->smarty->assign("priorities", PlanningProject::getPriorities());

		//Constantes y opciones posibles para la creacion de indicadores
		$this->smarty->assign("planningIndicator", new PlanningIndicator());
		$this->smarty->assign("indicatorTypes", PlanningIndicator::getIndicatorTypes());
		$this->smarty->assign("measureFrecuencyTypes", PlanningIndicator::getMeasureFrecuencyTypes());
		$this->smarty->assign("expectedResultsTypes", PlanningIndicator::getExpectedResultsTypes());
		$this->smarty->assign("goalTypes", PlanningIndicator::getGoalTypes());
		$this->smarty->assign("trendTypes", PlanningIndicator::getTrendTypes());

	}
    
}
