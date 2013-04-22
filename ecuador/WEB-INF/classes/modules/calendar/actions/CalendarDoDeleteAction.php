<?php


class CalendarDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preDelete(){
		parent::preDelete();
		
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);
		
	}

}
