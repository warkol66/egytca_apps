<?php

class CalendarMonthAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preList() {
		parent::preList();
		
		if (empty($_REQUEST["year"]))
			$year = date("Y");
		else
			$year = $_REQUEST["year"];
			
		if (empty($_REQUEST["month"]))	
			$month = date("m");
		else
			$month = $_REQUEST["month"];

		//seteo los filtros para que busque dentro de esas fechas (para $events)
        $this->filters['dateRange']['creationdate']['min'] = CalendarEvent::getStartDate($year,$month);
        $this->filters['dateRange']['creationdate']['max'] = CalendarEvent::getEndDate($year,$month);
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$this->smarty->assign("calendarEventsConfig",$calendarEventsConfig);
		
		if (empty($_REQUEST["year"]))
			$year = date("Y");
		else
			$year = $_REQUEST["year"];
			
		if (empty($_REQUEST["month"]))	
			$month = date("m");
		else
			$month = $_REQUEST["month"];
			
		//$eventsBeforeMonth = CalendarEventQuery::create()->getEventsBeforeMonth($year, $month);
		
		$monthDisplayed = mktime(0, 0, 0, $month, 1, $year);
		$this->smarty->assign("monthDisplayed",$monthDisplayed);
		
		$nextMonth = $month+1;
		$nextYear = $year;
		
		if ($nextMonth > 12) {
			$nextMonth = 1;
			$nextYear++;
		}		
		
		$previousMonth = $month-1;	
		$previousYear = $year;	
		if ($previousMonth < 1) {
			$previousMonth = 12;
			$previousYear--;
		}
	
		$daysInMonth = cal_days_in_month (CAL_GREGORIAN, $month, $year);
		//$events = $calendarEventPeer->getEventsMonth($year,$month);
		$events = $this->entity;
		
		$daysEvents = array();
		for ($i=1; $i<=$daysInMonth; $i++) {
		    $daysEvents[$i] = array();
		}
				
		foreach($events as $event) {
			$days = $event->getEventDaysOnMonth($year,$month);
   			foreach ($days as $day) {
				$daysEvents[$day][] = $event;
			}	
		}

		$firstDay = date("w",mktime(0, 0, 0, $month, 1, $year));
		
		$beginOnSunday = $moduleConfig["beginOnSunday"]["value"];
		
		if ($beginOnSunday == "NO") {
			$firstDay -= 1;
			if ($firstDay<0)
				$firstDay = 6;
		}
		
		$countDay = date("t", mktime(0,0,0, $month, 1, $year));
	
		$this->smarty->assign("beginOnSunday",$beginOnSunday);
		$this->smarty->assign("firstDay",$firstDay);
		$this->smarty->assign("countDay",$countDay);
		$this->smarty->assign("daysEvents",$daysEvents);
		$this->smarty->assign("month", $month);
		$this->smarty->assign("year", $year);
		$this->smarty->assign("nextMonth", $nextMonth);
		$this->smarty->assign("nextYear", $nextYear);
		$this->smarty->assign("previousMonth", $previousMonth);
		$this->smarty->assign("previousYear", $previousYear);
		$this->smarty->assign("eventsBeforeMonth",$eventsBeforeMonth);
		
		$this->template->template = "TemplatePublic.tpl";
            
        $this->smarty->assign("filters",$this->filters);

	}

}

/* Falta terminar de probar
 * 
 * require_once("BaseAction.php");
require_once("CalendarEventPeer.php");

class CalendarEventsMonthAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarEventsMonthAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*
	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		
						
 		$calendarEventPeer = new CalendarEventPeer();
		$calendarEventPeer->setOrderByUpdateDate();
		$calendarEventPeer->setPublishedMode();
		
		if (empty($_REQUEST["year"]))
			$year = date("Y");
		else
			$year = $_REQUEST["year"];
			
		if (empty($_REQUEST["month"]))	
			$month = date("m");
		else
			$month = $_REQUEST["month"];	
			
		$eventsBeforeMonth = $calendarEventPeer->getEventsBeforeMonth($year, $month);	

		$monthDisplayed = mktime(0, 0, 0, $month, 1, $year);
		$smarty->assign("monthDisplayed",$monthDisplayed);
		
		$nextMonth = $month+1;
		$nextYear = $year;
		
		if ($nextMonth > 12) {
			$nextMonth = 1;
			$nextYear++;
		}		
		
		$previousMonth = $month-1;	
		$previousYear = $year;	
		if ($previousMonth < 1) {
			$previousMonth = 12;
			$previousYear--;
		}
	
		$daysInMonth = cal_days_in_month (CAL_GREGORIAN, $month, $year);
		$events = $calendarEventPeer->getEventsMonth($year,$month);
		
		$daysEvents = array();
		for ($i=1; $i<=$daysInMonth; $i++) {
		    $daysEvents[$i] = array();
		}
				
		foreach($events as $event) {
			$days = $event->getEventDaysOnMonth($year,$month);
   			foreach ($days as $day) {
				$daysEvents[$day][] = $event;
			}	
		}

		$firstDay = date("w",mktime(0, 0, 0, $month, 1, $year));
		
		$beginOnSunday = $moduleConfig["beginOnSunday"]["value"];
		
		if ($beginOnSunday == "NO") {
			$firstDay -= 1;
			if ($firstDay<0)
				$firstDay = 6;
		}
		
		$countDay = date("t", mktime(0,0,0, $month, 1, $year));
	
		$smarty->assign("beginOnSunday",$beginOnSunday);
		$smarty->assign("firstDay",$firstDay);
		$smarty->assign("countDay",$countDay);
		$smarty->assign("daysEvents",$daysEvents);
		$smarty->assign("month", $month);
		$smarty->assign("year", $year);
		$smarty->assign("nextMonth", $nextMonth);
		$smarty->assign("nextYear", $nextYear);
		$smarty->assign("previousMonth", $previousMonth);
		$smarty->assign("previousYear", $previousYear);
		$smarty->assign("eventsBeforeMonth",$eventsBeforeMonth);

		return $mapping->findForwardConfig('success');
	}

}*/
