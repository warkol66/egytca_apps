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
			
			return $mapping->findForwardConfig('success');
		} else {
			throw new Exception('empty id'); // buscar mejor forma de que falle ajax
		}
	}

}

