<?php

class CatalogAffiliateProductCodesDoEditAction extends BaseAction {

	function CatalogAffiliateProductCodesDoEditAction() {
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

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un affiliateproductcode existente
			AffiliateProductCodePeer::update($_POST["id"],$_POST["affiliateId"],$_POST["productCode"],$_POST["productCodeAffiliate"]);
      		return $mapping->findForwardConfig('success');
		}
		else {
		  //estoy creando un nuevo affiliateproductcode

  		if ( !AffiliateProductCodePeer::create($_POST["affiliateId"],$_POST["productCode"],$_POST["productCodeAffiliate"]) ) {
				$affiliateProductCode = new AffiliateProductCode();
				$afiliateProductCode->setAffliateId($_POST["affiliateId"]);
				$afiliateProductCode->setProductCode($_POST["productCode"]);
				$afiliateProductCode->setProductCodeAffiliate($_POST["productCodeAffiliate"]);
				$smarty->assign("affiliateproductcode",$affiliateProductCode);
				$products = ProductPeer::getAll();
				$smarty->assign("products",$products);
				$affiliates = AffiliatePeer::getAll();
				$smarty->assign("affiliates",$affiliates);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      		}
			
			$params['page'] = $_POST['page'];
			$params['affiliateId'] = $_POST['affiliateId'];
			return $this->addParamsToForwards($params,$mapping,'success');
			
		}

	}

}
