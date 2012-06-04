<?php

require_once 'BaseEditAction.php';

class PlanningOperativeObjectivesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('OperativeObjective','Planning');
	}
	
	protected function post() {
		parent::post();
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
	}
}
