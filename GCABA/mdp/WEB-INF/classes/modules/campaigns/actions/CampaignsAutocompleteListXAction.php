<?php

//Accion que devuelve el listado de campaigns para mostrar en el autocomplete

class CampaignsAutocompleteListXAction extends BaseAction {

	function CampaignsAutocompleteListXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Campaigns";	
		$smarty->assign("module",$module);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$campaigns = CampaignQuery::create()->where('Campaign.Name LIKE ?', "%" . $searchString . "%")
									->limit($_REQUEST['limit'])
									->find();
		
		$smarty->assign("campaigns",$campaigns);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
