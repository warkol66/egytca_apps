<?php

class BlogTagsEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('BlogTag');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		$section = "Tags";
		$this->smarty->assign("section",$section);
	}

}
