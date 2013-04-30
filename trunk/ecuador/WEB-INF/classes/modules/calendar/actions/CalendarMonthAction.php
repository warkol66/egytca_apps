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
        $this->filters['dateRange']['startdate']['min'] = CalendarEvent::getMonthStartDate($year,$month);
        $this->filters['dateRange']['startdate']['max'] = CalendarEvent::getMonthEndDate($year,$month);
        //como es published mode traigo solo los eventos que no terminaron
        $this->filters['dateRange']['enddate']['min'] = CalendarEvent::getMonthStartDate($year,$month);
		
	}

	protected function postList() {
		parent::postList();
		
		/*echo('<pre>');
		print_r($this->results);
		echo('</pre>');
		die();*/
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$this->smarty->assign("calendarEventsConfig",$calendarEventsConfig);
		
		//genero year y month para las busquedas
		if (empty($_REQUEST["year"]))
			$year = date("Y");
		else
			$year = $_REQUEST["year"];
		if (empty($_REQUEST["month"]))	
			$month = date("m");
		else
			$month = $_REQUEST["month"];
		
		//mes y año proximos
		if ($month+1 > 12){
			$nextMonth = 1;
			$nextYear = $year+1;
		}else{
			$nextMonth = $month+1;
			$nextYear = $year;
		}
		
		//mes y año anteriores
		if ($month-1 < 1){
			$previousMonth = 12;
			$previousYear = $year-1;
		}else{
			$previousMonth = $month-1;
			$previousYear = $year;
		}	
	
		$eventsBeforeMonth = CalendarEvent::getEventsBeforeMonth($year, $month);
		
		$monthDisplayed = mktime(0, 0, 0, $month, 1, $year);
		$this->smarty->assign("monthDisplayed",$monthDisplayed);
		$daysInMonth = cal_days_in_month (CAL_GREGORIAN, $month, $year);
		
		$events = $this->results;
		
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
