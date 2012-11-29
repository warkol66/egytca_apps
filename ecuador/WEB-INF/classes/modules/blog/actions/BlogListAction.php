<?php

class BlogListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}

	protected function preList() {
		parent::preList();
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "Blog";
		$this->smarty->assign("module", $module);
		
		$blogEntry = new BlogEntry();
		$blogEntry->setReverseOrder();

 		if (!empty($_GET['filters'])) {
			
			if (!empty($_GET['filters']['fromDate']))
				$blogEntry->setFromDate(Common::convertToMysqlDateFormat($_GET['filters']['fromDate']));
			if (!empty($_GET['filters']['toDate']))
				$blogEntry->setToDate(Common::convertToMysqlDateFormat($_GET['filters']['toDate']));
			
			if (!empty($_GET['filters']['categoryid'])) {
				$blogEntry->setCategory($_GET['filters']['categoryid']);
			}
			
			$this->smarty->assign('filters',$_GET['filters']);
		}

		//como manejar esto ahora?
		if ($_GET["export"] == "xls") {
			$blogEntries = $blogEntry->getAllFiltered();

			$this->smarty->assign("blogEntries",$blogEntries);
			$forwardConfig = $mapping->findForwardConfig('xml');

			$this->template->template = "TemplateJQuery.tpl";

			$xml = $this->smarty->fetch($forwardConfig->getPath());

			require_once("ExcelManagement.php");
			$excel = new ExcelManagement();			
			$excel->sendXlsFromXml($xml);
			die;
		}
		
		$pager = $blogEntry->getAllPaginatedFiltered($_GET["page"]);
		$this->smarty->assign("blogEntries",$pager->getResult());
		$this->smarty->assign("pager",$pager);
		
		$this->smarty->assign("categories",BlogCategory::getAll());
		$this->smarty->assign("blogEntryStatus",BlogEntry::getStatuses());

	}

}
