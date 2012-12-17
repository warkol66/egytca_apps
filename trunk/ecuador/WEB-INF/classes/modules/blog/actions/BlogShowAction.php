<?php

class BlogShowAction extends BaseListAction {

	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function preList() {
		parent::preList();
		
		if(isset($_GET['categoryId']))
			$this->filters['categoryid'] = $_GET['categoryId'];
	}
	
	protected function postList() {
		parent::postList();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		 
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign('moduleConfig',$moduleConfig);
		
		if (isset($_REQUEST["rss"])) {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 
			//return $mapping->findForwardConfig('rss');
		}
		
	}

}
