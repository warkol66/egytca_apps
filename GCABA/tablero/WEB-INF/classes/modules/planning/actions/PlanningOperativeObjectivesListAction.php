<?php

require_once 'BaseListAction.php';

class PlanningOperativeObjectivesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('OperativeObjective','Planning');
	}
	
	protected function post() {
		parent::post();
	}
}
