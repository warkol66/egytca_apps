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

		$params = $_POST['params'];
		$id = $request->getParameter("id");

		$categoryPeer = new CategoryPeer();

		if (!empty($id)) {

			if ($categoryPeer->update($id, $params))
				$myRedirectConfig = $mapping->findForwardConfig('success');
			else
				$myRedirectConfig = $mapping->findForwardConfig('failure');

			$myRedirectPath = $myRedirectConfig->getpath();
			$myRedirectPath .= '&filters[searchModule]=' . $params['module'];
			$fc = new ForwardConfig($myRedirectPath, True);
			return $fc;
		}
		else {
			$categoryId = $categoryPeer->create($params);
			return $mapping->findForwardConfig('success');
		}

	}

}
