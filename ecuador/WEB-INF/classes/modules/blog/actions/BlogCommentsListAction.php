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

}
