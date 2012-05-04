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
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$smarty->assign("calendarEventsConfig",$calendarEventsConfig);
		
		$events = CalendarEventQuery::create()->find();
		$smarty->assign('events', $events);
		
		if ($calendarEventsConfig['useCategories']['value'] == "YES")
			$smarty->assign("categories", CategoryQuery::create()->find());

		$smarty->assign("regions", RegionQuery::create()->filterByType('11')->find());

		$smarty->assign("users", UserQuery::create()->find());
		$smarty->assign('actors', ActorQuery::create()->find());
		$smarty->assign('axes', CalendarAxisQuery::create()->find());

		$smarty->assign('eventTypes', EventTypeQuery::create()->find());
		$smarty->assign('agendaTypes', CalendarEventPeer::getAgendas());
		$smarty->assign("calendarEventStatus",CalendarEventPeer::getStatus());
		
		$this->template->template = 'TemplateCalendar.tpl';
		return $mapping->findForwardConfig('success');
	}

}