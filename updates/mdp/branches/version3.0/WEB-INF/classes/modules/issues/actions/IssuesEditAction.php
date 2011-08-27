<?php

include_once 'IssuesEditBaseAction.php';

class IssuesEditAction extends IssuesEditBaseAction {

	function IssuesEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

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

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		$issueTable = IssuePeer::getTableMap();
		$smarty->assign("issueTable",$issueTable);

		if (!empty($_GET["id"])) {
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un objeto nuevo
			$issue = new Issue();
			$smarty->assign("issue",$issue);
			$smarty->assign("action","create");
		}

		return $mapping->findForwardConfig('success');
	}

}
