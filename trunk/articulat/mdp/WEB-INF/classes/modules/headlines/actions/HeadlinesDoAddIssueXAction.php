<?php
class HeadlinesDoAddIssueXAction extends BaseAction {

	function HeadlinesDoAddIssueXAction() {
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
		
		$headline = HeadlineQuery::create()->findPk($_POST['headlineId']);
		$issue = IssueQuery::create()->findPk($_POST['issue']['id']);;

		if (!empty($headline) && !empty($issue)) {
			if (!$headline->hasIssue($issue)) {
				$headline->addIssue($issue);
				if (!$headline->save()) {
					$smarty->assign('message', 'failure');
					return $mapping->findForwardConfig('success');
				} 
			}
		}
		else {
			$smarty->assign('message', 'failure');
			return $mapping->findForwardConfig('success');
		}
		$smarty->assign('headlineId', $headline->getId());
		$smarty->assign('issue', $issue);
		$smarty->assign('message', 'success');
		return $mapping->findForwardConfig('success');
	}
}
