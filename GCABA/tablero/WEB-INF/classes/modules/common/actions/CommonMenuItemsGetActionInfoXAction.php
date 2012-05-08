<?php
/**
* CommonMenuItemsGetActionInfoXAction
* 
* Permite mediante Ajax la recuperacion de la informacion de lenguaje de un menuItem con accion interna
* A partir de la informacion contenida en el modulo security.
* 
*/

require_once("BaseAction.php");

class CommonMenuItemsGetActionInfoXAction extends BaseAction {

	function CommonMenuItemsGetActionInfoXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

    /**
    * Use a different template
    */
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		
		$languages = Common::getAllLanguages();
		$smarty->assign("languages",$languages);
		
		$action = SecurityActionQuery::create()->findOneByAction($_GET['action']);
		$smarty->assign("action", $action);
		
		if (!empty($_GET['menuItemId'])) {
			$menuItem = MenuItemQuery::create()->findPK($_GET['menuItemId']);
		} else {
			$menuItem = new MenuItem();
		}
		$smarty->assign('menuItem', $menuItem);
		
		return $mapping->findForwardConfig("success");
	}

}
