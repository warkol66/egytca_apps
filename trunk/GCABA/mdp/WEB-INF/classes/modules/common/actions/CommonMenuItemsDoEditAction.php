<?php
/**
* CommonMenuItemsDoEditAction
*
* Guarda los cambios realizados a un menú
*
*/

require_once("BaseAction.php");

class CommonMenuItemsDoEditAction extends BaseAction {

	function CommonMenuItemsDoEditAction() {
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
		
		$menuItemParams = $_POST['menuItem'];
		$module = "Common";
		if($_POST['useExternalUrl'] === "false") {
			// armamos un array asociativo con los datos recibidos.
			$actionParams = array_combine($_POST['param']['name'], $_POST['param']['value']);
			$menuItemParams['url'] = MenuItemPeer::generateUrl($_POST['menuItem']['action'], $actionParams);
		} else {
			$menuItemParams['action'] = '';
		}
		if (!empty($menuItemParams['id'])) {
			$menuItem = MenuItemPeer::get($menuItemParams['id']);
		} else {
			$menuItem = new MenuItem();	
		}
		unset($menuItemParams['id']);
		Common::setObjectFromParams($menuItem, $menuItemParams);
		
		if(!$menuItem->save()) return $mapping->findForwardConfig("failure");	
			
		//assignamos los menuItemInfo en caso de que corresponda
		foreach ($_POST['menuItemInfo'] as $languageCode => $menuItemInfo) {
			$menuItemInfo['language'] = $languageCode;
			$menuItemInfo['menuItemId'] = $menuItem->getId();
			if (!empty($menuItemInfo['id'])) {
				//el menuItemInfo ya existe, lo actualizo.
				$menuItemInfoObj = MenuItemInfoPeer::get($menuItemInfo['id']);
			} elseif (!empty($menuItemInfo['name'])) {
				//el menuItemInfo no existe pero el usuario ingreso datos y entonces hay que crearlo.
				$menuItemInfoObj = new MenuItemInfo();
			}
			// evitamos que ocurra una excepcion por intentar setear el id al elemento.
			unset($menuItemInfo['id']);
			Common::setObjectFromParams($menuItemInfoObj,$menuItemInfo);
			if(!$menuItemInfoObj->save()) return $mapping->findForwardConfig("failure");
		}
		
		return $this->addParamsToForwards(array("show" => $menuItem->getId()),$mapping,"success");

	}
}