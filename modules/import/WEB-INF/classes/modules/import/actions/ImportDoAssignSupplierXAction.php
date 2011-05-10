<?php

require_once("BaseAction.php");
require_once("RequestPeer.php");
require_once("ProductPeer.php");
require_once("ProductRequestPeer.php");

class ImportDoAssignSupplierXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportDoAssignSupplierXAction() {
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
		//por ser una action ajax.		
		$this->template->template = "template_ajax.tpl";

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


		if (!isset($_GET['productRequestId'])) {
			return $mapping->findForwardConfig('failure');
		}

		$productRequest = ProductRequestPeer::get($_GET['productRequestId']);
		
		if (!$productRequest->isNew()) {
			//si no es nuevo no se puede asignar a su provedor
			return $mapping->findForwardConfig('failure');
		}
		//hacemos la asignacion de supplier
		$product = ProductPeer::get($productRequest->getProductId());
		$productRequest->setSupplierId($product->getSupplierId());
		//cambiamos el estado del productRequest
		$productRequest->setPendingStatus();
		//guardamos los cambios
		$productRequest->save();
		
		$smarty->assign('productRequest',$productRequest);
		
		return $mapping->findForwardConfig('success');

	}

}
?>
