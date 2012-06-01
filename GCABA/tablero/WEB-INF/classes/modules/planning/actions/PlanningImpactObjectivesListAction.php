<?php

require_once 'BaseListAction.php';

class PlanningImpactObjectivesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('ImpactObjective','Planning');
	}
	
	protected function post() {
		parent::post();
	}
}
