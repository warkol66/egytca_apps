<?php

class BlogListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}

	protected function preList() {
		parent::preList();
		
		if (!empty($_GET['filters'])) {
			
			if (!empty($_GET['filters']['fromdate']))
				$_GET['filters']['fromdate'] = Common::convertToMysqlDateFormat($_GET['filters']['fromdate']);
			if (!empty($_GET['filters']['todate']))
				$_GET['filters']['todate'] = Common::convertToMysqlDateFormat($_GET['filters']['todate']);
		}
	}

	protected function postList() {
		parent::postList();
		
		$module = "Blog";
		$this->smarty->assign("module", $module);
		
		$blogEntry = new BlogEntry();
		$blogEntry->setReverseOrder();

		//como manejar esto ahora?
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
		
		$this->smarty->assign("categories",BlogCategory::getAll());
		$this->smarty->assign("blogEntryStatus",BlogEntry::getStatuses());

	}

}
