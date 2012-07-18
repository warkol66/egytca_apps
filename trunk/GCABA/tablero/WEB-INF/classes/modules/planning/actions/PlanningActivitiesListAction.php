<?php
/**
 * PlanningActivitiesListAction
 *
 * Listado de Obras (PlanningActivities)
 *
 * @package    planning
 * @subpackage    planningPlanningActivities
 */
require_once 'BaseListAction.php';

class PlanningActivitiesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('PlanningActivity');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Activities");
	}
}
