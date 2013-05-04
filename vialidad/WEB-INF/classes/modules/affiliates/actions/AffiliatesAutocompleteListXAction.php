<?php

class AffiliatesAutocompleteListXAction extends BaseAction {

	function AffiliatesAutocompleteListXAction() {
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


				if ($_REQUEST['getCandidates']) {
					$bulletinPrice = PriceBulletinQuery::create()->filterByBulletinid($_REQUEST['bulletinId'])->filterBySupplyid($_REQUEST['supplyId'])->findOne();
					for ($i = 1; $i <= 4; $i++) {
						if ($i != $_REQUEST['supplierId']) {
							$method = "getsupplierId" . $i;
							$alreadyRelated[] = $bulletinPrice->$method();
						}
					}
				}

        $contractors = AffiliateQuery::create()
            ->addFilter("searchString", $searchString)
            ->filterById($alreadyRelated, Criteria::NOT_IN)
            ->limitIfExists($_REQUEST['limit'])
	        ->find();

        $smarty->assign("contractors",$contractors);
        $smarty->assign("limit",$_REQUEST['limit']);

        return $mapping->findForwardConfig('success');
    }

}
