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

			$category = $categoryPeer->get($_GET["id"]);
			$smarty->assign("category",$category);
			$smarty->assign("accion","edicion");
		}
		else
			$smarty->assign("accion","creacion");

		return $mapping->findForwardConfig('success');
	}

}
