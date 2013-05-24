<?php



/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'vialidad_invoice' table.
 *
 * Facturas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class AdvancePaymentInvoice extends Invoice {

    /**
     * Constructs a new AdvancePaymentInvoice class, setting the class_key column to InvoicePeer::CLASSKEY_3.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(InvoicePeer::CLASSKEY_3);
    }
	
	public function preSave(\PropelPDO $con = null) {
		
		if (is_null($this->getContractid()))
			throw new Exception ('constructionId cannot be null');
		
		return parent::preSave($con);
	}

} // AdvancePaymentInvoice
