<?php
/**
* CommonMenuItemsDoDeleteXAction
*
* Permite mediante Ajax la eliminacion de una X.
*
* @package  projects
*/

class CommonMenuItemsDoDeleteXAction extends BaseAction {

	function CommonMenuItemsDoDeleteXAction() {
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

		$menuItemId = $_POST['id'];

		$smarty->assign("id", $menuItemId);

		if (MenuItemPeer::delete($menuItemId))
			return $mapping->findForwardConfig("success");

		return $mapping->findForwardConfig("failure");
	}

}
