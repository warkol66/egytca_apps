<?php

class VialidadContractsAutocompleteListXAction extends BaseAction {

	function VialidadContractsAutocompleteListXAction() {
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
		$section = "Contracts";
		$smarty->assign("section",$section);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$contracts = ContractQuery::create()
										->searchString($searchString)
									->limit($_REQUEST['limit'])
									->find();

		$smarty->assign("contracts",$contracts);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
