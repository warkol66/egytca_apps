<?php

class NewsCommentsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('NewsComment');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "News";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("articleIdValues",NewsArticleQuery::create()->find());		
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		$this->smarty->assign("statuses",NewsComment::getStatusOptions());
		
	}

}
