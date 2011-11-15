<?php

class VialidadConstructionsAutocompleteListXAction extends BaseAction {

	function VialidadConstructionsAutocompleteListXAction() {
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
		$section = "Constructions";
		$smarty->assign("section",$section);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$constructions = ConstructionQuery::create()->where('Construction.Name LIKE ?', "%" . $searchString . "%")
									->limit($_REQUEST['limit'])
									->find();

		$smarty->assign("constructions",$constructions);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
