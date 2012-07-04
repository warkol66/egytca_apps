<?php

require_once 'BaseEditAction.php';

class PlanningProjectsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningProject','Planning');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		$this->smarty->assign("ministryPriorities", PlanningProject::getMinistryPriorities());
		$this->smarty->assign("priorities", PlanningProject::getPriorities());

		if (isset($_GET["fromOperativeObjectiveId"])) {
			$operativeObjective = BaseQuery::create("OperativeObjective")->findOneById($_GET["fromOperativeObjectiveId"]);
			if (!empty($operativeObjective)) {
				$this->smarty->assign("operativeObjective", $operativeObjective);
				$this->smarty->assign("fromOperativeObjectiveId", $_GET["fromOperativeObjectiveId"]);
			}
		}

	}
}
