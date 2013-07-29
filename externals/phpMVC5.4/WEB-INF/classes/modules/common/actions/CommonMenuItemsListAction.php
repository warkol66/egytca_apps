<?php
/**
* CommonMenuItemsListAction
*
*  Lista items de menus.
*
* @package actionlogs
*/

class CommonMenuItemsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('MenuItem');
	}
	
	protected function preList() {
		parent::preList();
		
		$parentId = (empty($_GET['parentId'])) ? NULL : $_GET['parentId'];
		$this->filters['parentId'] = $parentId;
		$this->smarty->assign('parentId',$parentId);

	}
	
	protected function postList() {
		parent::postList();
		
		$module = "Common";
		$this->smarty->assign("module",$module);


	}
	
}
