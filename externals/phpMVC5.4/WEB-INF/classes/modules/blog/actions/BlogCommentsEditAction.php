<?php

class BlogCommentsEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('BlogComment');
	}

	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("module",$module);

		$this->smarty->assign("statusOptions",BlogComment::getStatusOptions());
		$this->smarty->assign("entryIdValues",BlogEntryQuery::create()->find());
		
	}

}
