<?php

class CommonSchedulesSubscriptionsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('ScheduleSubscription');
	}
	
	protected function postList() {
		parent::postList();
		
		$this->smarty->assign("message",$_GET["message"]);
		
	}
	
}
