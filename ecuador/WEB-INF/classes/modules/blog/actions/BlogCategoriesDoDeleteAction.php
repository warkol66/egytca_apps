<?php

class BlogCategoriesDoDeleteAction extends BaseDoDeleteAction {

	function __construct() {
		parent::__construct('BlogCategory');
	}
	
	protected function preDelete(){
		parent::preDelete();
		
		$category = BlogCategoryQuery::create()->findOneById($_POST['id']);
		
		if ($category->isRoot()){
			BlogCategoryPeer::deleteTree($category->getScope());
			//return $mapping->findForwardConfig('success');
		}		
			
	}

}
