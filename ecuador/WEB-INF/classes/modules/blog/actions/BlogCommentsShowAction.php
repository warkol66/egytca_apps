<?php

class BlogCommentsShowAction extends BaseSelectAction {

	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function postSelect() {
		parent::postSelect();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		
		$this->smarty->assign($comments, $this->entity->getBlogComments());
	}

}
