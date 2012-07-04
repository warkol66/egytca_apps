<?php

require_once 'BaseEditAction.php';

class PlanningOperativeObjectivesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('OperativeObjective','Planning');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("productKinds", OperativeObjective::getProductKinds());
		$this->smarty->assign("populationGenders", OperativeObjective::getPopulationGender());
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));

		if (isset($_GET["fromMinistryObjectiveId"])) {
			$ministryObjective = BaseQuery::create("MinistryObjective")->findOneById($_GET["fromMinistryObjectiveId"]);
			if (!empty($ministryObjective)) {
				$this->smarty->assign("ministryObjective", $ministryObjective);
				$this->smarty->assign("fromMinistryObjectiveId", $_GET["fromMinistryObjectiveId"]);
			}
		}

	}
}
