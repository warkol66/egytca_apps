<?php

class NewsArticlesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
		
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$module = "News";
		$this->smarty->assign("module",$module);
		
	}

}
