<?php

class VialidadConstructionTypesListAction extends BaseAction {

	function VialidadConstructionTypesListAction() {
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
		$section = "ConstructionTypes";
		$smarty->assign("section",$section);

		$smarty->assign("message",$_GET["message"]);

		$filters = $_GET["filters"];
		$pager = BaseQuery::create('ConstructionType')->createPager($filters, $_GET["page"], $filters["perPage"]);

		$url = "Main.php?do=vialidadConstructionTypesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		if (!empty($filters["constructionTypeId"]))
			$smarty->assign("defaultConstructionTypeValue",ConstructionTypeQuery::create()->findPk($filters["constructionTypeId"]));
		
		$smarty->assign("filters", $filters);
		$smarty->assign("constructionTypes",$pager->getResults());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}
