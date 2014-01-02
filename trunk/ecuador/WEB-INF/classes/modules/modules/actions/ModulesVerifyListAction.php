<?php

class ModulesVerifyListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Module');
	}
	
	protected function postList() {
		parent::postList();
		
		$module = "Modules";
		$this->smarty->assign("module",$module);
		
	}

}
