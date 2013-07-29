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

		$this->perPage = $newsInHome;
		if (!isset($_GET['page']))
			$this->template->template = "TemplateNewsHome.tpl";
		else {
			$this->perPage = $newsPerPage;
			$this->template->template = "TemplatePublic.tpl";
			$this->query->offset($newsInHome);
		}

		if(isset($_GET['categoryId']))
			$this->filters['categoryid'] = $_GET['categoryId'];

		$this->filters['orderByCreationdate'] = "desc";
	}
	
	protected function postList() {
		unset($this->filters['orderByCreationdate']);
		parent::postList();

		
		$module = "News";
		$this->smarty->assign("module",$module);

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
