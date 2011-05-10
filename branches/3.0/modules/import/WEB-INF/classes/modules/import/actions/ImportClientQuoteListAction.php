<?php

require_once("BaseAction.php");
require_once("ClientQuotePeer.php");
require_once("AffiliatePeer.php");
require_once("AffiliateUserPeer.php");

class ImportClientQuoteListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportClientQuoteListAction() {
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
		
		$url = "Main.php?do=importClientQuoteList";
		$smarty->assign("url",$url);		
   
		$smarty->assign("message",$_GET["message"]);
		
		if (!empty($_GET['clientQuoteId']))
			$smarty->assign('clientQuoteId',$_GET['clientQuoteId']);
		
		$clientQuotePeer = new ClientQuotePeer();
		
		$products = ProductPeer::getAll();
		$smarty->assign('products',$products);
		
		if (Common::isAdmin()) {
			//traemos todas las cotizaciones.

			$filterValues = array('affiliateId','productName','adminStatus');
			$clientQuotePeer = $this->processFilters($clientQuotePeer,$filterValues,$smarty);

			$pager = $clientQuotePeer->getAllPaginatedFiltered($_GET["page"]);
			$affiliates = AffiliatePeer::getAll();
			$affiliatesUsers = AffiliateUserPeer::getAll();
			
			$url = "Main.php?do=importClientQuoteList";			
			$url = $this->addFiltersToUrl($url);
			$smarty->assign("url",$url);

			$smarty->assign("status",$clientQuotePeer->getStatusNamesAdmin());
			$smarty->assign("quotes",$pager->getResult());
			$smarty->assign("pager",$pager);
			$smarty->assign("affiliates",$affiliates);
			$smarty->assign("affiliatesUsers",$affiliatesUsers);
			return $mapping->findForwardConfig('success-admin');
		}

		if (Common::isAffiliatedUser()) {

			$filterValues = array('productName','affiliateStatus');
			$clientQuotePeer = $this->processFilters($clientQuotePeer,$filterValues,$smarty);

			//Traemos todas las cotizaciones de ese afiliado.
			$affiliateUser = Common::getAffiliatedLogged();
			$affiliate = $affiliateUser->getAffiliate();
			$pager = $clientQuotePeer->getAllPaginatedByAffiliateFiltered($affiliate,$_GET["page"]);

			$smarty->assign("status",$clientQuotePeer->getStatusNamesAffiliate());
			$smarty->assign("quotes",$pager->getResult());
			$smarty->assign("affiliate",$affiliateUser->getAffiliate());
			$smarty->assign("pager",$pager);
			return $mapping->findForwardConfig('success-affiliate');
		}
		
		return $mapping->findForwardConfig('failure');
		
	}

}
