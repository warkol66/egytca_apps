<?php
/**
 * PlanningMinistryObjectivesListAction
 *
 * Listado de Obras (PlanningConstruction)
 *
 * @package    planning
 * @subpackage    planningMinistryObjectives
 */
require_once 'BaseListAction.php';

class PlanningMinistryObjectivesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('MinistryObjective');
	}
	
	protected function preList() {
		parent::preList();
		$this->module = "Planning";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "MinistryObjectives");
		if ($_GET["nav"])
			$this->smarty->assign("nav", true);
	}

}
