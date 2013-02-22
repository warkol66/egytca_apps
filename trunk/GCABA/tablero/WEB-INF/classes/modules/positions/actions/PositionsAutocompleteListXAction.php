<?php

class PositionsAutocompleteListXAction extends BaseAction {

	function PositionsAutocompleteListXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Positions";		
		$smarty->assign("module",$module);

		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$filters = array ("searchString" => $searchString, "limit" => $_REQUEST['limit']);

		$positions = BaseQuery::create('Position')->addFilters($filters)->find();
		
		$smarty->assign("positions",$positions);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
