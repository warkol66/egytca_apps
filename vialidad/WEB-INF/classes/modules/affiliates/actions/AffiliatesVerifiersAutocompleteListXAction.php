<?php

class AffiliatesVerifiersAutocompleteListXAction extends BaseAction {

	function AffiliatesVerifiersAutocompleteListXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
  	$smarty->assign("module",$module);

		$module = "Affiliates";
		$smarty->assign("module",$module);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$verifiers = VerifierQuery::create()->where('Affiliate.Name LIKE ?', "%" . $searchString . "%")
									->limit($_REQUEST['limit'])
									->find();
		
		$smarty->assign("verifiers",$verifiers);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
