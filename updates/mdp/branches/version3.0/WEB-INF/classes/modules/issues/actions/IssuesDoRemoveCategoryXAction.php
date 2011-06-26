<?php

class IssuesDoRemoveCategoryXAction extends BaseAction {

	function IssuesDoRemoveCategoryXAction() {
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

			if (!empty($issue) && !empty($category)) {

				$relation = IssueCategoryRelationQuery::create()->filterByIssue($issue)->filterByIssueCategory($category)->findOne();
				if (!empty($relation))
					try {
						$relation->delete();
						$smarty->assign('category',$category);
						return $mapping->findForwardConfig('success');
					}
					catch (PropelException $exp) {
						if (ConfigModule::get("global","showPropelExceptions"))
							print_r($exp->getMessage());
				}
			}
		}

		$smarty->assign('errorTagId','categoryMsgField');
		return $mapping->findForwardConfig('failure');
	}

}

