﻿<?php

class CommonAutocompleteListXAction extends BaseAction {

	function CommonAutocompleteListXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$smarty->assign("module",$module);

		$searchString = $request->getParameter('value');
		$smarty->assign("searchString",$searchString);

		$object = ucfirst($request->getParameter('object'));

		$filters = array("searchString" => $searchString, "limit" => $_REQUEST['limit']);

		if (isset($_REQUEST['filters']))
			$filters = array_merge($filters, $request->getParameterValues("filters"));

		$objects = BaseQuery::create($object)
				->addFilters($filters)
				->limit($_REQUEST['limit'])
				->find();

		$smarty->assign("objects",$objects);
		$smarty->assign("limit",$_REQUEST['limit']);
		$smarty->assign("objectParam",$_REQUEST['objectParam']);
		$smarty->assign('type', $_REQUEST['type']);

		return $mapping->findForwardConfig('success');
	}

}
