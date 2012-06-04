<?php

require_once 'BaseDoDeleteAction.php';

class PlanningOperativeObjectivesDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('OperativeObjective');
	}
}
