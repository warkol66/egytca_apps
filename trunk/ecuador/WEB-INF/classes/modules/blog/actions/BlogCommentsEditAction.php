<?php

class BlogCommentsEditAction extends BaseSelectAction {

	function __construct() {
		parent::__construct('BlogComment');
	}

	protected function postSelect() {
		parent::postSelect();

		$this->smarty->assign("module",$module);

		$this->smarty->assign("statusOptions",BlogComment::getStatusOptions());
		$this->smarty->assign("entryIdValues",BlogEntryQuery::create()->find());
		
	}

}
