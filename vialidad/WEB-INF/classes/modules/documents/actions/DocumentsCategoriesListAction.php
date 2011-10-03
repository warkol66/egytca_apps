<?php
/**
* DocumentsCategoriesList
*
*	Action utilizado para cargar las diversas categorias disponibles que
*	un usuario puede ver. Dichas categorías contienen documentos.
* 
* @package documents
*/

class DocumentsCategoriesListAction extends BaseAction {

	function DocumentsCategoriesListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Documents";
		$smarty->assign("module",$module);

		$categoryPeer = new CategoryPeer();
    
		// se comprueba las categorías que puede ver el usuario logueado y se las asigna
		$categories = $categoryPeer->getUserCategories($_SESSION["login_user"]);
		$smarty->assign("categories",$categories);

		return $mapping->findForwardConfig('success');

	}

}
