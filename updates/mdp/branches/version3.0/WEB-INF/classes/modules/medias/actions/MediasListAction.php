<?php

require_once 'WEB-INF/classes/BaseQuery.php';

class MediasListAction extends BaseAction {

	function MediasListAction() {
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

		$module = "Medias";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}

		$filters = $_GET['filters'];
		
		if (isset($filters["perPage"]) && $filters["perPage"] > 0)
			$perPage = $filters["perPage"];
		else
			$perPage = Common::getRowsPerPage();

		$pager = BaseQuery::create('Media')
			->filterByAliasof(null)
			->createPager($filters, $page, $perPage);
		
		$smarty->assign("medias",$pager->getResults());
		$smarty->assign("pager",$pager);
		$smarty->assign("filters", $filters);

		$url = "Main.php?do=mediasList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$mediaTypes = MediaTypeQuery::create()->find();
		$smarty->assign("mediaTypes",$mediaTypes);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
