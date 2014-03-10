<?php

class CalendarMediasEditAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('CalendarMedia');
	}

	protected function postSelect() {
		parent::postSelect();
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("calendarIdValues",CalendarEventQuery::create()->find());
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		
		$maxUploadSize =  Common::maxUploadSize();
		$this->smarty->assign("maxUploadSize",$maxUploadSize);
		
	}

}
