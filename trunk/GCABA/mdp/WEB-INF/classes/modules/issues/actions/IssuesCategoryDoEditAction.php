<?php

class IssuesCategoryDoEditAction extends BaseAction {

	function IssuesCategoryDoEditAction() {
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
		$section = "Categories";

		if($_POST["categoryData"]["parentId"] != 0)
			$parentNode = IssueCategoryPeer::get($_POST["categoryData"]["parentId"]);
			
		if ($_POST["action"] == "edit") {
			$issueCategory = IssueCategoryPeer::get($_POST["id"]);
			if (!is_null($issueCategory)) {
				$issueCategory = Common::setNestedSetObjectFromParams($issueCategory,$_POST["categoryData"],$parentNode);
				if ($issueCategory->save())
					return $mapping->findForwardConfig('success');
				else								
					return $mapping->findForwardConfig('failure');
			}
		}
		else {

			$issueCategory = new IssueCategory();
			$issueCategory = Common::setNestedSetObjectFromParams($issueCategory,$_POST["categoryData"],$parentNode);

			if (!$issueCategory->save()) {
				$smarty->assign("category",$issueCategory);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			return $mapping->findForwardConfig('success');
		}

	}

}
