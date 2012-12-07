<?php

class BlogShowAction extends BaseListAction {

	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function postList() {
		parent::postList();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		 
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign('moduleConfig',$moduleConfig);
		
		/*	Falta contemplar este caso
		 * if (isset($_REQUEST["rss"])) {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 
			return $mapping->findForwardConfig('rss');
		}*/
		
	}

}
