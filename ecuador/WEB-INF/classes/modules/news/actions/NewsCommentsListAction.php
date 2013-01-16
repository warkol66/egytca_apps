<?php

class NewsCommentsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('NewsComment');
	}
	
	protected function preList() {
		parent::preList();
		
		if(!empty($_GET['filters']['minDate']) || !empty($_GET['filters']['maxDate']))
			unset($this->filters['dateRange']);
		if(!empty($_GET['filters']['minDate'])){
            $this->filters['dateRange']['creationdate']['min'] = $_GET['filters']['minDate'];
        }
        if(!empty($_GET['filters']['maxDate'])){
            $this->filters['dateRange']['creationdate']['max'] = $_GET['filters']['maxDate'];
		}
		
	}
	
	protected function postList(){
		parent::postList();
		
		$this->smarty->assign("module","News");
		$this->smarty->assign("section","Comments");
		
		$this->smarty->assign("articles", NewsArticleQuery::create()->find());
		
		//filtros
		if(!empty($_GET['filters']['dateRange']['creationdate']['min']))
            $this->filters['minDate'] = $_GET['filters']['dateRange']['creationdate']['min'];
        if(!empty($_GET['filters']['dateRange']['creationdate']['max']))
            $this->filters['maxDate'] = $_GET['filters']['dateRange']['creationdate']['max'];
            
        $this->smarty->assign("filters",$this->filters);
		
		//chequear con el tpl
		/*if (isset($_GET['articleId'])) {
			$newsCommentPeer->setArticleId($_GET['articleId']);
			$pager = $newsCommentPeer->getAllPaginatedFiltered($_GET["page"]);
			$smarty->assign('articleId',$_GET['articleId']);
		}
		else {	
			$articles = NewsArticlePeer::getLastArticles(50);
			$smarty->assign('articles',$articles);
			$pager = $newsCommentPeer->getAllPaginatedFiltered($_GET["page"]);
		}*/
	}
}
