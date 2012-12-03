<?php

class BlogTagsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogTag');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$this->smarty->assign("module","Blog");
		$this->smarty->assign("section","Tags");
		
	}

}
