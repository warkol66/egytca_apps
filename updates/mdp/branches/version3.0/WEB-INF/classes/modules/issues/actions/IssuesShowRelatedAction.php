<?php

class IssuesShowRelatedAction extends BaseAction {

	function IssuesShowRelatedAction() {
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
		$smarty->assign("module",$module);
		
		$issue = IssuePeer::get($_GET["id"]);
		$parent = $issue->getParentIssue();
		
		$criteria = new Criteria();
		$criteria->add("parentId", $issue->getId(), Criteria::EQUAL);
		$childs = IssuePeer::doSelect($criteria);
		
		$smarty->assign("issue", $issue);
		$smarty->assign("parent", $parent);
		$smarty->assign("childs", $childs);
		$smarty->assign("childsCount", count($childs));
		
		return $mapping->findForwardConfig('success');
	}

}
