<?php

class BlogCategoriesDoDeleteAction extends BaseDoDeleteAction {

	function __construct() {
		parent::__construct('BlogCategory');
	}
	
	protected function preDelete(){
		parent::preDelete();
		
		$category = BlogCategoryQuery::create()->findOneById($_POST['id']);
		
		if ($category->isRoot()){
			//solucion temporal: eliminar descendientes y hacer que no sea root (propel no permite eliminar roots)
			$category->deleteDescendants();
			$category->setLeftValue(0)->save();
		}		
			
	}

}
