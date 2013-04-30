<?php

/*class CalendarWeekAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preList() {
		parent::preList();
		
		if (empty($_REQUEST["startWeek"])){
			$startWeek = date("Y-m-d",strtotime('this week'));
			$year = date("Y",strtotime($startWeek));
			$month = date("m",strtotime($startWeek));
			$days = date("d",strtotime($startWeek));
		}	
		else {		
			$startWeek = $_REQUEST["startWeek"];
			list($year,$month,$days)=explode("-",$startWeek);
			$dayStartWeek = date("N",mktime(0, 0, 0, $month,$days, $year));
			
			if ($dayStartWeek > 0 && $dayStartWeek < 7) {
				$diffDays = -$dayStartWeek;
				$startWeek = CalendarEvent::addDate($startWeek,$diffDays);
				list($year,$month,$days)=explode("-",$startWeek);
			} 				
		}
		
		//seteo los filtros para que busque dentro de esa semana
		$this->filters['dateRange']['startdate']['min'] = date("Y-m-d H:i:s",strtotime($startWeek));
        $this->filters['dateRange']['startdate']['max'] = CalendarEvent::addDate($startWeek,7);
        //como es published mode traigo solo los eventos que no terminaron
        $this->filters['dateRange']['enddate']['min'] = date("Y-m-d H:i:s",strtotime($startWeek));
		
		
		
        /*$this->filters['dateRange']['Strardate']['min'] = $startWeek; //date("Y-m-d H:i:s",strtotime($startWeek));
        $this->filters['dateRange']['Strardate']['max'] = CalendarEvent::addDate($startWeek,7); //date("Y-m-d H:i:s",strtotime($startWeek));
        $this->filters['dateRange']['Enddate']['min'] = CalendarEvent::addDate($startWeek,1);*/
        
        /*print_r($this->filters);
        die();*
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);
		
		if (empty($_REQUEST["startWeek"])){
			$startWeek = date("Y-m-d",strtotime('this week'));
			$year = date("Y",strtotime($startWeek));
			$month = date("m",strtotime($startWeek));
			$days = date("d",strtotime($startWeek));
		}	
		else {		
			$startWeek = $_REQUEST["startWeek"];
			list($year,$month,$days)=explode("-",$startWeek);
			$dayStartWeek = date("N",mktime(0, 0, 0, $month,$days, $year)); // 1 lunes, 7 Domingo
			
			if ($dayStartWeek > 0 && $dayStartWeek < 7) {
				$diffDays = -$dayStartWeek;
				$startWeek = CalendarEvent::addDate($startWeek,$diffDays);
				list($year,$month,$days)=explode("-",$startWeek);
			} 				
		}
		
		$eventsBeforeWeek = CalendarEvent::getEventsBeforeDate($startWeek);
		
		$endWeek = CalendarEvent::addDate($startWeek,7);
		$nextStartWeek = CalendarEvent::addDate($startWeek,7);		
		$previousStartWeek = CalendarEvent::addDate($startWeek,-7);	
		
		$daysEvents = array();
		
		foreach($this->results as $event)
			$daysEvents[] = $event;
		
		/*print_r($this->results);
		die();*/
		
		/*$daysEvents = array();
		for ($i=0; $i<=6; $i++) {
			$date=CalendarEvent::addDate($startWeek,$i);
	  		$events = CalendarEvent::getEventsOnDay($date);
			list($eventYear,$eventMonth,$eventDay)=explode("-",$date);
			$daysEvents[$eventDay] = $events;	
		}*
		
		print_r($daysEvents);
		die();*
		
		$firstDay = date("w",mktime(0, 0, 0, $month,$days, $year));
		
		if ($firstDay > 0)  
			$lastDays = 7-$firstDay;
		else
			$lastDays = 0;
	
		$this->smarty->assign("firstDay",$firstDay);
		$this->smarty->assign("lastDays",$lastDays);
		$this->smarty->assign("daysEvents",$daysEvents);
		$this->smarty->assign("days",$days);
		$this->smarty->assign("month", $month);
		$this->smarty->assign("year", $year);
		$this->smarty->assign("previousStartWeek",$previousStartWeek);
		$this->smarty->assign("nextStartWeek",$nextStartWeek);
		$this->smarty->assign("eventsBeforeWeek", $eventsBeforeWeek);	
		
		$this->template->template = "TemplatePublic.tpl";
            
        $this->smarty->assign("filters",$this->filters);

	}

}*/
class CalendarWeekAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarWeekAction() {
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
	*/
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

		$this->template->template = "TemplatePublic.tpl";
						
 		/*$calendarEventPeer = new CalendarEventPeer();
		$calendarEventPeer->setOrderByUpdateDate();*/
		
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
				$startWeek = CalendarEvent::addDate($startWeek,$diffDays);
				list($year,$month,$days)=explode("-",$startWeek);
			} 				
		}
		
		$date = date("Y-m-d h:i:s",mktime(0, 0, 0, $month,$days, $year));
		$eventsBeforeWeek = CalendarEvent::getEventsBeforeDate($date);
		
		$endWeek = CalendarEvent::addDate($startWeek,7);
		$nextStartWeek = CalendarEvent::addDate($startWeek,7);		
		$previousStartWeek = CalendarEvent::addDate($startWeek,-7);	
	
		$daysEvents = array();
		for ($i=0; $i<=6; $i++) {
			$date=CalendarEvent::addDate($startWeek,$i);
	  		$events = CalendarEvent::getEventsOnDay($date);
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

}
