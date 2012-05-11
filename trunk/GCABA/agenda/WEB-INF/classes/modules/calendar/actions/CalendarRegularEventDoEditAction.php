<?php

require_once 'WEB-INF/classes/includes/actions/BaseDoEditAction.php';

class CalendarRegularEventDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('CalendarRegularEvent');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		$this->entityParams['date'] = Datetime::createFromFormat('d/m', $this->entityParams['date'])->format('m/d');
	}
}
