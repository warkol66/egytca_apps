<?php

class CategoriesEditAction extends BaseAction {

	function CategoriesEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Categories";
		$section = "Configure";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

    $categoryPeer = new CategoryPeer();

    if ( !empty($_GET["id"]) ) {
			//voy a editar un category

			$category = $categoryPeer->get($_GET["id"]);

			$loggedUser = Common::getLoggedUser();

			$parentCategories = $categoryPeer->getAllParentsByUserAndModule($user,$category->getModule());
			$smarty->assign("parentUserCategories",$parentCategories);

			//categorias para select de categorias padre
			$categories = $loggedUser->getCategoriesByModule($category->getModule());
			$smarty->assign('categories',$categories);

			//categoria para select de modulos
			$modules = ModulePeer::getAll();
			$smarty->assign('modules',$modules);

			$smarty->assign("category",$category);

	    $smarty->assign("accion","edicion");
		}
		else {
			//voy a crear un category nuevo
												
			$smarty->assign("accion","creacion");
		}

		return $mapping->findForwardConfig('success');
	}

}
