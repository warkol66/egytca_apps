<?php

require_once("BaseAction.php");
require_once("CalendarEventPeer.php");
require_once("CategoryPeer.php");

class CalendarEventsListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarEventsListAction() {
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

		$user = Common::getAdminLogged();
		$categories = $user->getCategoriesByModule('news');
		$smarty->assign("categories",$categories);
		$smarty->assign("calendarEventStatus",CalendarEventPeer::getStatus());   
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}