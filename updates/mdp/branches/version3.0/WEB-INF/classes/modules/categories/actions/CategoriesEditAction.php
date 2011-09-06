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

    $category = CategoryPeer::get($_GET["id"]);

    if (!empty($category)) {
			$user = Common::getLoggedUser();

			$parentCategories = $categoryPeer->getAllParentsByUserAndModule($user,$category->getModule());
			$smarty->assign("parentUserCategories",$parentCategories);

			//categorias para select de categorias padre
			$categories = $user->getCategoriesByModule($category->getModule());
			$smarty->assign("categories",$categories);
	    $smarty->assign("action","edit");
		}
		else {
	    $category = new Category();											
			$smarty->assign("action","create");
		}

		$modules = ModulePeer::getAll();
		$smarty->assign("modules",$modules);
		$smarty->assign("category",$category);

		return $mapping->findForwardConfig('success');
	}

}
