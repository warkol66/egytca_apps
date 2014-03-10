<?php

class CalendarViewXAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preSelect() {
		parent::preSelect();

	}

	protected function postSelect() {
		parent::postSelect();
		
		$this->template->template = 'TemplateAjax.tpl';
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		
	}

}
