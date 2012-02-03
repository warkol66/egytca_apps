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

		$headlinePeer = new HeadlinePeer();

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
			$filters = array_merge_recursive($filters, array('Actor' => array('entityFilter' => array(
				'entityType' => "Actor",
				'entityId' => $_GET['filters']['actorId']
			))));

		if (!empty($_GET['filters']['issueId']))
			$filters = array_merge_recursive($filters, array('Issue' => array('entityFilter' => array(
				'entityType' => "Issue",
				'entityId' => $_GET['filters']['issueId']
			))));

		if (isset($fromDate) || isset($toDate))
			$filters['rangePublished'] = array('range' => Common::getPeriodArray($fromDate,$toDate));

		$pager = BaseQuery::create('Headline')->orderByCreatedAt('desc')->createPager($filters,$page,$filters["perPage"]);

		$smarty->assign("filters", $filters);
		$smarty->assign("headlines",$pager->getResults());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=headlinesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}
}
