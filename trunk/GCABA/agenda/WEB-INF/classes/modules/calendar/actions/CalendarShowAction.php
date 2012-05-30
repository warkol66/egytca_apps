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

		$smarty->assign('events', BaseQuery::create('CalendarEvent')->addFilters($filters)->filterBySchedulestatus('3', Criteria::NOT_EQUAL)->find());
		$smarty->assign('holydayEvents', BaseQuery::create('CalendarHolidayEvent')->addFilters($filters)->find());
		$smarty->assign('contextEvents', BaseQuery::create('CalendarContextEvent')->addFilters($filters)->find());
		$smarty->assign('pendingEvents', BaseQuery::create('CalendarEvent')->addFilters($filters)->filterBySchedulestatus('3', Criteria::EQUAL)->find());

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$smarty->assign("calendarEventsConfig",$calendarEventsConfig);

		$smarty->assign("kinds", CalendarEvent::getEventKinds());
		$smarty->assign("agendas", CalendarEvent::getAgendas());
		$smarty->assign("comunes", RegionQuery::create()->filterByType('11')->find());
		$smarty->assign('axisMap', CalendarAxisQuery::create()->findAxisMap());
		$smarty->assign('eventStatuses', CalendarEvent::getStatuses());

		//Eventos de Contexto
		$smarty->assign('contextNational', CalendarContextEventQuery::create()->filterByContexttype('1')->find());
		$smarty->assign('contextCampaign', CalendarContextEventQuery::create()->filterByContexttype('2')->find());
		$smarty->assign('contextCrisis', CalendarContextEventQuery::create()->filterByContexttype('3')->find());
		$smarty->assign('contextJuncture', CalendarContextEventQuery::create()->filterByContexttype('4')->find());
		

		$this->template->template = 'TemplateCalendar.tpl';
		return $mapping->findForwardConfig('success');
	}

}

