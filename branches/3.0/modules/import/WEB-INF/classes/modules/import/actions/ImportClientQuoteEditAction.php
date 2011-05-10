<?php

require_once("BaseAction.php");
require_once("ClientQuotePeer.php");
require_once("ProductPeer.php");
require_once("SupplierPeer.php");
require_once("PortPeer.php");
require_once("IncotermPeer.php");

class ImportClientQuoteEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportClientEditAction() {
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
		$smarty->assign("message",$_GET["message"]);
		$smarty->assign("quantitiesOnQuotesFlag",Common::importQuotesHasQuantities());
		
		if (!empty($_GET['notProcessed'])) {
			$smarty->assign('notProcessed',$_GET['notProcessed']);
		}
		
		$products = ProductPeer::getAll();
		$smarty->assign('products',$products);
		
		$clientQuotePeer = new ClientQuotePeer();

		if (Common::isAdmin()) {
			
			if (!empty($_GET['supplierQuoteId'])) {
				$supplierQuote = SupplierQuotePeer::get($_GET["supplierQuoteId"]);
				$smarty->assign("supplierQuote",$supplierQuote);
			}

			//traemos todas las cotizaciones.
			$incoterms = IncotermPeer::getAll();
			$ports = PortPeer::getAll();

			if (empty($_GET['id'])) {
				//se esta editando una clientQuote recien creada
				$clientQuote = $_SESSION['import']['clientQuote'];
			}
			else {
				//se esta editando una clientQuote existente
				$clientQuote = $clientQuotePeer->get($_GET["id"]);
				$_SESSION['import']['clientQuote'] = $clientQuote;
			}

			$suppliers = $clientQuote->getProductRelatedSuppliers();
			$smarty->assign("clientQuote",$clientQuote);
			$smarty->assign("suppliers",$suppliers);
			$smarty->assign("incoterms",$incoterms);
			$smarty->assign("ports",$ports);
			return $mapping->findForwardConfig('success-admin');
		}

		if (Common::isAffiliatedUser()) {
			//Traemos todas las cotizaciones de ese afiliado.
			$affiliateUser = Common::getAffiliatedLogged();
			$affiliate = $affiliateUser->getAffiliate();
			
			if (empty($_GET['id'])) {
				//se esta editando una clientQuote recien creada
				$clientQuote = $_SESSION['import']['clientQuote'];
			}
			else {
				$clientQuote = $affiliate->getClientQuote($_GET['id']);
			}
			
			if (empty($clientQuote)) {
				return $mapping->findForwardConfig('failure');
			}
			
			$smarty->assign("clientQuote",$clientQuote);
			return $mapping->findForwardConfig('success-affiliate');
		}
		
		
		return $mapping->findForwardConfig('failure');
		
	}

}
