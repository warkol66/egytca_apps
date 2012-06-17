<?php

require_once 'BaseEditAction.php';

class PlanningMinistryObjectivesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('MinistryObjective','Planning');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->template->template = 'TemplateJQuery.tpl';
		$this->smarty->assign("regions", RegionQuery::create()->filterByType('11')->find());
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
	}
}
