<?php
/**
* CommonMenuItemsShowAction
* 
*/

class CommonMenuItemsShowAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('MenuItem');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Common";
		$this->smarty->assign("module",$module);
		$moduleConfig = Common::getModuleConfiguration($module);

	}

}
