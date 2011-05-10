<?php

class ImportShipmentsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportShipmentsDoEditAction() {
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

		$shipmentParams = $_POST['shipment'];
		
		if ( !empty($_POST['id']) )
			$shipment = ShipmentPeer::get($_POST['id']);
		
		if (empty($shipment))
			$shipment = new Shipment();
			
		Common::setObjectFromParams($shipment, $shipmentParams);
		
		if (!$shipment->save())
			return $mapping->findForwardConfig('failure');
		
		//Si ya tiene shipmentRelease pero lo acabamos de crear, entonces vamos al edit de ShipmentRelease.
		if (!empty($_POST['shipmentReleaseId']))
			return $this->addParamsToForwards(array('id' => $_POST['shipmentReleaseId']), $mapping, 'createShipmentRelease');
			
		//Si por algún motivo aún no tiene ShipmentRelease, vamos al edit de ShipmentRelease.
		if (!$shipment->hasShipmentRelease()) {
			return $this->addParamsToForwards(array('shipmentId' => $shipment->getId()), $mapping, 'createShipmentRelease');
		}
		return $mapping->findForwardConfig('success');
	}
}

