<?php

require_once("BaseAction.php");
require_once("NewsCommentPeer.php");
require_once("NewsArticlePeer.php");

class NewsCommentsListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsCommentsListAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
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
		$smarty->assign("module",$module);
		$section = "Comments";
		$smarty->assign("section",$section);
				
		$newsCommentPeer = new NewsCommentPeer();

		//filtros
		if (isset($_GET['filters'])) {
			$smarty->assign('filters',$_GET['filters']);
			
			if (isset($_GET['filters']['status'])) {
				$newsCommentPeer->setStatus($_GET['filters']['status']);
			}
				
			if (!empty($_GET['filters']['fromDate'])) {
				$newsCommentPeer->setFromDate($_GET['filters']['fromDate']);
			}
			
			if (!empty($_GET['filters']['toDate'])) {
				$newsCommentPeer->setToDate($_GET['filters']['toDate']);
			}
			
			if (isset($_GET['filters']['articleId'])) {
				$newsCommentPeer->setArticleId($_GET['filters']['articleId']);
			}
				
		}
		
		if (isset($_GET['articleId'])) {
			$newsCommentPeer->setArticleId($_GET['articleId']);
			$pager = $newsCommentPeer->getAllPaginatedFiltered($_GET["page"]);
			$smarty->assign('articleId',$_GET['articleId']);
		}
		else {	
			$articles = NewsArticlePeer::getLastArticles(50);
			$smarty->assign('articles',$articles);
			$pager = $newsCommentPeer->getAllPaginatedFiltered($_GET["page"]);
		}

		$smarty->assign("newscomments",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=newsCommentsList";
		
		if (isset($_GET['articleId']))
			$url .= '&articleId=' . $_GET['articleId'];
		
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		
		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";
					
		$smarty->assign("url",$url);		
   
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}