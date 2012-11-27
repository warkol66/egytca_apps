<?php

class BlogCommentsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BlogComment');
	}
	
	protected function postList(){
		parent::postList();
		
		$this->smarty->assign("module","Blog");
		$this->smarty->assign("section","Comments");
		
		$this->smarty->assign("entries", BlogEntryQuery::create()->find());
	}
		/* Arreglar filtro de fechas
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
	}*/

}
