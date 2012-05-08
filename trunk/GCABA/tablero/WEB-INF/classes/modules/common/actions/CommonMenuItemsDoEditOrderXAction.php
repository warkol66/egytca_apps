<?php
/**
* CommonMenuItemsDoEditOrderXAction
* 
* Permite mediante Ajax el cambio de orden de los menús disponibles
* 
*/

require_once("BaseAction.php");

class CommonMenuItemsDoEditOrderXAction extends BaseAction {

	function CommonMenuItemsDoEditOrderXAction() {
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
		parse_str($_POST['data']);
		
		// mantenemos una consulta con los objetos previamente filtrados por la id del nodo padre.
		$menuItemsQuery = MenuItemQuery::create()->filterByParentId($_POST['parentId'])->keepQuery();

		for ($i = 0; $i < count($menuItemsList); $i++) {
			if($menuItemsList[$i] != NULL) {
   				$menuItemsQuery->findPK($menuItemsList[$i])->setOrder($i)->save();
			}
   		}

		return $mapping->findForwardConfig('success');

	}

}
