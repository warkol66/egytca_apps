<?php

class CatalogAffiliateProductCodesEditAction extends BaseAction {

	function CatalogAffiliateProductCodesEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Catalog";
	  $smarty->assign("module",$module);
		$smarty->assign("affiliateId",$_GET['affiliateId']);

    if ( !empty($_GET["id"]) ) {
			//voy a editar un affiliateproductcode

			$affiliateproductcode = AffiliateProductCodePeer::get($_GET["id"]);

			$smarty->assign("affiliateproductcode",$affiliateproductcode);

			$products = ProductPeer::getAll();
			$smarty->assign("products",$products);
			$affiliates = AffiliatePeer::getAll();
			$smarty->assign("affiliates",$affiliates);	
			$smarty->assign('page',$_GET['page']);			
	    	$smarty->assign("action","edit");
		}
		else {
			//voy a crear un affiliateproductcode nuevo
			$affiliateProductCode = new AffiliateProductCode();
			$smarty->assign("affiliateproductcode",$affiliateProductCode);
			$products = ProductPeer::getAll();
			$smarty->assign("products",$products);
			$affiliates = AffiliatePeer::getAll();
			$smarty->assign("affiliates",$affiliates);			
						
			$smarty->assign("action","create");
		}

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
