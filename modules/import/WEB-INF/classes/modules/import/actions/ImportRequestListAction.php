<?php

require_once("BaseAction.php");
require_once("RequestPeer.php");
require_once("AffiliatePeer.php");
require_once("SupplierUserPeer.php");


class ImportRequestListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportRequestListAction() {
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
    		BaseAction::execute($mapping, $form, $request, $response);		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Import";
		$smarty->assign('module',$module);
		
		$requestPeer = new RequestPeer(); 
		
		if (Common::isAdmin()) {
			//traemos todos los requests.
			$pager = $requestPeer->getAllPaginated($_GET["page"]);
		}

		if (Common::isSupplier()) {
			//Traemos solo los requests asignados a ese supplier.
			$supplierUser = SupplierUserPeer::getSupplierByUser(Common::getSupplierUserId());
			$pager = $requestPeer->getAllPaginatedBySupplier($supplierUser->getSupplierId(),$_GET["page"]);
		}

		if (Common::isAffiliatedUser()) {
			//Traemos los request de este afiliado.
			$pager = $requestPeer->getAllPaginatedByUser(Common::getAffiliatedId(),$_GET["page"]);
		}
		
		$affiliatePeer = new AffiliatePeer();
		$smarty->assign("affiliatePeer",$affiliatePeer);
		
		$smarty->assign("requests",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=importRequestList";
		$smarty->assign("url",$url);		
   
		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
		
	}

}
?>
