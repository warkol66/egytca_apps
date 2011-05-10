<?php

require_once("BaseAction.php");
require_once("ClientQuoteItemPeer.php");


class ImportClientQuoteItemSetPriceAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportClientQuoteItemSetPriceAction() {
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

		if (empty($_GET['clientQuoteItemId'])) {
			return $mapping->findForwardConfig('failure');
		}

		$item = ClientQuoteItemPeer::get($_GET['clientQuoteItemId']);
		$smarty->assign('clientQuoteItem',$item);
		$smarty->assign('lastClientQuoteItemsRelated',$item->getLastClientQuoteItemsRelated());
		$clientQuote = $item->getClientQuote();
		$smarty->assign('clientQuote',$clientQuotes);
		$supplierQuotes = $clientQuote->getSupplierQuotes();
		$smarty->assign('supplierQuote',$supplierQuotes[0]);

		return $mapping->findForwardConfig('success');
	
	}

}
