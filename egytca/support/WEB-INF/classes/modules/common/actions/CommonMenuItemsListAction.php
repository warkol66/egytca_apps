<?php
/**
* CommonMenuItemsListAction
*
*  Lista items de menus.
*
* @package actionlogs
*/

require_once("BaseAction.php");

class CommonMenuItemsListAction extends BaseAction {

	function CommonMenuItemsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = "Common";
		$smarty->assign("module",$module);

		$parentId = (empty($_GET['parentId'])) ? NULL : $_GET['parentId'];
		
		$menuItems = MenuItemQuery::create()->filterByParentId($parentId)->orderByOrder()->find();
		
		$smarty->assign("parentId",$parentId);
		$smarty->assign("menuItems", $menuItems);
		
		return $mapping->findForwardConfig('success');

	}

}
