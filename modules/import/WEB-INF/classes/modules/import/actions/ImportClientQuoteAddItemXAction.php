<?php

require_once("BaseAction.php");
require_once("ClientQuoteItemPeer.php");
require_once("ProductPeer.php");

class ImportClientQuoteAddItemXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportClientQuoteAddItemXAction() {
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

		//flag de utilizacion de cantidades en cotizaciones
		$smarty->assign("quantitiesOnQuotesFlag",Common::importQuotesHasQuantities());

		$this->template->template = 'TemplateAjax.tpl';

		if (!empty($_POST['clientQuoteItem']) && ((!empty($_POST['clientQuoteItem']['quantity'])) || (!Common::importQuotesHasQuantities()))) {

			if (empty($_POST['clientQuoteItem']['clientQuoteId'])) {
				//trabajamos con un client quote sin salvarse
				$clientQuote = $_SESSION['import']['clientQuote'];
			}
			else { 
				$clientQuote = ClientQuotePeer::get($_POST['clientQuoteItem']['clientQuoteId']);
			}
			
			$product = ProductPeer::get($_POST['clientQuoteItem']['productId']);
			if ($clientQuote->hasProduct($product)) {
				$smarty->assign('message','already-added');
				return $mapping->findForwardConfig('success');
			}


			if (empty($_POST['clientQuoteItem']['clientQuoteId'])) {
				//trabajamos con un client quote sin salvarse
				$item = ClientQuoteItemPeer::createInstance($_POST['clientQuoteItem']);
				$clientQuote->addClientQuoteItem($item);
			}
			else { 
				$item = ClientQuoteItemPeer::create($_POST['clientQuoteItem']);
			}
			if (!empty($item)) {
				$smarty->assign('item',$item);
			}
		}
		
		return $mapping->findForwardConfig('success');
	
	}

}
