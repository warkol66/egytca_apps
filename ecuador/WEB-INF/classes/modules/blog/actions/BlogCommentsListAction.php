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
		
		$blogComment = new BlogComment();
		
		if (!empty($_GET['filters'])) {
			//Arreglar
			if (!empty($_GET['filters']['fromDate']))
				$blogComment->setCommentFromDate(Common::convertToMysqlDateFormat($_GET['filters']['fromDate']));
			if (!empty($_GET['filters']['toDate']))
				$blogComment->setCommentToDate(Common::convertToMysqlDateFormat($_GET['filters']['toDate']));
			$this->smarty->assign('filters',$_GET['filters']);
		}
	}
		/* 

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
