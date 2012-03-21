<?php

class CalendarEventsSearchAction extends BaseAction {

	function CalendarEventsSearchAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

   	BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		//usamos el template para no autenticado.
		$this->template->template = "TemplateNewsSearch.tpl";
		
		$calendarEventPeer = new calendarEventPeer();
		$calendarEventPeer->setOrderByUpdateDate();
		$calendarEventPeer->setPublishedMode();
				
		if (!empty($_GET['searchSubmit'])) {
			
			$smarty->assign('searchString',$_GET['searchString']);
			
			$calendarEventPeer->setSearchString($_GET['searchString']);
			
			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$calendarEventPeer->setCategory($category);
			}
			
			if (!empty($_GET['filters']['fromDate'])) {
		    	$fromDate = Common::convertToMysqlDateFormat($_GET['filters']['fromDate']);
		    	$calendarEventPeer->setFromDate($fromDate);
			}
			
			if (!empty($_GET['filters']['toDate'])) {
				$toDate = Common::convertToMysqlDateFormat($_GET['filters']['toDate']);
				$calendarEventPeer->setToDate($toDate);
			}
			
			if (!empty($_GET['filters']['regionId'])) {
				$region = RegionPeer::get($_GET['filters']['regionId']);
				$calendarEventPeer->setRegion($region);
			}
			
			if (!empty($_GET['filters']['archive'])) {
				$calendarEventPeer->setArchiveAndPublishedMode();
			}		

			$smarty->assign('filters',$_GET['filters']);
			
			$smarty->assign('categorySelected',$category);						
			$categories = CategoryPeer::getAllPublicByModule('news');
			$smarty->assign("categories",$categories);
			
			$smarty->assign('regionSelected',$region);
			$regions = RegionPeer::getAll();
			$smarty->assign("regions",$regions);
			
			$smarty->assign('archive',$_GET['filters']['archive']);
			
    		$pager = $calendarEventPeer->getAllPaginatedFiltered($_GET["page"]);
			$smarty->assign("calendarEvents",$pager->getResult());
			$smarty->assign("pager",$pager);
			$url = "Main.php?do=calendarEventsList";
		
			if (isset($_GET['page']))
				$url .= '&page=' . $_GET['page'];
		
			$smarty->assign("url",$url);		
		
		}
		
		if ($_REQUEST["rss"]=="1") {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 	
			return $mapping->findForwardConfig('rss');
		}

		return $mapping->findForwardConfig('success');
	

	}

}