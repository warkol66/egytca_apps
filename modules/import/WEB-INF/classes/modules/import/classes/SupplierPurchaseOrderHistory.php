<?php

require 'import/classes/om/BaseSupplierPurchaseOrderHistory.php';


/**
 * Skeleton subclass for representing a row from the 'import_supplierPurchaseOrderHistory' table.
 *
 * Historial de Estados por los que fue pasando la Orden de Pedido a Proveedor
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    import.classes
 */
class SupplierPurchaseOrderHistory extends BaseSupplierPurchaseOrderHistory {

	/**
	 * Initializes internal state of SupplierPurchaseOrderHistory object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	/**
	 * Devuelve el nombre del status actual de la cotizacion para un administrador
	 * @return string
	 */
	public function getStatusName() {
		
		$supplierPurchaseOrder = $this->getSupplierPurchaseOrder();
		$statusNames = $supplierPurchaseOrder->getStatusNames();
		return $statusNames[$this->getStatus()];
	}


} // SupplierPurchaseOrderHistory
