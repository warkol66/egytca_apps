<?php

class CalendarShowAction extends BaseListAction {

	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function preList() {
		parent::preList();
		
		//Agregar filtros para poder hacer esto
		if(!empty($_GET['archive']))
			//restarle un dia
            $this->filters['dateRange']['enddate']['max'] = date('Y-m-d');
        else
            $this->filters['dateRange']['enddate']['min'] = date('Y-m-d');
		
	}
	
	protected function postList() {
		parent::postList();
		
		$this->template->template = "TemplatePublic.tpl";

		$module = "Calendar";
		$this->smarty->assign("module",$module);
		
		if (isset($_REQUEST["rss"])) {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 
			//return $mapping->findForwardConfig('rss');
		}
		
	}

}
