<?php
/**
 * PlanningProjectsEditAction
 *
 * Formulario de modificacion de Proyectos (PlanningProject) extendiendo BaseEditAction
 *
 * @package    planning
 * @subpackage    planningProjects
 */
require_once 'BaseEditAction.php';

class PlanningProjectsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningProject');
	}
	
	protected function postEdit() {
		parent::postEdit();

		//Constantes y opciones posibles
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		$this->smarty->assign("ministryPriorities", PlanningProject::getMinistryPriorities());
		$this->smarty->assign("priorities", PlanningProject::getPriorities());

		//Constantes y opciones posibles para la creaci�n de indicadores
		$this->smarty->assign("planningIndicator", new PlanningIndicator());
		$this->smarty->assign("indicatorTypes", PlanningIndicator::getIndicatorTypes());

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
