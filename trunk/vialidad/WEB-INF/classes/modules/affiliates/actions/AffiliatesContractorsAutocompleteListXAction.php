<?php

class AffiliatesContractorsAutocompleteListXAction extends BaseAction {

	function AffiliatesContractorsAutocompleteListXAction() {
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

        $searchString = $_REQUEST['value'];
        $smarty->assign("searchString",$searchString);

        $contractors = ContractorQuery::create()
            ->addFilter("searchString", $searchString)
            ->limitIfExists($_REQUEST['limit'])
        ->find();

        $smarty->assign("contractors",$contractors);
        $smarty->assign("limit",$_REQUEST['limit']);

        return $mapping->findForwardConfig('success');
    }

}
