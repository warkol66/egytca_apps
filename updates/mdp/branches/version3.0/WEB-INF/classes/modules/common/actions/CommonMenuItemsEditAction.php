<?php
/**
* CommonMenuItemsEditAction
* 
* Muestra el formulario para permitir la edición de un menú
* 
*/

require_once("BaseAction.php");
require_once("Content.class.php");
require_once("FormPeer.php");

class CommonMenuItemsEditAction extends BaseAction {

	function CommonMenuItemsEditAction() {
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
		
		$languages = Common::getAllLanguages();
		$smarty->assign("languages",$languages);

		//es la edicion de un menú
		if (isset($_GET['id'])) {
			$menuItem = MenuItemQuery::create()->findPK($_GET['id']);
			$smarty->assign("menuItem",$menuItem);
			$smarty->assign("parentId",$menuItem->getParentId());
			$smarty->assign("params", $menuItem->getParams());
			return $mapping->findForwardConfig('success');
		}
		
		//es la creacion de un menú
		$parentId = (empty($_GET['parentId'])) ? NULL : $_GET['parentId'];
		$smarty->assign("parentId",$_GET['parentId']);
		$smarty->assign("create",true);
		$menuItem = new MenuItem();
		$smarty->assign("menuItem",$menuItem);
		return $mapping->findForwardConfig('success');
	}

}
