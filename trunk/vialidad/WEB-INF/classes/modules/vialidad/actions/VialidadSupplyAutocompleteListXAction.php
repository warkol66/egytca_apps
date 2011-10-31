<?php

class VialidadSupplyAutocompleteListXAction extends BaseAction {

	function VialidadSupplyAutocompleteListXAction() {
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
		$section = "Supplies";
		$smarty->assign("section",$section);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);
		
		$supplies = SupplyQuery::create()->where('Supply.Name LIKE ?', "%" . $searchString . "%")
									->limit($_REQUEST['limit'])
									->find();

		$smarty->assign("supplies",$supplies);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
