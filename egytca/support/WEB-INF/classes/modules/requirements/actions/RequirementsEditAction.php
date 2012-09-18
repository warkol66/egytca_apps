<?php

require_once 'BaseEditAction.php';

class RequirementsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('Requirement');
	}
	
	protected function postEdit() {
		parent::postEdit();
	}
}
