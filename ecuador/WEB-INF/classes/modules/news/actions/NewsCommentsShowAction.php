<?php

class NewsCommentsShowAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
	}
	
	protected function postEdit() {
		parent::postEdit();
		
		$module = "News";
		$this->smarty->assign("module",$module);
		
		$this->smarty->assign($comments, NewsArticleQuery::getArticleComments($this->entity->getid()));
		
		//$this->template->template = "TemplateAjax.tpl";
	}

}
