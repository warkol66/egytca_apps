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

		//users, statuses y tags
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		$this->smarty->assign("blogEntryStatus",BlogEntry::getStatuses());
		$this->smarty->assign("tags", BlogEntryQuery::getTagCandidates($this->entity->getId()));
	}

}
