<?php

class CategorySelect extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$categories = array();
		foreach (CategoryPeer::getUserCategories($_SESSION["login_user"]) as $category)
			$categories[$category->getId()] = $category->getName();

		$smarty->assign('categories',$categories);
		return $mapping->findForwardConfig('success');
	}

}
