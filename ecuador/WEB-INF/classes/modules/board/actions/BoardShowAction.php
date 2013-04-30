<?php

class BoardShowAction extends BaseListAction {

	function __construct() {
		parent::__construct('BoardChallenge');
	}
	
	protected function preList() {
		parent::preList();
		
		$this->filters['status'] = 2; //Solo las entradas publicadas
		
	}
	
	protected function postList() {
		parent::postList();
		
		$this->template->template = "TemplatePublic.tpl";

		$module = "Board";
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
