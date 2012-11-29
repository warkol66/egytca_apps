<?php

class BlogTagsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogTag');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$module = "Blog";
		$section = "Tags";
		$this->smarty->assign("module",$module);
		$this->smarty->assign("section",$section);
		
	}

}
