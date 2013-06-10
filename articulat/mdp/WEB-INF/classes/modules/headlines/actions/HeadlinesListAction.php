<?php

class HeadlinesListAction extends BaseAction {

	function HeadlinesListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Headlines";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET["page"])) {
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters']))
			$filters = $_GET['filters'];
			
		if (!empty($_GET['filters']['fromDate']))
			$fromDate = $_GET['filters']['fromDate'];

		if (!empty($_GET['filters']['toDate']))
			$toDate = $_GET['filters']['toDate'];

		if (!empty($_GET['filters']['actorId']))
			$filters['Actor']['entityFilter'] = array(
				'entityType' => "Actor",
				'entityId' => $_GET['filters']['actorId']
			);

		if (!empty($_GET['filters']['mediaId']))
			$filters['Media']['entityFilter'] = array(
				'entityType' => "Media",
				'entityId' => $_GET['filters']['mediaId']
			);

		if (!empty($_GET['filters']['issueId']))
			if (empty($_GET['filters']['getIssueBrood']))
				$filters['Issue']['entityFilter'] = array(
					'entityType' => "Issue",
					'entityId' => $_GET['filters']['issueId']
				);
			else
				$filters["broodIssues"] = $_GET['filters']['issueId'];

		if (isset($fromDate) || isset($toDate))
			$filters['rangePublished'] = Common::getPeriodArray($fromDate,$toDate);
		
		if (!empty($filters['processed']))
			if ($filters['processed'] == -1)
				unset($filters['processed']);

		if (!isset($filters["perPage"]))
			$perPage = Common::getRowsPerPage();
		else
			$perPage = $filters["perPage"];
		

		$pager = BaseQuery::create('Headline')->orderByCreatedAt('desc')->createPager($filters,$page,$perPage);

		if (!empty($filters['Actor']))
			unset($filters['Actor']);
		if (!empty($filters['Media']))
			unset($filters['Media']);
		if (!empty($filters['Issue']))
			unset($filters['Issue']);



		$smarty->assign("filters", $filters);
		$smarty->assign("headlines",$pager->getResults());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=headlinesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("headlineScopes", Headline::getHeadlineScopes());
		$smarty->assign("headlineValues", Headline::getHeadlineValues());
		$smarty->assign("headlineRelevances", Headline::getHeadlineRelevances());

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}
}
