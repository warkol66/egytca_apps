<?php

require_once("BaseAction.php");
require_once("SupplierQuotePeer.php");

class ImportSupplierQuoteDoReplaceItemAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportSupplierQuoteDoReplaceItemAction() {
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

		$module = "Import";
		$smarty->assign('module',$module);
		
		$supplierQuotePeer = new SupplierQuotePeer();

		if (empty($_POST['token']) && (empty($_POST['id']))) {
			return $mapping->findForwardConfig('failure');		
		}

		//validamos
		$supplierQuote = $supplierQuotePeer->getByAccessToken($_POST["token"]);

		if (empty($supplierQuote)) {
			return $mapping->findForwardConfig('failure');			
		}

		$newProduct = ProductPeer::createBySupplier($_POST["product"],$_POST['productSupplier']);
		$supplierQuoteItem = $supplierQuote->getSupplierQuoteItem($_POST['supplierQuoteItem']['id']);
		$replacedProduct = $supplierQuoteItem->getProduct();
		
		//indicamos las actualizacion sobre el item segun el reemplazo
		$_POST["supplierQuoteItem"]['productId'] = $newProduct->getId();
		$_POST["supplierQuoteItem"]['replacedProductId'] = $replacedProduct->getId();
		
		//indicamos quien esta haciendo la actualizacion para que se indique en el comentario.
		$supplier = $supplierQuote->getSupplier();
		$_POST["supplierQuoteItem"]['supplierId'] = $supplier->getId();
		$smarty->assign("supplierQuote",$supplierQuote);		

		if (!SupplierQuoteItemPeer::update($_POST["supplierQuoteItem"])) {
  			return $mapping->findForwardConfig('failure');
		}		

		$params = array();
		$params['token'] = $_POST['token'];
		
		return $this->addParamsToForwards($params,$mapping,'success');
		
	}

}
