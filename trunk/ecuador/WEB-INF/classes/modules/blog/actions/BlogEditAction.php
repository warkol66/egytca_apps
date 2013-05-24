<?php

class BlogEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		$this->smarty->assign("actualAction", "blogEdit");
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		$blogConfig = $moduleConfig["blogEntries"];
		$this->smarty->assign("blogConfig",$moduleConfig["blogEntries"]);
		
		if ($blogConfig['useCategories']['value'] == "YES"){
			$this->smarty->assign("categoryIdValues",BlogCategoryQuery::create()->find());
		}

		//statuses y tags
		$this->smarty->assign("blogEntryStatus",BlogEntry::getStatuses());
		$this->smarty->assign("tags", BlogEntryQuery::getTagCandidates($this->entity->getId()));
		
		//si es edicion busco los documentos asociados y tipos de documentos
		if(!$this->entity->isNew()){
			$this->smarty->assign("documents", BlogEntryDocumentQuery::create()->filterByBlogEntryId($this->entity->getId())->find());
			$this->smarty->assign("documentCategories", Document::getDocumentCategories());
		}
	}

}
