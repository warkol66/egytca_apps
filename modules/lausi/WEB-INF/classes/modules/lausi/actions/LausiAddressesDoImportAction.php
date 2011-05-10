<?php

class LausiAddressesDoImportAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiAddressesDoImportAction() {
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
		$section = "Addresses";
		$smarty->assign("section",$section);			
		
		$addressesArray = $_REQUEST["addresses"];
		
		//Acomodo el array que viene por post. No seria necesario pero queda mejor...
		$addresses = array();
		for ($i=0;$i<count($addressesArray["street"]);$i++) {
			$address = array();
			$address["street"] = $addressesArray["street"][$i];
			$address["number"] = $addressesArray["number"][$i];
			$address["rating"] = 0;
			$address["intersection"] = $addressesArray["intersection"][$i];
			$address["latitude"] = $addressesArray["latitude"][$i];
			$address["longitude"] = $addressesArray["longitude"][$i];
			$address["regionId"] = $addressesArray["regionId"][$i];
			$address["totalBillboardsDobles"] = $addressesArray["totalBillboardsDobles"][$i];
			$address["totalBillboardsSextuples"] = $addressesArray["totalBillboardsSextuples"][$i];
			$circuit = CircuitPeer::getByName($addressesArray["circuit"][$i]);
			if (!empty($circuit))
				$circuitId = $circuit->getId();
			else
				$circuitId = 0;	
			$address["circuitId"] = $circuitId;			
			$addresses[] = $address;
		}
		
		foreach ($addresses as $address) {
			AddressPeer::createWithBillboards($address, $address["totalBillboardsDobles"],$address["totalBillboardsSextuples"]);									
		}

		return $mapping->findForwardConfig('success');
	}

}
