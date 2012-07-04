<?php

require_once 'BaseEditAction.php';

class PlanningMinistryObjectivesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('MinistryObjective','Planning');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("regions", RegionQuery::create()->filterByType('11')->find());
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		$this->smarty->assign("goalTypes", MinistryObjective::getGoalTypes());
		$this->smarty->assign("goalTrends", MinistryObjective::getGoalTrends());

		if (isset($_GET["fromImpactObjectiveId"])) {
			$impactObjective = BaseQuery::create("ImpactObjective")->findOneById($_GET["fromImpactObjectiveId"]);
			if (!empty($impactObjective)) {
				$this->smarty->assign("impactObjective", $impactObjective);
				$this->smarty->assign("fromImpactObjectiveId", $_GET["fromImpactObjectiveId"]);
			}
		}

	}
}
