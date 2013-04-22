<?php

class CalendarViewAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preEdit() {
		parent::preEdit();

	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);
		
		$this->entity->increaseViews();
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		
		//crear un template public para calendar
		$this->template->template = "TemplateNewsPublic.tpl";
		
	}

}
