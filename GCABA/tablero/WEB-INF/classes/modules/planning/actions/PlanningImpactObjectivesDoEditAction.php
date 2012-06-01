<?php

require_once 'BaseDoEditAction.php';

class PlanningImpactObjectivesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('Objective','Planning');
	}
}
