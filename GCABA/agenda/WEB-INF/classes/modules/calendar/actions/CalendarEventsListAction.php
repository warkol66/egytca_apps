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

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$smarty->assign("calendarEventsConfig",$calendarEventsConfig);
		
		$calendarEventPeer = new CalendarEventPeer();
		$calendarEventPeer->setOrderById();
		$calendarEventPeer->setOrderByCreationDate();
		

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


		$pager = $calendarEventPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("calendarEvents",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=calendarEventsList";
		
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		
		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";
		
		$smarty->assign("url",$url);		

		$smarty->assign("categories",CategoryQuery::create()->find());

		$smarty->assign("calendarEventStatus",CalendarEventPeer::getStatus());   

		$smarty->assign('eventStatuses', CalendarEvent::getStatuses());
		$smarty->assign('scheduleStatuses', CalendarEvent::getScheduleStatuses());

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}