<?php

require 'import/classes/om/BaseSupplierQuoteHistory.php';


/**
 * Skeleton subclass for representing a row from the 'import_supplierQuoteHistory' table.
 *
 * Historial de Cotizacion a Proveedor
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    import.classes
 */
class SupplierQuoteHistory extends BaseSupplierQuoteHistory {

	/**
	 * Initializes internal state of SupplierQuoteHistory object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	/**
	 * Devuelve el nombre del status actual de la cotizacion para un cliente
	 * @return string
	 */
	public function getStatusName() {
		$supplierQuote = $this->getSupplierQuote();
		$statusNames = $supplierQuote->getStatusNames();
		return $statusNames[$this->getStatus()];
	}	

} // SupplierQuoteHistory
