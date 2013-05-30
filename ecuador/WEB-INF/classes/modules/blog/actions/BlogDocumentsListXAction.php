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
	
	protected function postList() {
		parent::postList();
		
		$this->smarty->assign("photos", BlogEntryDocumentQuery::create()->useDocumentQuery()->filterByType(Document::DOCUMENT_IMAGE)->endUse()->filterByBlogEntryId($_POST['id'])->find());
	}
}
