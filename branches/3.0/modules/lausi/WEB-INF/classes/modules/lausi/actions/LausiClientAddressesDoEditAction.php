<?php

class LausiClientAddressesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiClientAddressesDoEditAction() {
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

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "ClientAddresses";
		$smarty->assign("section",$section);	
		
		$params = $_POST['address'];

		$params["latitude"] = Common::convertToMysqlNumericFormat($params["latitude"]);
		$params["longitude"] = Common::convertToMysqlNumericFormat($params["longitude"]);

		if ( !empty($_POST["id"]) ) {
			//estoy editando un clientaddress existente
			$clientAddress = ClientAddressPeer::get($_POST["id"]);
			$smarty->assign("action","edit");
		} else {
			//estoy creando un nuevo clientaddress
			$clientAddress = new ClientAddress;
			$smarty->assign("action","create");
		}

		Common::setObjectFromParams($clientAddress, $params);
		
		if (!$clientAddress->save()) {
			$smarty->assign("circuitIdValues",CircuitPeer::getAll());
			$smarty->assign("clientIdValues",ClientPeer::getAll());
			$smarty->assign("regionIdValues",RegionPeer::getAll());
			$smarty->assign("clientaddress",$clientAddress);	
			$smarty->assign("message","error");
			return $mapping->findForwardConfig('failure');
		}

		return $mapping->findForwardConfig('success');
	}
}