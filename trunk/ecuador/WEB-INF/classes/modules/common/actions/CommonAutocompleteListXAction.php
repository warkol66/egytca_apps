<?php

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

		$searchString = $request->getParameter('term');
		$smarty->assign("searchString",$searchString);

		$object = ucfirst($request->getParameter('object'));

		$filters = array("searchString" => $searchString, "limit" => $_REQUEST['limit']);
		
		/*if ($_REQUEST['getCandidates'])
			$filters = array_merge_recursive($filters, array("getCandidates" => true));*/

		$objects = BaseQuery::create($object)
				->addFilters($filters)
				->limit($_REQUEST['limit'])
				->find();

		$smarty->assign("objects",$objects);
		$smarty->assign("class",$object);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
