<?php

class CategoriesDoDeleteAction extends BaseAction {

	function CategoriesDoDeleteAction() {
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

		if ( $categoryPeer->delete($_POST["id"]) )
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('failure');

	}

}
