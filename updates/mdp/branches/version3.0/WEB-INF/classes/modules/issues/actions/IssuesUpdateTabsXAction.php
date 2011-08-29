<?php

class IssuesUpdateTabsXAction extends BaseAction {

		function IssuesUpdateTabsXAction() {
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
		$smarty->assign("module",$module);

		$maxPerPage = ConfigModule::get("issues","logsPerPage");

		$issue = IssuePeer::get($_GET["id"]);
		$issueVersionsPager = $issue->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, $_GET['page'], $maxPerPage);

		$smarty->assign("issue", $issue);
		$smarty->assign("issueVersionsPager", $issueVersionsPager);
		$smarty->assign("action", "showLog");

		return $mapping->findForwardConfig('success');

	}

}
