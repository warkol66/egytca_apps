<?php
/*
 * 
 * Actualiza el estado de un calendarEvent
 * */

class CalendarChangeStatusXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preUpdate(){
		parent::preUpdate();
		
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);
		
	}

}
