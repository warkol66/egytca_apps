<?php

class CalendarViewXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preEdit() {
		parent::preEdit();

	}

	protected function postEdit() {
		parent::postEdit();
		
		$this->template->template = 'TemplateAjax.tpl';
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		
	}

}
