<?php

require_once 'BaseListAction.php';

class PlanningMinistryObjectivesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('MinistryObjective','Planning');
	}
	
	protected function post() {
		parent::post();
	}
}
