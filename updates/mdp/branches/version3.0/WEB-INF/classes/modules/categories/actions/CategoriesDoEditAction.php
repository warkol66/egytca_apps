<?php

class CategoriesDoEditAction extends BaseAction {

	function CategoriesDoEditAction() {
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
		$categoryParams = $_POST['category'];

		if ($_POST["action"] == "edit") {

			if ($categoryPeer->update($_POST['id'], $categoryParams))
				$myRedirectConfig = $mapping->findForwardConfig('success');
			else
				$myRedirectConfig = $mapping->findForwardConfig('failure');

			$myRedirectPath = $myRedirectConfig->getpath();
			$myRedirectPath .= '&filters[searchModule]=' . $categoryParams['module'];
			$fc = new ForwardConfig($myRedirectPath, True);
			return $fc;
		}
		else {
			$categoryId = $categoryPeer->create($categoryParams);
			return $mapping->findForwardConfig('success');
		}

	}

}
