<?php

require_once("BaseAction.php");
require_once("SupplierQuotePeer.php");

class ImportSupplierQuoteConfirmAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportSupplierQuoteConfirmAction	() {
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
		
		$supplierQuotePeer = new SupplierQuotePeer();

			
		if (empty($_POST['token'])) {
			return $mapping->findForwardConfig('failure');		
		}

		$smarty->assign('token',$_POST['token']);

		//traemos todas las cotizaciones.
		$supplierQuote = $supplierQuotePeer->getByAccessToken($_POST["token"]);
		
		if (!$supplierQuote->confirm()) {
			return $mapping->findForwardConfig('failure');			
		}

		$params = array();
		$params['token'] = $_POST['token'];
		
		return $this->addParamsToForwards($params,$mapping,'success');
		
	}

}
