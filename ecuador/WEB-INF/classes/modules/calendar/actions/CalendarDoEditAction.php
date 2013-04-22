<?php

class CalendarDoEditAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);
		
		if(!empty($_GET['filters'])){
			$filtersUrl = http_build_query(array('filters' => $_GET['filters']));
			$this->smarty->assign("filtersUrl", $filtersUrl);
		}
	}
	
}
