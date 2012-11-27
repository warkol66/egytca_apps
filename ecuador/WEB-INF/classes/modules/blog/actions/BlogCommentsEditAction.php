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
	}
	/*
		//redireccionamientos
		if (isset($_GET['filters']))
			$smarty->assign('filters',$_GET['filters']);
		if (isset($_GET['articleId']))
			$smarty->assign('articleId',$_GET['articleId']);

		return $mapping->findForwardConfig('success');
	}*/

}
