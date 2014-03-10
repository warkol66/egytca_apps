<?php

class NewsCommentsShowAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
	}
	
	protected function postSelect() {
		parent::postSelect();
		
		$module = "News";
		$this->smarty->assign("module",$module);
		
		$this->smarty->assign($comments, NewsArticleQuery::getArticleComments($this->entity->getid()));
		
		//$this->template->template = "TemplateAjax.tpl";
	}

}
