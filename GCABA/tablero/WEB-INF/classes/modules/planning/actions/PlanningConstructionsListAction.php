<?php
/**
 * PlanningConstructionsListAction
 *
 * Listado de Obras (PlanningConstruction)
 *
 * @package    planning
 * @subpackage    planningPlanningConstructions
 */
require_once 'BaseListAction.php';

class PlanningConstructionsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('PlanningConstruction');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Constructions");

		if ($_GET["nav"])
			$this->smarty->assign("nav", true);
	    if (!empty($_GET["filters"]["planningprojectid"]))
	    {
	    	   $this->smarty->assign("planningProject", BaseQuery::create('PlanningProject')->findOneById($_GET["filters"]["planningprojectid"]));
	    }
	}
}
