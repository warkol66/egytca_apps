<?php

class VialidadSourcesListAction extends BaseAction {

	function VialidadSourcesListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "Sources";
		$smarty->assign("section",$section);

		$smarty->assign("message",$_GET["message"]);

		$filters = $_GET["filters"];
		$pager = BaseQuery::create('Source')->createPager($filters, $_GET["page"], $filters["perPage"]);

		$url = "Main.php?do=vialidadSourcesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		if (!empty($filters["sourceorid"]))
			$smarty->assign("defaultSourceorValue",SourceorQuery::create()->findPk($filters["sourceorid"]));
		
		$smarty->assign("filters", $filters);
		$smarty->assign("sources",$pager->getResults());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}
