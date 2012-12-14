<?php

class BlogListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function preList() {
		parent::preList();
		
		if(!empty($_GET['filters']['minDate']) || !empty($_GET['filters']['maxDate']))
			unset($this->filters['dateRange']);
		if(!empty($_GET['filters']['minDate'])){
            $this->filters['dateRange']['creationdate']['min'] = $_GET['filters']['minDate'];
        }
        if(!empty($_GET['filters']['maxDate'])){
            $this->filters['dateRange']['creationdate']['max'] = $_GET['filters']['maxDate'];
		}
		
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "Blog";
		$this->smarty->assign("module", $module);

		/*if ($_GET["export"] == "xls") {
			$blogEntries = $blogEntry->getAllFiltered();

			$this->smarty->assign("blogEntries",$blogEntries);
			$forwardConfig = $mapping->findForwardConfig('xml');

			$this->template->template = "TemplateJQuery.tpl";

			$xml = $this->smarty->fetch($forwardConfig->getPath());

			require_once("ExcelManagement.php");
			$excel = new ExcelManagement();			
			$excel->sendXlsFromXml($xml);
			die;
		}*/
		
		if(!empty($_GET['filters']['dateRange']['creationdate']['min']))
            $this->filters['minDate'] = $_GET['filters']['dateRange']['creationdate']['min'];
        if(!empty($_GET['filters']['dateRange']['creationdate']['max']))
            $this->filters['maxDate'] = $_GET['filters']['dateRange']['creationdate']['max'];
		
		$this->smarty->assign("filters",$this->filters);
		
		$this->smarty->assign("categories",BlogCategoryQuery::create()->find());
		$this->smarty->assign("blogEntryStatus",BlogEntry::getStatuses());

	}

}
