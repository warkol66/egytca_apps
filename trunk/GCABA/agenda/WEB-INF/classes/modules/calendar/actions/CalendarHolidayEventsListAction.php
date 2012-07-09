<?php

class CalendarHolidayEventsListAction extends BaseAction {

	function CalendarHolidayEventsListAction() {
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
		

 		if (!empty($_GET['filters'])) {
			
			if (!empty($_GET['filters']['fromDate'])) {
				$calendarEventPeer->setFromDate(Common::convertToMysqlDateFormat($_GET['filters']['fromDate']));
			}
			
			if (!empty($_GET['filters']['toDate'])) {
				$calendarEventPeer->setToDate(Common::convertToMysqlDateFormat($_GET['filters']['toDate']));
			}
			
			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$calendarEventPeer->setCategory($category);			
			}
			
			$smarty->assign('filters',$_GET['filters']);
		}

//		$events = BaseQuery::create('CalendarHolidayEvent')->addFilters($filters);

		$filters = $request->getParameterValues("filters");

		if (isset($filters["perPage"]) && $filters["perPage"] > 0)
			$perPage = $filters["perPage"];
		else
			$perPage = Common::getRowsPerPage();

		$pager = BaseQuery::create('CalendarHolidayEvent')->createPager($filters, $_GET['page'], $perPage);

		$smarty->assign("events",$pager->getResults());
		$smarty->assign("pager",$pager);
		$smarty->assign("filters", $filters);

		$url = "Main.php?do=calendarHolidayEventsList";
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$user = Common::getAdminLogged();
		if ($user)
			$smarty->assign("categories",$user->getCategoriesByModule('calendar'));

		$smarty->assign("calendarEventStatus",CalendarEventPeer::getStatus());   
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}