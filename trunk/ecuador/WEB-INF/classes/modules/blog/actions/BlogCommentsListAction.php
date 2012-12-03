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
			//Arreglar
			if (!empty($_GET['filters']['fromDate']))
				$_GET['filters']['fromDate'] = Common::convertToMysqlDateFormat($_GET['filters']['fromDate']);
			if (!empty($_GET['filters']['toDate']))
				$_GET['filters']['toDate'] = Common::convertToMysqlDateFormat($_GET['filters']['toDate']);
		}
	}

}
