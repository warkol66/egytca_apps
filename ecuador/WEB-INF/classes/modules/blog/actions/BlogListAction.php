<?php

class BlogListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}

	protected function preList() {
		parent::preList();
		$this->module = "BlogEntry";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		
		$blogEntryPeer = new BlogEntryPeer();
		$blogEntryPeer->setReverseOrder();

 		if (!empty($_GET['filters'])) {
			
			if (!empty($_GET['filters']['fromDate']))
				$blogEntryPeer->setFromDate(Common::convertToMysqlDateFormat($_GET['filters']['fromDate']));
			
			if (!empty($_GET['filters']['toDate']))
				$blogEntryPeer->setToDate(Common::convertToMysqlDateFormat($_GET['filters']['toDate']));
			
			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$blogEntryPeer->setCategory($category);			
			}
			
			$this->smarty->assign('filters',$_GET['filters']);
		}


		if ($_GET["export"] == "xls") {
			$blogEntries = $blogEntryPeer->getAllFiltered();

			$this->smarty->assign("blogEntries",$blogEntries);
			$forwardConfig = $mapping->findForwardConfig('xml');

			$this->template->template = "TemplateJQuery.tpl";

			$xml = $this->smarty->fetch($forwardConfig->getPath());

			require_once("ExcelManagement.php");
			$excel = new ExcelManagement();			
			$excel->sendXlsFromXml($xml);
			die;
		}
		
		$pager = $blogEntryPeer->getAllPaginatedFiltered($_GET["page"]);
		$this->smarty->assign("blogEntries",$pager->getResult());
		$this->smarty->assign("pager",$pager);
		$url = "Main.php?do=blogList";
		
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		
		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";
		
		$this->smarty->assign("url",$url);		

		$categories = BlogCategoryPeer::getAll();
		$this->smarty->assign("categories",$categories);
		$this->smarty->assign("blogEntryStatus",BlogEntryPeer::getStatus());   
		$this->smarty->assign("message",$_GET["message"]);

	}

}
