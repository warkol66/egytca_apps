<?php

require_once("BaseAction.php");
require_once("ClientQuotePeer.php");

class ImportClientQuoteCreateAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportClientCreateListAction() {
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
		
		$clientQuotePeer = new ClientQuotePeer();

		if (empty($_POST['clientQuote']['affiliateId'])) {
			return $mapping->findForwardConfig('failure');
		}

		if (Common::isAdmin()) {
			$adminUser = Common::getAdminLogged();
			$_POST['clientQuote']['userId'] = $adminUser->getId();
		}

		if (Common::isAffiliatedUser()) {
			$affiliateUser = Common::getAffiliatedLogged();
			$_POST['clientQuote']['affiliateUserId'] = $affiliateUser->getId();
		}

		$clientQuote = ClientQuotePeer::createInstance($_POST['clientQuote']);

		if (!$clientQuote) {
			return $mapping->findForwardConfig('failure');
		}
		
		//guardamos en la sesion el objeto creado
		$_SESSION['import']['clientQuote'] = $clientQuote;
		
		return $mapping->findForwardConfig('success');

	}

}
