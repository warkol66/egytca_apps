<?php

class IssuesEditAction extends BaseAction {

	function IssuesEditAction() {
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

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET["id"])) {
			//voy a editar un objeto

			$issue = IssuePeer::get($_GET["id"]);

			if (!is_null($issue)) {
				$actualCategories = $issue->getIssueCategorys();
				$smarty->assign("actualCategories",$actualCategories);

				if (!$actualCategories->isEmpty())
					$excludeCategoriesIds = $issue->getAssignedCategoriesArray($_GET["id"]);

				$criteria = new Criteria();
				$criteria->add(IssueCategoryPeer::ID, $excludeCategoriesIds, Criteria::NOT_IN);
				$categoryCandidates = IssueCategoryPeer::doSelect($criteria);
				$smarty->assign("categoryCandidates",$categoryCandidates);

			}
			else
				$issue = new Issue();

			$smarty->assign("issue",$issue);
			$smarty->assign("action","edit");

		}
		else {
			//voy a crear un objeto nuevo
			$issue = new Issue();
			$smarty->assign("issue",$issue);
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
