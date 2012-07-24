<?php

class CalendarEventsShowXAction extends BaseAction {

	function CalendarEventsShowXAction() {
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
		
		if (!empty($_GET['filters'])) {
			$filters = $_GET['filters'];
			$smarty->assign('filters', $filters);
		}

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$smarty->assign("calendarEventsConfig",$calendarEventsConfig);

		if (!empty($_GET['id'])) {
			
			$event = BaseQuery::create('CalendarEvent')->findOneById($_GET['id']);
			if (is_null($event))
				throw new Exception('invalid id'); // buscar mejor forma de que falle ajax
			
			$smarty->assign('event', $event);

			$smarty->assign("kinds", CalendarEvent::getEventKinds());
			$smarty->assign("agendas", CalendarEvent::getAgendas());
			
			$smarty->assign("categories", CategoryQuery::create()->find());
	
			$smarty->assign("comunes", RegionQuery::create()->filterByType('11')->find());
			$smarty->assign("regions", RegionQuery::create()->filterByType(array(min =>'11'))->find());
	
			$smarty->assign("users", UserQuery::create()->find());
			$smarty->assign('actors', ActorQuery::create()->find());
			$smarty->assign('axes', CalendarAxisQuery::create()->find());
			$smarty->assign('axisMap', CalendarAxisQuery::create()->findAxisMap());
	
			$smarty->assign('eventStatuses', CalendarEvent::getStatuses());
			$smarty->assign('scheduleStatuses', CalendarEvent::getScheduleStatuses());
			$smarty->assign('eventTypes', EventTypeQuery::create()->find());
			$smarty->assign('agendaTypes', CalendarEventPeer::getAgendas());
			$smarty->assign("calendarEventStatus",CalendarEvent::getStatuses());
			
			$smarty->assign('noEdit', $_REQUEST['noEdit']);
			$smarty->assign('noDelete', $_REQUEST['noDelete']);

			
			return $mapping->findForwardConfig('success');
		}
		else {
			throw new Exception('empty id'); // buscar mejor forma de que falle ajax
		}
	}

}

