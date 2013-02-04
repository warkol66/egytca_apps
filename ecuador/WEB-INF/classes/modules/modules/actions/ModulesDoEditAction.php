<?php

class ModulesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('Module');
		
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$module = "Modules";
		$this->smarty->assign("module",$module);
		
	}

}
