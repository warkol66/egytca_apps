<?php

class BlogCommentsListAction extends BaseAction {

	function BlogCommentsListAction() {
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

		$module = "Blog";
		$smarty->assign("module",$module);
		$section = "Comments";
		$smarty->assign("section",$section);

		$blogCommentPeer = new BlogCommentPeer();

		//filtros
		if (isset($_GET['filters'])) {
			$smarty->assign('filters',$_GET['filters']);
			if (isset($_GET['filters']['status']))
				$blogCommentPeer->setStatus($_GET['filters']['status']);
			if (!empty($_GET['filters']['fromDate']))
				$blogCommentPeer->setFromDate($_GET['filters']['fromDate']);
			if (!empty($_GET['filters']['toDate']))
				$blogCommentPeer->setToDate($_GET['filters']['toDate']);
			if (isset($_GET['filters']['entryId']))
				$blogCommentPeer->setEntryId($_GET['filters']['entryId']);
		}

		if (isset($_GET['entryId'])) {
			$blogCommentPeer->setEntryId($_GET['entryId']);
			$pager = $blogCommentPeer->getAllPaginatedFiltered($_GET["page"]);
			$smarty->assign('entryId',$_GET['entryId']);
		}
		else {
			$entries = BlogEntryPeer::getLastEntries(50);
			$smarty->assign('entries',$entries);
			$pager = $blogCommentPeer->getAllPaginatedFiltered($_GET["page"]);
		}

		$smarty->assign("blogComments",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=blogCommentsList";

		if (isset($_GET['entryId']))
			$url .= '&entryId=' . $_GET['entryId'];

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