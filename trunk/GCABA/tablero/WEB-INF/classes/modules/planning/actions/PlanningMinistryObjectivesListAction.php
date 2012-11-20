<?php
/**
 * PlanningMinistryObjectivesListAction
 *
 * Listado de Obras (PlanningConstruction)
 *
 * @package    planning
 * @subpackage    planningMinistryObjectives
 */

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
		if (!empty($_GET["filters"]["impactobjectiveid"]))
			$this->smarty->assign("impactObjective", BaseQuery::create('ImpactObjective')->findOneById($_GET["filters"]["impactobjectiveid"]));
	}

}
