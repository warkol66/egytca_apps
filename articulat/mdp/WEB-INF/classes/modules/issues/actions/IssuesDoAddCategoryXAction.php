<?php

class IssuesDoAddCategoryXAction extends BaseAction {

	function IssuesDoAddCategoryXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Issues";

		if (!empty($_POST["issueId"]) && !(empty($_POST["categoryId"]))) {

			$issue = IssuePeer::get($_POST["issueId"]);
			$category = IssueCategoryPeer::get($_POST["categoryId"]);

			$smarty->assign('issue',$issue);
			$smarty->assign('category',$category);

			$relationParams["issueId"] = $_POST["issueId"];
			$relationParams["categoryId"] = $_POST["categoryId"];

			if (!empty($issue) && !empty($category)) {

				$relation = Common::setObjectFromParams(new IssueCategoryRelation(),$relationParams);

				if ($relation->save())
					return $mapping->findForwardConfig('success');
				else {
					$smarty->assign('errorTagId','categoryMsgField');
					return $mapping->findForwardConfig('failure');
				}

			}

		}

		$smarty->assign('errorTagId','categoryMsgField');
		return $mapping->findForwardConfig('failure');
	}

}
