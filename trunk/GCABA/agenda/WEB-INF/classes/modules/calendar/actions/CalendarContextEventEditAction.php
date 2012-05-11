<?php

require_once 'WEB-INF/classes/includes/actions/BaseEditAction.php';

class CalendarContextEventEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('CalendarContextEvent');
	}
	
	protected function post() {
		parent::post();
		$this->template->template = 'TemplateJQuery.tpl';
	}
}
