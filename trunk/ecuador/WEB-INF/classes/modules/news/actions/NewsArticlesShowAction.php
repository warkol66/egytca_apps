<?php

class NewsArticlesShowAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
	}
	
	protected function preList() {
		parent::preList();
		
		$moduleConfig = Common::getModuleConfiguration("news");
		$newsInHome = $moduleConfig["newsInHome"];
		$newsPerPage = $moduleConfig["newsPerPage"];

		if (!empty($newsInHome)) {
			$this->perPage = $newsInHome;
			if (!isset($_GET['page']))
				$this->smarty->assign('page',1);
		}

		if(isset($_GET['categoryId']))
			$this->filters['categoryid'] = $_GET['categoryId'];
	}
	
	protected function postList() {
		parent::postList();
		
		$module = "News";
		$this->smarty->assign("module",$module);

		$this->template->template = "TemplateNewsHome.tpl";
		
		if (isset($_GET['archive']))
			$this->smarty->assign('archive',$_GET['archive']);
			/*$newsArticlePeer->setArchiveMode();
		}
		else
			$newsArticlePeer->setPublishedMode();*/
			
		
		if (isset($_REQUEST["rss"])) {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 
			//return $mapping->findForwardConfig('rss');
		}
	}

}
