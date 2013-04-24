<?php

class CalendarListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preList() {
		parent::preList();
		
		if(!empty($_GET['filters']['minDate']) || !empty($_GET['filters']['maxDate']))
			unset($this->filters['dateRange']);
		if(!empty($_GET['filters']['minDate'])){
            $this->filters['dateRange']['creationdate']['min'] = $_GET['filters']['minDate'];
        }
        if(!empty($_GET['filters']['maxDate'])){
            $this->filters['dateRange']['creationdate']['max'] = $_GET['filters']['maxDate'];
		}
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "Calendar";
		$this->smarty->assign("module", $module);
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$this->smarty->assign("calendarEventsConfig",$calendarEventsConfig);
		
		$user = Common::getAdminLogged();
		$categories = $user->getCategoriesByModule('news'); //news?
		$this->smarty->assign("categories",$categories);
		$this->smarty->assign("calendarEventStatus",CalendarEvent::getStatuses());   
		$this->smarty->assign("message",$_GET["message"]);
		
		//filtros
		if(!empty($_GET['filters']['dateRange']['creationdate']['min']))
            $this->filters['minDate'] = $_GET['filters']['dateRange']['creationdate']['min'];
        if(!empty($_GET['filters']['dateRange']['creationdate']['max']))
            $this->filters['maxDate'] = $_GET['filters']['dateRange']['creationdate']['max'];
            
        $this->smarty->assign("filters",$this->filters);

	}

}
