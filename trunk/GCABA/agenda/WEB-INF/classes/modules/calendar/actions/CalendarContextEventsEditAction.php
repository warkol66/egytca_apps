<?php

class CalendarContextEventsEditAction extends BaseAction {
	
	function CalendarContextEventsEditAction() {
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
		
		if ( !empty($_GET["id"]) ) {
			//voy a editar un evento
			$calendarEvent = CalendarContextEventQuery::create()->findOneById($_GET["id"]);
			$smarty->assign("calendarEvent",$calendarEvent);
		}
		else {
			//voy a crear un calendarevent nuevo
			$calendarEvent = new CalendarContextEvent();
			$smarty->assign("calendarEvent",$calendarEvent);

		}
		
		if ($calendarEventsConfig['useRegions']['value'] == "YES")
			$smarty->assign("regions", RegionQuery::create()->find());
		
		if ($calendarEventsConfig['useCategories']['value'] == "YES")
			$smarty->assign("categories", CategoryQuery::create()->find());

		$smarty->assign("users", UserQuery::create()->find());
		$smarty->assign('actors', ActorQuery::create()->find());
		$smarty->assign('axes', CalendarAxisQuery::create()->find());
		$smarty->assign('eventTypes', EventTypeQuery::create()->find());
		$smarty->assign('agendaTypes', CalendarEventPeer::getAgendas());
		$smarty->assign("calendarEventStatus",CalendarEventPeer::getStatus());
		$smarty->assign("contextTypes",CalendarContextEvent::getContextTypes());
		

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_GET['filters']))
			$smarty->assign('filters',$_GET['filters']);
		
		$this->template->template = 'TemplateJQuery.tpl';

		return $mapping->findForwardConfig('success');
	}

}


