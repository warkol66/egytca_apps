<?php

require_once('import/classes/BankAccountPeer.php');
require 'import/classes/om/BaseSupplierPurchaseOrderBankTransfer.php';


/**
 * Skeleton subclass for representing a row from the 'import_supplierPurchaseOrderBankTransfer' table.
 *
 * Transferencias bancarias realizadas a esa orden de pedido a proveedor
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    import.classes
 */
class SupplierPurchaseOrderBankTransfer extends BaseSupplierPurchaseOrderBankTransfer {

	/**
	 * Initializes internal state of SupplierPurchaseOrderBankTransfer object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

} // SupplierPurchaseOrderBankTransfer
