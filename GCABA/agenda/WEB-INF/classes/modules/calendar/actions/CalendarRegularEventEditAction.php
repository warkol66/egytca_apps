<?php

require_once 'WEB-INF/classes/includes/actions/BaseEditAction.php';

class CalendarRegularEventEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('CalendarRegularEvent');
	}
	
	protected function post() {
		parent::post();
		$this->template->template = 'TemplateJQuery.tpl';
	}
}
