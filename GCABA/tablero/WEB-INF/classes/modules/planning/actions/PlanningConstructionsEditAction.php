<?php

require_once 'BaseEditAction.php';

class PlanningConstructionsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningConstruction','Planning');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
	}
}
