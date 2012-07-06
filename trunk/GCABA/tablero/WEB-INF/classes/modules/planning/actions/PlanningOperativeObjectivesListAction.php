<?php
/**
 * PlanningImpactObjectivesListAction
 *
 * Listado de Obras (ImpactObjective)
 *
 * @package    planning
 * @subpackage    planningImpactObjectives
 */
require_once 'BaseListAction.php';

class PlanningOperativeObjectivesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('OperativeObjective');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "OperativeObjectives");
	}
}
