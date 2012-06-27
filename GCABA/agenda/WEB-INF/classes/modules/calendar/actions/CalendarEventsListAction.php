<?php

class CalendarEventsListAction extends BaseAction {

	function CalendarEventsListAction() {
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

		if (isset($_GET['page']))
			$page = $_GET['page'];
		else
			$page = 1;

		if (!empty($_GET['filters'])) {
			$filters = $_GET['filters'];
			$smarty->assign('filters', $filters);
		}

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$smarty->assign("calendarEventsConfig",$calendarEventsConfig);

		$pager = BaseQuery::create('CalendarEvent')->orderById(Criteria::DESC)->orderByStartdate(Criteria::ASC)->createPager($filters, $page, Common::getRowsPerPage());
		$smarty->assign('pager', $pager);
		$smarty->assign('events', $pager->getResults());
		$url = "Main.php?do=calendarEventsList";

		if ($page != 1)
			$url .= '&page=' . $_GET['page'];

		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";
		
		$smarty->assign("url",$url);		

		$smarty->assign("categories",CategoryQuery::create()->find());

		$smarty->assign('eventStatuses', CalendarEvent::getStatuses());
		$smarty->assign('scheduleStatuses', CalendarEvent::getScheduleStatuses());

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}