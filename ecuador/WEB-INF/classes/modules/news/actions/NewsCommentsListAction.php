<?php

class NewsCommentsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('NewsComment');
	}
	
	protected function postList(){
		parent::postList();
		
		$this->smarty->assign("module","News");
		$this->smarty->assign("section","Comments");
		
		$this->smarty->assign("entries", BlogEntryQuery::create()->find());
		
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
