<?php

require_once("BaseAction.php");
require_once("SupplierPurchaseOrderPeer.php");


class ImportSupplierOrderHistoryAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportSupplierQuoteHistoryAction() {
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

		$this->template->template = 'TemplateBasic.tpl';

		$module = "Import";
		$smarty->assign('module',$module);
		
		$smarty->assign("message",$_GET["message"]);
		
		$supplierPurchaseOrderPeer = new SupplierPurchaseOrderPeer();

		//traemos la cotizacion
		$supplierPurchaseOrder = $supplierPurchaseOrderPeer->get($_GET["id"]);
		
		$smarty->assign("supplierPurchaseOrder",$supplierPurchaseOrder);

		return $mapping->findForwardConfig('success');
		
	}

}
