<?php
/**
 * PanelProjectsEditAction
 *
 * Formulario de modificacion de Proyectos (PlanningProject) extendiendo BaseEditAction
 *
 * @package    panel
 * @subpackage    planningProjects
 */
require_once 'BaseEditAction.php';

class PanelProjectsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningProject');
	}
	
	protected function postEdit() {
		parent::postEdit();

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
		
		$this->smarty->assign('planningProjectTags',PlanningProjectTagQuery::create()->find());

		$this->smarty->assign("maxUploadSize", Common::maxUploadSize());

		//Para asignar directamente el Objetivo Operativo navegando desde ese objetivo
		if (isset($_GET["fromOperativeObjectiveId"])) {
			$operativeObjective = BaseQuery::create("OperativeObjective")->findOneById($_GET["fromOperativeObjectiveId"]);
			if (!empty($operativeObjective)) {
				$this->smarty->assign("operativeObjective", $operativeObjective);
				$this->smarty->assign("fromOperativeObjectiveId", $_GET["fromOperativeObjectiveId"]);
			}
		}

	}
}
