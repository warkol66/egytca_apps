<?php

require_once 'BaseListAction.php';

class PlanningProjectsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('PlanningProject','Planning');
	}
	
	protected function post() {
		parent::post();
	}
}
