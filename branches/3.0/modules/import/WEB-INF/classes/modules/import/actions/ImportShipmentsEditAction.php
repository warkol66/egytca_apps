<?php

class ImportShipmentsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportShipmentsEditAction() {
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

		$shipmentPeer = new ShipmentPeer();
		$supplierPurchaseOrderPeer = new SupplierPurchaseOrderPeer();

		if (!empty($_GET["id"])) {
			$shipment = $shipmentPeer->get($_GET["id"]);
			$smarty->assign('action', 'edit');
		} else {
			$shipment = new Shipment();
			if (!empty($_GET["supplierPurchaseOrderId"])) {
				$supplierPurchaseOrder = $supplierPurchaseOrderPeer->get($_GET["supplierPurchaseOrderId"]);
				$shipment->setSupplierPurchaseOrder($supplierPurchaseOrder);
				
				//Vamos a crearlos en la base, aunque por el momento estén vacíos.
				//Esto evita la posibilidad de retractarse a mitad del proceso.
				if (!$shipment->save())
					return $mapping->findForwardConfig('failure');
				$shipmentRelease = new ShipmentRelease();
				$shipmentRelease->setShipment($shipment);
				if (!$shipmentRelease->save())
					return $mapping->findForwardConfig('failure');
				$smarty->assign('shipmentReleaseId',$shipmentRelease->getId());
			} else {
				return $mapping->findForwardConfig('failure');
			}
		}
		
		// Preparamos los puertos
		$ports = PortPeer::getAll();
		$smarty->assign('ports',$ports);
		
		$smarty->assign('shipment',$shipment);

		return $mapping->findForwardConfig('success');	
	}
}