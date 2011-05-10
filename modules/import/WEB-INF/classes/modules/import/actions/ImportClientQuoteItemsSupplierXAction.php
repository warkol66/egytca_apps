<?php

require_once("BaseAction.php");
require_once("ClientQuotePeer.php");
require_once("SupplierPeer.php");

class ImportClientQuoteItemsSupplierXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportClientQuoteItemsSupplierXAction() {
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

		$this->template->template = 'TemplateAjax.tpl';

		if (empty($_POST['supplierId']) || empty($_POST['clientQuoteId'])) {
			return $mapping->findForwardConfig('failure');
		}

		$supplier = SupplierPeer::get($_POST['supplierId']);
		$clientQuote = ClientQuotePeer::get($_POST['clientQuoteId']);
		
		if (empty($supplier) || empty($clientQuote)) {
			return $mapping->findForwardConfig('failure');
		}

		$result = $clientQuote->getClientQuoteItemsBySupplier($supplier);
		$smarty->assign('supplier',$supplier);
		$smarty->assign('items',$result);
		return $mapping->findForwardConfig('success');
	
	}

}
