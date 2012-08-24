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
		
		$eventDateFilter = array(); // filtro por fecha de eventos normales
		$contextEventDateFilter = array(); // filtro por fecha de eventos de contexto
		$holidayDateFilter = array(); // filtro por fecha de feriados
		if (!empty($_GET['filters']['selectedDate'])) {
			$dt = new DateTime($_GET['filters']['selectedDate']);
			$eventDateFilter['min'] = strtotime('-2 month', $dt->getTimestamp());
			$eventDateFilter['max'] = strtotime('+3 month', $dt->getTimestamp());
			$contextEventDateFilter = $eventDateFilter;
			$holidayDateFilter = $eventDateFilter;
		} else {
			$dt = new DateTime();
			$eventDateFilter['min'] = strtotime('-2 month', $dt->getTimestamp());
			$eventDateFilter['max'] = strtotime('+5 month', $dt->getTimestamp());
			$contextEventDateFilter['min'] = strtotime('first day of this month', $dt->getTimestamp());
			$contextEventDateFilter['max'] = strtotime('first day of this month +3 month', $dt->getTimestamp());
			$holidayDateFilter = $eventDateFilter;
		}
		
		// fechas limite en las que tiene validez la navegacion del calendario
		// $dt tiene la fecha indicada en filters['selectedDate']. Si no existe tiene la actual
		$smarty->assign('minTimestamp', strtotime('-2 month', $dt->getTimestamp()));
		$smarty->assign('maxTimestamp', strtotime('+3 month', $dt->getTimestamp()));

		$smarty->assign('events', BaseQuery::create('CalendarEvent')->addFilters($filters)->filterBySchedulestatus('3', Criteria::NOT_EQUAL)->filterByStartDate($eventDateFilter)->find());
		$smarty->assign('holydayEvents', BaseQuery::create('CalendarHolidayEvent')->addFilters($filters)->filterByStartDate($holidayDateFilter)->find());
		$smarty->assign('contextEvents', BaseQuery::create('CalendarContextEvent')->addFilters($filters)->filterByStartDate($contextEventDateFilter)->find());
		$smarty->assign('pendingEvents', BaseQuery::create('CalendarEvent')->addFilters($filters)->filterBySchedulestatus('3', Criteria::EQUAL)->find());

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$smarty->assign("calendarEventsConfig",$calendarEventsConfig);

		$smarty->assign("kinds", CalendarEvent::getEventKinds());
		$smarty->assign("agendas", CalendarEvent::getAgendas());
		$smarty->assign("actors", ActorQuery::create()->find());
		$smarty->assign("categories", CategoryQuery::create()->find());
		$smarty->assign("comunes", RegionQuery::create()->filterByType('11')->find());
		$smarty->assign('axes', CalendarAxisQuery::create()->orderByOrder()->find());
		$smarty->assign('axisMap', CalendarAxisQuery::create()->findAxisMap());
		$smarty->assign('eventStatuses', CalendarEvent::getStatuses());

		//Eventos de Contexto
		$smarty->assign('contextNational', CalendarContextEventQuery::create()->filterByContexttype('1')->find());
		$smarty->assign('contextCampaign', CalendarContextEventQuery::create()->filterByContexttype('2')->find());
		$smarty->assign('contextCrisis', CalendarContextEventQuery::create()->filterByContexttype('3')->find());
		$smarty->assign('contextJuncture', CalendarContextEventQuery::create()->filterByContexttype('4')->find());
		
		$thematicWeeks = ThematicWeekQuery::create()->filterByAxisid(0, Criteria::GREATER_THAN)->find()->toArray();
		foreach ($thematicWeeks as $key => $value) {
			// uso $array[$key] porque quiero modificar el array original
			$axis = ThematicWeekQuery::create()->findOneById($thematicWeeks[$key]['Id'])->getCalendarAxis();
			$thematicWeeks[$key]['AxisColor'] = $axis->getColor();
			$thematicWeeks[$key]['AxisName'] = $axis->getName();
		}
		$smarty->assign('thematicWeeks', json_encode($thematicWeeks));

		$this->template->template = 'TemplateCalendar.tpl';
		return $mapping->findForwardConfig('success');
	}

}

