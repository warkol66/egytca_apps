<?php

require_once 'BaseEditAction.php';

class PlanningConstructionsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningConstruction');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		$this->smarty->assign("tenderTypes", PlanningConstruction::getTenderTypes());
		$this->smarty->assign("constructionTypes", PlanningConstruction::getConstructionTypes());

		//Para asignar directamente el Objetivo Operativo navegando desde ese objetivo
		if (isset($_GET["fromPlanningProjectId"])) {
			$planningProject = BaseQuery::create("PlanningProject")->findOneById($_GET["fromPlanningProjectId"]);
			if (!empty($planningProject)) {
				$this->smarty->assign("planningProject", $planningProject);
				$this->smarty->assign("fromPlanningProjectId", $_GET["fromPlanningProjectId"]);
			}
		}

	}
}
