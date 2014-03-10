<?php

class NewsArticlesViewXAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
	}
	
	protected function postSelect() {
		parent::postSelect();
		
	}

/*
 		if (!empty($_GET["page"])) {

			$perPage = 1;
			
			$newsArticlesPeer = new NewsArticlePeer();
			$newsArticlesPeer->setOrderByCreationDate();
			$newsArticlesPeer->setPublishedMode();
			
			$newsArticlesPager = $newsArticlesPeer->getAllPaginatedFiltered($_GET['page'], $perPage);

			$smarty->assign("pager", $newsArticlesPager);
			$newsArticles = $newsArticlesPager->getResult();
			$smarty->assign("newsArticle",$newsArticles[0]);
			$smarty->assign("page",$_GET['page']);

		}
		else {
			return $mapping->findForwardConfig('failure');			
		}
		return $mapping->findForwardConfig('success');
	}*/

}
