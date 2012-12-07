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
		
		if (!empty($_GET['filters'])) {
			
			if (!empty($_GET['filters']['dateRange']['creationdate']['min']))
				$_GET['filters']['dateRange']['creationdate']['min'] = Common::convertToMysqlDateFormat($_GET['filters']['dateRange']['creationdate']['min']);
			if (!empty($_GET['filters']['dateRange']['creationdate']['max']))
				$_GET['filters']['dateRange']['creationdate']['max'] = Common::convertToMysqlDateFormat($_GET['filters']['dateRange']['creationdate']['max']);
		}
	}

}
