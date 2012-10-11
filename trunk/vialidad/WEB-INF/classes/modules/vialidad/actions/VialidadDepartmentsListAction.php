<?php

class VialidadDepartmentsListAction extends BaseAction {

	function VialidadDepartmentsListAction() {
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
		$section = "Departments";
		$smarty->assign("section",$section);

		$smarty->assign("message",$_GET["message"]);

		$filters = $_GET["filters"];
		$pager = BaseQuery::create('Department')->createPager($filters, $_GET["page"], $filters["perPage"]);

		$url = "Main.php?do=vialidadDepartmentsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		if (!empty($filters["departmentId"]))
			$smarty->assign("defaultDepartmentValue",DepartmentQuery::create()->findPk($filters["departmentId"]));
		
		$smarty->assign("filters", $filters);
		$smarty->assign("departments",$pager->getResults());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}