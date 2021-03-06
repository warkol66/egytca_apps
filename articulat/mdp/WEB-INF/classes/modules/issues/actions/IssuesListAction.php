<?php

class IssuesListAction extends BaseAction {

	function IssuesListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Issues";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$issueImpactTypes = Common::getTranslatedArray(IssuePeer::getIssueImpactTypes(),'issues');
		$smarty->assign("issueImpactTypes",$issueImpactTypes);
		$issueEvolutionStages = Common::getTranslatedArray(IssuePeer::getIssueEvolutionStages(),'issues');
		$smarty->assign("issueEvolutionStages",$issueEvolutionStages);
		$issueValorationTypes = Common::getTranslatedArray(IssuePeer::getIssueValorationTypes(),'issues');
		$smarty->assign("issueValorationTypes",$issueValorationTypes);

		$issuePeer = new IssuePeer();

		$categories = IssueCategoryQuery::create()->find();
		$smarty->assign("categories",$categories);

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($issuePeer,$filters,$smarty);
		}
		$pager = $issuePeer->getAllPaginatedFiltered($page);

		$smarty->assign("issues",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=issuesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
