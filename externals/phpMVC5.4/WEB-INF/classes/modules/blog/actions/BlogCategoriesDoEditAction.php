<?php

class BlogCategoriesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogCategory');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$module = "Blog";
		$section = "Categories";
		
		//Arreglar cambio o asignacion de padre a uno existente (update)
		if($_POST['action'] == 'edit')
			BlogCategory::updateCat($_POST["id"],$_POST["params"]);
		else
			BlogCategory::createCat($this->entity->getId(),$_POST["params"]);	
	}

}
