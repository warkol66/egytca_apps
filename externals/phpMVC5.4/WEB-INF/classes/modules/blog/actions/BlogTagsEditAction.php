<?php

class BlogTagsEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('BlogTag');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$this->smarty->assign("module","Blog");
		$this->smarty->assign("section","Tags");
	}

}
