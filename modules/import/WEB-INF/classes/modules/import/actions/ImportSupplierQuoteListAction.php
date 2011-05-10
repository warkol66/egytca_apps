<?php

require_once("BaseAction.php");
require_once("SupplierQuotePeer.php");

class ImportSupplierQuoteListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportSupplierQuoteListAction() {
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
		
		$url = "Main.php?do=importSupplierQuoteList";
		$url = $this->addFiltersToUrl($url);
		$smarty->assign("url",$url);		
   
		$smarty->assign("message",$_GET["message"]);
		
		if (!empty($_GET['supplierQuoteId']))
			$smarty->assign('supplierQuoteId',$_GET['supplierQuoteId']);
		
		$supplierQuotePeer = new SupplierQuotePeer();
		
		if (Common::isAdmin()) {
			//traemos todas las cotizaciones.	
			
			$filterValues = array('supplierId');
			
			$supplierQuotePeer = $this->processFilters($supplierQuotePeer,$filterValues,$smarty);
			
			$pager = $supplierQuotePeer->getAllPaginatedFiltered($_GET["page"]);
			$suppliers = SupplierPeer::getAll();
			
			$smarty->assign("quotes",$pager->getResult());
			$smarty->assign("pager",$pager);
			$smarty->assign("suppliers",$suppliers);
			return $mapping->findForwardConfig('success');
		}
		
		return $mapping->findForwardConfig('failure');
		
	}

}

