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
		
		if(!empty($_GET['filters'])){
			$filtersUrl = http_build_query(array('filters' => $_GET['filters']));
			$this->smarty->assign("filtersUrl", $filtersUrl);
		}

		//users, statuses y tags
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		$this->smarty->assign("blogEntryStatus",BlogEntry::getStatuses());
		$this->smarty->assign("tags", BlogTagQuery::create()->find());
	}

}
