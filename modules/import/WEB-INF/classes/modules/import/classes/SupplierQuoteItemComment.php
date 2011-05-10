<?php
require 'import/classes/om/BaseSupplierQuoteItemComment.php';


/**
 * Skeleton subclass for representing a row from the 'import_supplierQuoteItemComment' table.
 *
 * Feedback entre supplier y usuario admin de anmaga sobre un Item
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    import.classes
 */
class SupplierQuoteItemComment extends BaseSupplierQuoteItemComment {

	/**
	 * Initializes internal state of SupplierQuoteItemComment object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	public function getSupplierName() {
		$supplier = $this->getSupplier();
		if (empty($supplier)) {
			return '';
		}
		
		return $supplier->getName();
	}
	
	public function getUserName() {

		$user = $this->getUser();
		if (empty($user)) {
			return '';
		}
		
		return $user->getUsername();
		
	}

} // SupplierQuoteItemComment
