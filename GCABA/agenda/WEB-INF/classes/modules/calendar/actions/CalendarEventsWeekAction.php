<?php

class CalendarEventsWeekAction extends BaseAction {

	function CalendarEventsWeekAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Calendar";
		$smarty->assign("module",$module);

  	/**
   	* Use a different template
   	*/
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

}