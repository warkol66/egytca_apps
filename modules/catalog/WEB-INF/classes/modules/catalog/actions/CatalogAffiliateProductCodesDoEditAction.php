<?php

require_once("BaseAction.php");
require_once("AffiliateProductCodePeer.php");

class CatalogAffiliateProductCodesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CatalogAffiliateProductCodesDoEditAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
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
			
			//redireccionamiento
			$page = $_POST['page'];
			header("Location : Main.php?do=catalogAffiliateProductCodesList&message=ok&page=$page");
			
		}

	}

}
?>
