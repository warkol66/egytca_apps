<?php

class BlogCommentsShowAction extends BaseEditAction {

	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function postEdit() {
		parent::postEdit();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		
		$this->smarty->assign($comments, $this->entity->getBlogComments());
	}

}
