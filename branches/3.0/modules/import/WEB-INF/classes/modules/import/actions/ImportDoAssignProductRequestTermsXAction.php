<?php

require_once("BaseAction.php");
require_once("ProductRequestPeer.php");
require_once("ProductPeer.php");
require_once("PortPeer.php");
require_once("IncotermPeer.php");

class ImportDoAssignProductRequestTermsXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportDoAssignProductRequestTermsXAction() {
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
		if ((!isset($_POST['productRequestId'])) and (!isset($_POST['priceSupplier'])) and ((!isset($_POST['incotermId'])) or (!isset($_POST['portId'])))) {
			return $mapping->findForwardConfig('failure');
		}
		
		$productRequest = ProductRequestPeer::get($_POST['productRequestId']);
		
		if (isset($_POST['priceSupplier'])) {
		
			if (!is_numeric($_POST['priceSupplier']))
				//error validacion
				return $mapping->findForwardConfig('failure');

			$productRequest->setPriceSupplier($_POST['priceSupplier']);

		}
		
		if (isset($_POST['incotermId'])) {
			//modificacion de incoterm			
			$productRequest->setIncotermId($_POST['incotermId']);
		}

		if (isset($_POST['portId'])) {
			//modificacion de port
			$productRequest->setPortId($_POST['portId']);
		}

		//hacemos el cambio de estado, el mismo se aplicara si se cumple la regla de negocio en el modelo
		if ($productRequest->setQuotedStatus()) {
			$smarty->assign('statusChanged',true);		
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
		$smarty->assign('portPeer', new PortPeer());
		$smarty->assign('incotermPeer', new IncotermPeer());

		return $mapping->findForwardConfig('success');
	
	}

}
?>
