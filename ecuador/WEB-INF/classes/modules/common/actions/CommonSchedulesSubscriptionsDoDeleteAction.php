<?php

class CommonSchedulesSubscriptionsDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('ScheduleSubscription');
		
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		
	}

}
