<?php

require_once 'BaseDoDeleteAction.php';

class PlanningImpactObjectivesDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('ImpactObjective');
	}
}
