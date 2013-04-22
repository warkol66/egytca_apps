<?php


class CalendarWeekAction extends BaseListAction {
	
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
	
		$smarty->assign("firstDay",$firstDay);
		$smarty->assign("lastDays",$lastDays);
		$smarty->assign("daysEvents",$daysEvents);
		$smarty->assign("days",$days);
		$smarty->assign("month", $month);
		$smarty->assign("year", $year);
		$smarty->assign("previousStartWeek",$previousStartWeek);
		$smarty->assign("nextStartWeek",$nextStartWeek);
		$smarty->assign("eventsBeforeWeek", $eventsBeforeWeek);	
		
		$this->template->template = "TemplatePublic.tpl";
            
        $this->smarty->assign("filters",$this->filters);

	}

}
/*
require_once("BaseAction.php");
require_once("CalendarEventPeer.php");

class CalendarEventsWeekAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarEventsWeekAction() {
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

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Calendar";
		$smarty->assign("module",$module);

  	/**
   	* Use a different template
   	*
		$this->template->template = "TemplatePublic.tpl";
						
 		$calendarEventPeer = new CalendarEventPeer();
		$calendarEventPeer->setOrderByUpdateDate();
		
		if (empty($_REQUEST["startWeek"])){
			$startWeek = date("Y-m-d");
			$year = date("Y");
			$month = date("m");
			$days = date("d");
		}	
		else {		
			$startWeek = $_REQUEST["startWeek"];
			list($year,$month,$days)=explode("-",$startWeek);
			$dayStartWeek = date("N",mktime(0, 0, 0, $month,$days, $year)); // 1 lunes, 7 Domingo
			
			if ($dayStartWeek > 0 && $dayStartWeek < 7) {
				$diffDays = -$dayStartWeek;
				$startWeek = CalendarEventPeer::addDate($startWeek,$diffDays);
				list($year,$month,$days)=explode("-",$startWeek);
			} 				
		}
		
		$date = date("Y-m-d h:i:s",mktime(0, 0, 0, $month,$days, $year));
		$eventsBeforeWeek = CalendarEventPeer::getEventsBeforeDate($date);
		
		$endWeek = CalendarEventPeer::addDate($startWeek,7);
		$nextStartWeek = CalendarEventPeer::addDate($startWeek,7);		
		$previousStartWeek = CalendarEventPeer::addDate($startWeek,-7);	
	
		$daysEvents = array();
		for ($i=0; $i<=6; $i++) {
			$date=CalendarEventPeer::addDate($startWeek,$i);
	  		$events = CalendarEventPeer::getEventsOnDay($date);
			list($eventYear,$eventMonth,$eventDay)=explode("-",$date);
			$daysEvents[$eventDay] = $events;	
		}
		
		$firstDay = date("w",mktime(0, 0, 0, $month,$days, $year));
		
		if ($firstDay > 0)  
			$lastDays = 7-$firstDay;
		else
			$lastDays = 0;
		
		$smarty->assign("firstDay",$firstDay);
		$smarty->assign("lastDays",$lastDays);
		$smarty->assign("daysEvents",$daysEvents);
		$smarty->assign("days",$days);
		$smarty->assign("month", $month);
		$smarty->assign("year", $year);
		$smarty->assign("previousStartWeek",$previousStartWeek);
		$smarty->assign("nextStartWeek",$nextStartWeek);
		$smarty->assign("eventsBeforeWeek", $eventsBeforeWeek);		
   
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}*/
