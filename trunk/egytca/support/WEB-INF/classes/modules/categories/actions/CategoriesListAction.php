<?php

class CategoriesListAction extends BaseAction {

	function CategoriesListAction() {
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
		$smarty->assign("categoryPeer",$categoryPeer);

		$this->applyFilters($categoryPeer, $_GET['filters'], $smarty);

		$user = $_SESSION["loginUser"];

		$categories = $categoryPeer->getAllByUserFiltered($user);
		$smarty->assign("userCategories",$categories);
		$parentCategories = $categoryPeer->getAllParentsByUserFiltered($user);
		$smarty->assign("parentUserCategories",$parentCategories);

		//categoria para select de modulos
		$modules = ModulePeer::getAllWithCategories();
		$smarty->assign('modules',$modules);

		$moduleObj = ModulePeer::get($_GET['filters']['searchModule']);
		$smarty->assign('moduleObj',$moduleObj);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}
