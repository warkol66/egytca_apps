<?php
/**
* CommonMenuItemsDoEditAction
*
* Guarda los cambios realizados a un menú
*
*/

/*require_once("BaseAction.php");

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
		
		return $this->addParamsToForwards(array("show" => $menuItem->getId()),$mapping,"success");

	}
}*/

class CommonMenuItemsDoEditAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('MenuItem');
	}

	protected function preUpdate(){
		parent::preUpdate();

		if($_POST['useExternalUrl'] === "false") {
			// armamos un array asociativo con los datos recibidos.
			$actionParams = array_combine($_POST['param']['name'], $_POST['param']['value']);
			$this->entityParams['url'] = MenuItem::generateUrl($_POST['menuItem']['action'], $actionParams);
		} else {
			$this->entityParams['action'] = '';
		}

	
	}
	
	protected function postSave(){
		parent::postSave();

		//assignamos los menuItemInfo en caso de que corresponda
		foreach ($_POST['menuItemInfo'] as $languageCode => $menuItemInfo) {
			$menuItemInfo['language'] = $languageCode;
			$menuItemInfo['menuItemId'] = $this->entity->getId();
			if (!empty($menuItemInfo['id'])) {
				//el menuItemInfo ya existe, lo actualizo.
				$menuItemInfoObj = MenuItemInfoQuery::create()->findOneById($menuItemInfo['id']);
			} elseif (!empty($menuItemInfo['name'])) {
				//el menuItemInfo no existe pero el usuario ingreso datos y entonces hay que crearlo.
				$menuItemInfoObj = new MenuItemInfo();
			}
			// evitamos que ocurra una excepcion por intentar setear el id al elemento.
			unset($menuItemInfo['id']);
			Common::setObjectFromParams($menuItemInfoObj,$menuItemInfo);
		}
	}
	
}
