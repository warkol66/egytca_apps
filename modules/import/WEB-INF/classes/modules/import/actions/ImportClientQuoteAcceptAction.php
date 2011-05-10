<?php

require_once("BaseAction.php");
require_once("ClientQuotePeer.php");
require_once("ProductPeer.php");
require_once("SupplierPeer.php");
require_once("PortPeer.php");
require_once("IncotermPeer.php");

class ImportClientQuoteAcceptAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportClientQuoteAcceptAction() {
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
		
		$products = ProductPeer::getAll();
		$smarty->assign('products',$products);

		$clientQuotePeer = new ClientQuotePeer();
		$clientQuote = $clientQuotePeer->get($_POST['clienQuoteId']);
		
		if (empty($clientQuote)) {
			return $mapping->findForwardConfig('failure');
		}


		//procesamos los items seleccionados
		$items = array();
		$itemsNotProcessed = array();
		$quantities = $_POST['clientQuoteItemsQuantity'];
		foreach ($_POST['clientQuoteItems'] as $key) {
			$item = ClientQuoteItemPeer::get($key);
			
			if (!empty($item)) {
				if (empty($quantities[$key])) {
					//no se indico una cantidad, no se procesa
					array_push($itemsNotProcessed,$item);
				}
				else {
					//se indico una cantidad
					if (!empty($quantities)) {
						$item->setQuantity($quantities[$key]);
					}
					array_push($items,$item);
				}

			}


		}


		if (Common::isAdmin()) {
		
			$user = Common::getAdminLogged();
			if (!empty($items)) {
				$clientPurchaseOrder = $clientQuote->createClientPurchaseOrder($items,'',$user);
			}

			$params = array();
			$params['id'] = $clientQuote->getId();

			if (!empty($itemsNotProcessed)) {
				$params['notProcessed'] = count($itemsNotProcessed);
			}

			return $this->addParamsToForwards($params,$mapping,'success');
		}

		if (Common::isAffiliatedUser()) {
			//Traemos todas las cotizaciones de ese afiliado.
			$affiliateUser = Common::getAffiliatedLogged();
			$affiliate = $affiliateUser->getAffiliate();

			if (!empty($items)) {
				$clientPurchaseOrder = $clientQuote->createClientPurchaseOrder($items,$affiliateUser);
			}
			
			$params = array();
			$params['id'] = $clientQuote->getId();
			if (!empty($itemsNotProcessed)) {
				$params['notProcessed'] = count($itemsNotProcessed);
			}

			return $this->addParamsToForwards($params,$mapping,'success');
		}


		return $mapping->findForwardConfig('failure');
		
	}

}
