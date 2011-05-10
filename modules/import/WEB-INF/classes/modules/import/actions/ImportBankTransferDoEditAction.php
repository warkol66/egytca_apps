<?php

require_once("BaseAction.php");
require_once("SupplierPurchaseOrderBankTransferPeer.php");
require_once("SupplierPeer.php");
class ImportBankTransferDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportBankTransferDoEditAction() {
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

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un product existente

			if ( SupplierPurchaseOrderBankTransferPeer::update($_POST["bankTransfer"]) )
      			return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo product

			if ( !SupplierPurchaseOrderBankTransferPeer::create($_POST["bankTransfer"]) ) {
				$product = new Product();
				$product->setid($_POST['bankTransfer']["id"]);
				$product->setSupplierPurchaseOrderId($_POST['bankTransfer']["supplierPurchaseOrderId"]);
				$product->setBankTransferNumber($_POST['bankTransfer']["bankTransferNumber"]);
				$product->setAmount($_POST['bankTransfer']["amount"]);
				$smarty->assign("transfer",$transfer);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      		}

			return $mapping->findForwardConfig('success');
		}

	}

}
?>
