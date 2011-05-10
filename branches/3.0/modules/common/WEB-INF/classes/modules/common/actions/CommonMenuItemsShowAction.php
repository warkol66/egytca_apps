<?php
/**
* CommonMenuItemsShowAction
* 
*/

require_once("BaseAction.php");

class CommonMenuItemsShowAction extends BaseAction {

	function CommonMenuItemsShowAction() {
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
		$moduleConfig = Common::getModuleConfiguration($module);

		if (!empty($_GET['id'])) {
			$menuItem = MenuItemQuery::create()->findPK($_GET['id']);
			$smarty->assign("menuItem",$menuItem);
			return $mapping->findForwardConfig("success");
		}
		// TODO implementar este forward.
		return $mapping->findForwardConfig("failure");
	}

}
