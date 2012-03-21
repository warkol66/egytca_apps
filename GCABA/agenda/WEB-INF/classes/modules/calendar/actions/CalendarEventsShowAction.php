<?php

class CalendarEventsShowAction extends BaseAction {

	function CalendarEventsShowAction() {
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