<?php

class ModulesEntitiesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('ModuleEntity');
	}
	
	protected function postList() {
		parent::postList();
		
		$module = "Modules";
		$this->smarty->assign("module",$module);
		$section = "Entities";
		$this->smarty->assign("section",$section);

	}

}
