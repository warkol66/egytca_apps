<?php

require_once("BaseAction.php");
require_once("CalendarEventPeer.php");

class CalendarEventsShowAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarEventsShowAction() {
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

  	/**
   	* Use a different template
   	*/
		$this->template->template = "TemplatePublic.tpl";
						
 		$calendarEventPeer = new CalendarEventPeer();
		$calendarEventPeer->setOrderByUpdateDate();
		//modo archivo
		if (isset($_GET['archive'])) {
			$smarty->assign('archive',$_GET['archive']);
			$calendarEventPeer->setArchiveMode();
		}
		else
			$calendarEventPeer->setPublishedMode();

		$pager = $calendarEventPeer->getAllPaginatedFiltered($_GET["page"]);
		
		$smarty->assign("calendarEvents",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=calendarEventsShow";
		if (isset($_GET['archive'])) 
			$url .= "&archive=1";
		$smarty->assign("url",$url);				
		
		if ($_REQUEST["rss"]=="1") {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 	
			return $mapping->findForwardConfig('rss');
		}
   
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}