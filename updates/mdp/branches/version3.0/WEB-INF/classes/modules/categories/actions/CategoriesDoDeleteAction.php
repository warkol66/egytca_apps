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

    $smarty->assign("module",$module);
    $categoryPeer = new CategoryPeer();

    if ($categoryPeer->delete($_POST["id"]))
			$myRedirectConfig = $mapping->findForwardConfig('success');
		else
			$myRedirectConfig = $mapping->findForwardConfig('failure');		

		$myRedirectPath = $myRedirectConfig->getpath();
		if (!empty($_POST['module']))
			$myRedirectPath .= '&filters[searchModule]=' . $_POST['filters']['searchModule'];
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

	}

}
