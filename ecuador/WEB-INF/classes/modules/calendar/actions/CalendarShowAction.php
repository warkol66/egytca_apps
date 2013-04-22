<?php

class CalendarShowAction extends BaseListAction {

	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preList() {
		parent::preList();
		
	}
	
	protected function postList() {
		parent::postList();
		
		$this->template->template = "TemplatePublic.tpl";

		$module = "Calendar";
		$this->smarty->assign("module",$module);
		 
		//modo archivo
		/*if (isset($_GET['archive'])) {
			$smarty->assign('archive',$_GET['archive']);
			$calendarEventPeer->setArchiveMode();
		}
		else
			$calendarEventPeer->setPublishedMode();*/
		
		if (isset($_REQUEST["rss"])) {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 
			//return $mapping->findForwardConfig('rss');
		}
		
	}

}
