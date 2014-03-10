<?php

class BlogTagsEditAction extends BaseSelectAction {

	function __construct() {
		parent::__construct('BlogTag');
	}

	protected function postSelect() {
		parent::postSelect();
		
		$this->smarty->assign("module","Blog");
		$this->smarty->assign("section","Tags");
	}

}
