<?php

require_once 'BaseEditAction.php';

class PlanningActivitiesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningActivity');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		$this->smarty->assign("tenderTypes", PlanningConstruction::getTenderTypes());
	}
}
