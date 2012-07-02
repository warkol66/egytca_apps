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
	}
}
