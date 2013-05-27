<?php

class BlogDocumentsListXAction extends BaseListAction {
	
	public function __construct() {
		parent::__construct('BlogEntryDocument');
	}
	
	protected function preList() {
		parent::preList();
		$this->query->filterByBlogEntryId($_POST['id']);
		$this->template->template = 'TemplateAjax.tpl';
		
		$this->smarty->assign("id",$_POST['id']);
	}
}
