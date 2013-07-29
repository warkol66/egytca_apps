<?php

class BlogCategoriesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('BlogCategory');
	}
	
	protected function postEdit() {
		parent::postEdit();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		$section = "Categories";
		$this->smarty->assign("section",$section);
		
		$this->smarty->assign("categories",BlogCategoryQuery::create()->find());
	}

}
