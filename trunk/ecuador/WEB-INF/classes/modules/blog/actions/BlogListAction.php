<?php

class BlogListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}

	protected function postList() {
		parent::postList();
		
		$module = "Blog";
		$this->smarty->assign("module", $module);

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
		
		$this->smarty->assign("categories",BlogCategoryQuery::create()->find());
		$this->smarty->assign("blogEntryStatus",BlogEntry::getStatuses());

	}

}
