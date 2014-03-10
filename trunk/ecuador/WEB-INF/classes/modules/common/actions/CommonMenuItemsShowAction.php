<?php
/**
* CommonMenuItemsShowAction
* 
*/

class CommonMenuItemsShowAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('MenuItem');
	}

	protected function postSelect() {
		parent::postSelect();
		
		$module = "Common";
		$this->smarty->assign("module",$module);
		$moduleConfig = Common::getModuleConfiguration($module);

	}

}
