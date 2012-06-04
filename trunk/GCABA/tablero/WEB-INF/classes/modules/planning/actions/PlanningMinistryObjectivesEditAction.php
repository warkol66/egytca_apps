<?php

require_once 'BaseEditAction.php';

class PlanningMinistryObjectivesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('MinistryObjective','Planning');
	}
	
	protected function post() {
		parent::post();
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
	}
}
