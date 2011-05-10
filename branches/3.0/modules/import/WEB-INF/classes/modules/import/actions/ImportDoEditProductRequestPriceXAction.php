<?php

require_once("BaseAction.php");
require_once("RequestPeer.php");
require_once("ProductPeer.php");
require_once("ProductRequestPeer.php");

class ImportDoEditProductRequestPriceXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportDoEditProductRequestPriceXAction() {
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
		
		//verificamos los parametros
		if ((!isset($_POST['productRequestId'])) and ((!isset($_POST['priceClient'])) or (!isset($_POST['priceSupplier'])))) {
			return $mapping->findForwardConfig('failure');
		}
		
		$productRequest = ProductRequestPeer::get($_POST['productRequestId']);

		if (($productRequest->isQuoted() || $productRequest->isWaiting()) && (isset($_POST['priceClient']))) {
			//caso precio a consumidor final

			if (!is_numeric($_POST['priceClient']))
				//error validacion
				return $mapping->findForwardConfig('failure');

			$productRequest->setPriceClient($_POST['priceClient']);
			$productRequest->setWaitingStatus();
			$success = "success-admin";
		}

		//guardamos los cambios		
		try {
			$productRequest->save();
		} 
		catch(PropelException $exp) {
			//se produjo un error		
			return $mapping->findForwardConfig('failure');
		}

		$smarty->assign('productRequest',$productRequest);


		return $mapping->findForwardConfig($success);

	}

}
?>
