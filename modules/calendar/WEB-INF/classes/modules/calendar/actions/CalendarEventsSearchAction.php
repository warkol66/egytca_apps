<?php

require_once("BaseAction.php");
require_once("CalendarEventPeer.php");

class CalendarEventsSearchAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarEventsSearchAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

    	BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
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