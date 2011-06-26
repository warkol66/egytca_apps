<?php

class IssuesCategoryDoDeleteAction extends BaseAction {

	function IssuesDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Issues";
		$category = IssueCategoryPeer::get($_POST["id"]);
		if ($category->isRoot())
			IssueCategoryPeer::deleteTree($category->getScope());
		else		
			IssueCategoryPeer::delete($_POST["id"]);
		return $mapping->findForwardConfig('success');
	}

}
