<?php

class BlogCommentsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogComment');
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","Blog");
		
	}

}
