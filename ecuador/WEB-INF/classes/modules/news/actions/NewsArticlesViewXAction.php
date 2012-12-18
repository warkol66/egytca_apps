<?php

class NewsArticlesViewXAction extends BaseAction {

	function NewsArticlesViewXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "News";

  	/**
   	* Use a different template
   	*/
		$this->template->template = "TemplateAjax.tpl";

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
	}

}