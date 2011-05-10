<?php

require_once("BaseAction.php");
require_once("SupplierPurchaseOrderPeer.php");
require_once("AffiliatePeer.php");
require_once("AffiliateUserPeer.php");

class ImportSupplierOrderListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportSupplierOrderListAction() {
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
		
		$url = "Main.php?do=importSupplierOrderList";
		$smarty->assign("url",$url);		
   
		$smarty->assign("message",$_GET["message"]);
		
	
		$supplierPurchaseOrderPeer = new SupplierPurchaseOrderPeer();

		$filterValues = array('supplierId','adminStatus');
		$supplierPurchaseOrderPeer = $this->processFilters($supplierPurchaseOrderPeer,$filterValues,$smarty);

		$pager = $supplierPurchaseOrderPeer->getAllPaginatedFiltered($_GET["page"]);

		$suppliers = SupplierPeer::getAll();
	
		$url = "Main.php?do=importSupplierOrderList";			
		$url = $this->addFiltersToUrl($url);
		$smarty->assign("url",$url);

		$smarty->assign("orders",$pager->getResult());
		$smarty->assign("suppliers",$suppliers);
		$smarty->assign("status",$supplierPurchaseOrderPeer->getStatusNames());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
		
	}

}
