<?php

class BlogCategoriesEditAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('BlogCategory');
	}
	
	protected function postSelect() {
		parent::postSelect();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		$section = "Categories";
		$this->smarty->assign("section",$section);
		
		$this->smarty->assign("categories",BlogCategoryQuery::create()->find());
	}

}
