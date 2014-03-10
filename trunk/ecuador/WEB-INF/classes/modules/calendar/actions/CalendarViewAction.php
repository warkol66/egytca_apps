<?php

class CalendarViewAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preSelect() {
		parent::preSelect();

	}

	protected function postSelect() {
		parent::postSelect();
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		
		//crear un template public para calendar
		$this->template->template = "TemplateNewsPublic.tpl";
		
	}

}
