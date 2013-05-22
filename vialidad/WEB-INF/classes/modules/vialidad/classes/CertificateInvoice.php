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
class CertificateInvoice extends Invoice {

    /**
     * Constructs a new CertificateInvoice class, setting the class_key column to InvoicePeer::CLASSKEY_2.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(InvoicePeer::CLASSKEY_2);
    }
	
	public function preSave(\PropelPDO $con = null) {
		
		if (is_null($this->getCertificateid()))
			throw new Exception ('certificateId cannot be null');
		
		$this->updateValues();
		
		return parent::preSave($con);
	}
	
	public function updateValues() {
		$this->updateAdvancePaymentRecovery();
		$this->updateTotalPrice();
		$this->updateWithholding();
	}
	
	private function updateAdvancePaymentRecovery() {
		$advancePaymentRecoveryRate = 0.10; // TODO: mover al config?
		$this->setAdvancepaymentrecovery($this->getCertificate()->getTotalprice() * $advancePaymentRecoveryRate);
	}
	
	private function updateWithholding() {
		$withholdingTax = 0.05; // TODO: mover a config?
		$price = $this->getPriceWithoutWithholding();
		$this->setWithholding(is_null($price) ? null : $price * $withholdingTax);
	}
	
	private function updateTotalPrice() {
		$this->setTotalprice($this->getPriceWithoutWithholding() - $this->getWithholding());
	}
	
	private function getPriceWithoutWithholding() {
		$certificateTotalPrice = $this->getCertificate()->getTotalprice();
		return $certificateTotalPrice - $this->getAdvancepaymentrecovery();
	}
	

} // CertificateInvoice
