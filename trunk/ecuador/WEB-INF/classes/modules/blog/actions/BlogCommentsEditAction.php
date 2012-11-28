<?php

class BlogCommentsEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('BlogComment');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("statusOptions",BlogComment::getStatusOptions());
		$this->smarty->assign("entryIdValues",BlogEntryQuery::create()->find());
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		
		if (isset($_GET['filters']))
			$this->smarty->assign('filters',$_GET['filters']);
		if (isset($_GET['articleId']))
			$this->smarty->assign('articleId',$_GET['articleId']);
	}

}
