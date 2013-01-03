<?php

class NewsCommentsDoEditAction extends BaseAction {
	
	function __construct() {
		parent::__construct('NewsComment');
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","News");
		
	}

}
