<?php

require_once("BaseAction.php");
require_once("ClientPurchaseOrderPeer.php");


class ImportClientOrderHistoryAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportClientQuoteHistoryAction() {
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
		
				//////////
		// Use a different template
		$this->template->template = "TemplatePlain.tpl";

		$clientPurchaseOrderPeer = new ClientPurchaseOrderPeer();

		if (Common::isAdmin()) {
			
			//traemos la cotizacion
			$clientPurchaseOrder = $clientPurchaseOrderPeer->get($_GET["id"]);
			
			$smarty->assign("clientPurchaseOrder",$clientPurchaseOrder);

			return $mapping->findForwardConfig('success-admin');
		}

		if (Common::isAffiliatedUser()) {
			//Traemos todas las cotizaciones de ese afiliado.
			$affiliateUser = Common::getAffiliatedLogged();
			$affiliate = $affiliateUser->getAffiliate();
			$clientPurchaseOrder = $affiliate->getClientPurchaseOrder($_GET['id']);

			if (empty($clientPurchaseOrder)) {
				return $mapping->findForwardConfig('failure');
			}
			
			$smarty->assign("clientPurchaseOrder",$clientPurchaseOrder);
			return $mapping->findForwardConfig('success-affiliate');
		}
		
		
		return $mapping->findForwardConfig('failure');
		
	}

}
