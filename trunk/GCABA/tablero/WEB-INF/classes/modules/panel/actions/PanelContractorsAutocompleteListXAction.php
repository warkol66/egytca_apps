<?php

class PanelContractorsAutocompleteListXAction extends BaseAction {

	function PanelContractorsAutocompleteListXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Contrcontractors";
		
		$smarty->assign("module",$module);
		
		$this->template->template = "TemplateAjax.tpl";

		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$contractorPeer = new ContractorPeer();

		$filters = array ("searchString" => $searchString, "limit" => $_REQUEST['limit'], "projectId" => $_REQUEST['projectId']);
		$this->applyFilters($contractorPeer,$filters);
		$contractors = $contractorPeer->getAllFiltered();
		
		$smarty->assign("contractors",$contractors);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
