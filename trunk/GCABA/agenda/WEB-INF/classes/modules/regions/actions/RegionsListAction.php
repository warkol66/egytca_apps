<?php

class RegionsListAction extends BaseAction {

	function RegionsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Regions";
		$smarty->assign("module",$module);

		$regionPeer = new RegionPeer();

		$regionTypes = $regionPeer->getRegionTypesTranslated();
		$smarty->assign("regionTypes",$regionTypes);

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($regionPeer,$filters,$smarty);
		}

		$pager = $regionPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("regions",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=regionsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}


