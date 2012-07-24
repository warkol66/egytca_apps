<?php

class HeadlinesDoRemoveIssueXAction extends BaseAction {

	function HeadlinesDoRemoveIssueXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Headlines";

		if (!empty($_POST["headlineId"]) && !(empty($_POST["issueId"]))) {
		
			$headline = HeadlineQuery::create()->findPk($_POST["headlineId"]);
			$issue = IssueQuery::create()->findPk($_POST["issueId"]);

			if (!empty($headline) && !empty($issue)) {

				$relation = HeadlineIssueQuery::create()->filterByHeadline($headline)->filterByIssue($issue)->findOne();
				if (!empty($relation))
					try {
						$relation->delete();
						$smarty->assign('issue',$issue);
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

