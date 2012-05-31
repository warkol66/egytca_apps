<?php

class ConstructionsInspectionsListAction extends BaseAction {

	function ConstructionsInspectionsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Constructions";
		$smarty->assign("module",$module);

		$filters = $request->getParameterValues("filters");

		if (isset($filters["perPage"]) && $filters["perPage"] > 0)
			$perPage = $filters["perPage"];
		else
			$perPage = Common::getRowsPerPage();

		$pager = BaseQuery::create('Inspection')->createPager($filters, $page, $perPage);

		$smarty->assign("inspections",$pager->getResults());
		$smarty->assign("pager",$pager);
		$smarty->assign("filters", $filters);

		$url = "Main.php?do=constructionsInspectionsList";
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}