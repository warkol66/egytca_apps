<?php

require_once("BaseAction.php");
require_once("ClientPurchaseOrderPeer.php");
require_once("AffiliatePeer.php");
require_once("AffiliateUserPeer.php");

class ImportClientOrderListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportClientOrderListAction() {
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
		
		$url = "Main.php?do=importClientOrderList";
		$smarty->assign("url",$url);		
   
		$smarty->assign("message",$_GET["message"]);
		
	
		$clientPurchaseOrderPeer = new ClientPurchaseOrderPeer();

		$smarty->assign('products',$products);
		
		if (Common::isAdmin()) {
			//traemos todas los pedidos.

			$filterValues = array('adminStatus');
			$clientPurchaseOrderPeer = $this->processFilters($clientPurchaseOrderPeer,$filterValues,$smarty);

			$pager = $clientPurchaseOrderPeer->getAllPaginatedFiltered($_GET["page"]);

			$affiliates = AffiliatePeer::getAll();
			$affiliatesUsers = AffiliateUserPeer::getAll();
			
			$url = "Main.php?do=importClientOrderList";			
			$url = $this->addFiltersToUrl($url);
			$smarty->assign("url",$url);

			$smarty->assign("status",$clientPurchaseOrderPeer->getStatusNamesAdmin());
			$smarty->assign("orders",$pager->getResult());
			$smarty->assign("pager",$pager);

			return $mapping->findForwardConfig('success-admin');
		}

		if (Common::isAffiliatedUser()) {

			$filterValues = array('affiliateStatus');
			$clientPurchaseOrderPeer = $this->processFilters($clientPurchaseOrderPeer,$filterValues,$smarty);

			//Traemos todas las cotizaciones de ese afiliado.
			$affiliateUser = Common::getAffiliatedLogged();
			$affiliate = $affiliateUser->getAffiliate();
			$pager = $clientPurchaseOrderPeer->getAllPaginatedByAffiliateFiltered($affiliate,$_GET["page"]);

			$smarty->assign("status",$clientPurchaseOrderPeer->getStatusNamesAffiliate());
			$smarty->assign("orders",$pager->getResult());
			$smarty->assign("affiliate",$affiliateUser->getAffiliate());
			$smarty->assign("pager",$pager);
			return $mapping->findForwardConfig('success-affiliate');
		}
		
		return $mapping->findForwardConfig('failure');
		
	}

}
