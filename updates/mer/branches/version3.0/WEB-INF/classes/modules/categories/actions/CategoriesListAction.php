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

		$user = $_SESSION["login_user"];
		$categories = $user->getCategories();

		$smarty->assign("categories",$categories);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
