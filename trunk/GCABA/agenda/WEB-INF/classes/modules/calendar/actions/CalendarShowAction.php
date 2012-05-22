<?php

class CalendarShowAction extends BaseAction {

	function CalendarShowAction() {
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

		$events = BaseQuery::create('CalendarEvent')->addFilters($filters)
			->filterByStatus(3, Criteria::GREATER_THAN)->find();
		$smarty->assign('events', $events);
		$smarty->assign('holydayEvents', BaseQuery::create('CalendarHolidayEvent')->addFilters($filters)->find());
		$smarty->assign('contextEvents', BaseQuery::create('CalendarContextEvent')->addFilters($filters)->find());
		$smarty->assign('pendingEvents', BaseQuery::create('CalendarEvent')->addFilters($filters)
			->filterByStatus(3, Criteria::LESS_EQUAL)->find());


		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$smarty->assign("calendarEventsConfig",$calendarEventsConfig);

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

		//Eventos de Contexto
		$smarty->assign('contextNational', CalendarContextEventQuery::create()->filterByContexttype('1')->find());
		$smarty->assign('contextCampaign', CalendarContextEventQuery::create()->filterByContexttype('2')->find());
		$smarty->assign('contextCrisis', CalendarContextEventQuery::create()->filterByContexttype('3')->find());
		$smarty->assign('contextJuncture', CalendarContextEventQuery::create()->filterByContexttype('4')->find());
		

		$this->template->template = 'TemplateCalendar.tpl';
		return $mapping->findForwardConfig('success');
	}

}

