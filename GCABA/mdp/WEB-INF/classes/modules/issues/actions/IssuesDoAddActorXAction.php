<?php
class IssuesDoAddActorXAction extends BaseAction {

	function IssuesDoAddActorXAction() {
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
		
		$issue = IssueQuery::create()->findPk($_POST['issueId']);
		$actor = ActorQuery::create()->findPk($_POST['actor']['id']);;

		if (!empty($issue) && !empty($actor)) {
			if (!$issue->hasActor($actor)) {
				$issue->addActor($actor);
				if (!$issue->save()) {
					$smarty->assign('message', 'failure');
					return $mapping->findForwardConfig('success');
				} 
			}
		}
		else {
			$smarty->assign('message', 'failure');
			return $mapping->findForwardConfig('success');
		}
		$smarty->assign('issueId', $issue->getId());
		$smarty->assign('actor', $actor);
		$smarty->assign('message', 'success');
		return $mapping->findForwardConfig('success');
	}
}
