<?php

class CommonSchedulesSubscriptionsDoEditAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('ScheduleSubscription');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		if(!empty($_GET['filters'])){
			$filtersUrl = http_build_query(array('filters' => $_GET['filters']));
			$this->smarty->assign("filtersUrl", $filtersUrl);
		}
	}
	
}
