<?php

class CalendarEventsEditAction extends BaseAction {
	
	function CalendarEventsEditAction() {
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
		$smarty->assign("actualAction", "calendarEventsEdit");

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$smarty->assign("calendarEventsConfig",$calendarEventsConfig);
		
		if (!empty($_GET["id"])) {
			//voy a editar un evento
			$calendarEvent = CalendarEventQuery::create()->findOneById($_GET["id"]);
			if (!empty($calendarEvent)) {
				$smarty->assign("calendarEvent",$calendarEvent);
				$smarty->assign('photos', $calendarEvent->getResources());
			}
		}
		else {
			//voy a crear un calendarevent nuevo
			$calendarEvent = new CalendarEvent();
			$smarty->assign("calendarEvent",$calendarEvent);
		}
		
		if ($calendarEventsConfig['useRegions']['value'] == "YES")
			$smarty->assign("regions", RegionQuery::create()->filterByType(RegionPeer::COMMUNE)->find());
		
		if ($calendarEventsConfig['useCategories']['value'] == "YES")
			$smarty->assign("categories", CategoryQuery::create()->find());

		$smarty->assign('eventStatuses', CalendarEvent::getStatuses());
		$smarty->assign('kinds', CalendarEvent::getEventKinds());
		$smarty->assign('scheduleStatuses', CalendarEvent::getScheduleStatuses());
		$smarty->assign('users', UserQuery::create()->find());
		$smarty->assign('actors', ActorQuery::create()->find());
		$smarty->assign('axes', CalendarAxisQuery::create()->find());
		$smarty->assign('eventTypes', EventTypeQuery::create()->find());
		$smarty->assign('agendas', CalendarEvent::getAgendas());
		
		$calendarMediasTypes = CalendarMediaPeer::getMediaTypes();
		
		$smarty->assign("calendarMediasTypes",array_diff_assoc($calendarMediasTypes, $types));

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_GET['filters'])) {
			$smarty->assign('filters',$_GET['filters']);
		}
		
		$smarty->assign("phpSessId", session_id()); // para el SWFUpload
		
		//Elijo la vista basado en si es o no un pedido por AJAX
		if ($this->isAjax()) {
			$smarty->display('CalendarEventsEditX.tpl');
		} else {
			$this->template->template = 'TemplateJQuery.tpl';
			return $mapping->findForwardConfig('success');
		}
	}

}


