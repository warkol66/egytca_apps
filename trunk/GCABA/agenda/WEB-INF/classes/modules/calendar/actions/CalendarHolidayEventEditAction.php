<?php

require_once 'WEB-INF/classes/includes/actions/BaseEditAction.php';

class CalendarHolidayEventEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('CalendarHolidayEvent');
	}
	
	protected function post() {
		parent::post();
		$this->template->template = 'TemplateJQuery.tpl';
	}
}
