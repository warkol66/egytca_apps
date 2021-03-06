<?php

class CalendarEventsMapShowAction extends BaseAction {

	function CalendarEventsMapShowAction() {
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
		
		if (!empty($_GET['filters'])) {
			$filters = $_GET['filters'];
			$smarty->assign('filters', $filters);
		}
		
		if (!empty($_GET['filters']['minDate']))
			$filters['startdate']['min'] = $_GET['filters']['minDate'];
		if (!empty($_GET['filters']['maxDate']))
			$filters['startdate']['max'] = $_GET['filters']['maxDate'];
		
		$events = BaseQuery::create('CalendarEvent')
			->addFilters($filters)
//			->filterBySchedulestatus('3', Criteria::NOT_EQUAL)
			->find();
		$smarty->assign('events', $events->toJSON());
		
		$smarty->assign("kinds", CalendarEvent::getEventKinds());
		$smarty->assign("agendas", CalendarEvent::getAgendas());
		$smarty->assign("actors", ActorQuery::create()->find());
		$smarty->assign("categories", CategoryQuery::create()->find());
		$smarty->assign("comunes", RegionQuery::create()->filterByType('11')->find());
		$smarty->assign('axes', CalendarAxisQuery::create()->orderByOrder()->find());
		$smarty->assign('axisCssClassToIdMap', CalendarAxisQuery::create()->findAxisMap('cssClass', 'id'));
		$smarty->assign('axisNameToIdMap', CalendarAxisQuery::create()->findAxisMap('name', 'id'));
		$smarty->assign('eventStatuses', CalendarEvent::getStatuses());

		$this->template->template = 'TemplateCalendarMap.tpl';
		return $mapping->findForwardConfig('success');
	}

}

