<?php

/*require_once("BaseAction.php");
require_once("NewsArticlePeer.php");*/

class NewsArticlesDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
		
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$module = "News";
		$this->smarty->assign("module",$module);
		
	}

}
