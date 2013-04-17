<?php

class BlogShowAction extends BaseListAction {

	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function preList() {
		parent::preList();
		
		if(isset($_GET['categoryId']))
			$this->filters['categoryid'] = $_GET['categoryId'];

		//TODO: Revisar por qu eno funciona directo con el filterByBlogTag
		if(isset($_GET['tagId']))
			$this->filters['blogTag'] = BaseQuery::create('BlogTag')->findOneById($_GET['tagId']);

		if(isset($_GET['tagId']))
			$this->filters['entityFilter'] = array(
				'entityType' => "BlogTag",
				'entityId' => $_GET['tagId']
			);
	}
	
	protected function postList() {
		parent::postList();
		
		$this->template->template = "TemplatePublic.tpl";

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
