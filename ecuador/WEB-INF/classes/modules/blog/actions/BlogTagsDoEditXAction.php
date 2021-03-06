<?php

class BlogTagsDoEditXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogTag');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$section = "Tags";
		$this->smarty->assign("section",$section);
		
		$this->smarty->assign('blogTag', $this->entity);
		
		if(isset($_POST['fromBlog']))
			$this->template->template = 'BlogDoAddTagX.tpl';
		
	}

}
