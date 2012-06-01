<?php

require_once 'BaseEditAction.php';

class PlanningImpactObjectivesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('ImpactObjective','Planning');
	}
	
	protected function post() {
		parent::post();
	}
}
