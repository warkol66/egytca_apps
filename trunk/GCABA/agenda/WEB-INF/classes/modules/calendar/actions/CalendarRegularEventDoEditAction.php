<?php

require_once 'WEB-INF/classes/includes/actions/BaseDoEditAction.php';

class CalendarRegularEventDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('CalendarRegularEvent');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		$datetime = Datetime::createFromFormat('d-m', $this->entityParams['date']);
		if ($datetime === false)
			throw new Exception('error reading date');
		$this->entityParams['date'] = $datetime->format('Y-m-d');
	}
}
