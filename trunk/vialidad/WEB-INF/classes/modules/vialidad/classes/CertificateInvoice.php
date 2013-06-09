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
		
		return parent::preSave($con);
	}
	
	/**
	 * Returns the totalPrice accumulated value for this and all previous CertificateInvoices
	 * related by a Construction
	 * 
	 * @return type accumulated value
	 */
	public function getAccumulatedTotalPrice($includeThis = true) {
		return $this->accumulateByName('Totalprice', $includeThis);
	}
	
	/**
	 * Returns the withholding accumulated value for this and all previous CertificateInvoices
	 * related by a Construction
	 * 
	 * @return type accumulated value
	 */
	public function getAccumulatedWithholding($includeThis = true) {
		return $this->accumulateByName('Withholding', $includeThis);
	}
	
	/**
	 * Returns the field accumulated value for this and all previous CertificateInvoices
	 * related by a Construction
	 * 
	 * @param string $fieldname field to be accumulated
	 * @return type accumulated value
	 */
	private function accumulateByName($fieldname, $includeThis = true) {
		
		$comparison = $includeThis ? Criteria::LESS_EQUAL : Criteria::LESS_THAN;
		
		$measurementDate = $this->getCertificate()->getMeasurementRecord()->getMeasurementdate();
		$certificateInvoices = CertificateInvoiceQuery::create()
			->useCertificateQuery()
				->useMeasurementRecordQuery()
					->filterByMeasurementdate($measurementDate, $comparison)
				->endUse()
			->endUse()
		->find();
		
		$accumulated = 0;
		foreach ($certificateInvoices as $certificateInvoice) {
			$accumulated += $certificateInvoice->getByName($fieldname);
		}
		
		return $accumulated;
	}
	
	public function calculateValues() {
		return array(
			'advancePaymentRecovery' => $this->calculateAdvancePaymentRecovery(),
			'withholding' => $this->calculateWithholding(true),
			'totalPrice' => $this->calculateTotalPrice(true)
		);
	}
	
	public function calculateAdvancePaymentRecovery() {
		
		$contract = $this->getCertificate()->getMeasurementRecord()->getConstruction()->getContract();
		
//		$recoveredAdvancePayment = $contract->getRecoveredAdvancePayment();
		$recoveredAdvancePayment = $this->accumulateByName('Advancepaymentrecovery', false);
		
		$availableAdvancePayment = $contract->getAdvancePayment() - $recoveredAdvancePayment;
		
		if ($availableAdvancePayment > 0) {
			
			$advancePaymentRecoveryRate = 0.10; // TODO: mover al config?
			$calculatedAdvancePaymentRecovery = $this->getCertificate()->getTotalprice() * $advancePaymentRecoveryRate;
			return min(array($availableAdvancePayment, $calculatedAdvancePaymentRecovery));
		}
		else {
			return 0;
		}
	}
	
	public function calculateWithholding($chainCalculated = false) {
		$withholdingTax = 0.05; // TODO: mover a config?
		$price = $this->getPriceWithoutWithholding($chainCalculated);
		return is_null($price) ? null : ($price * $withholdingTax);
	}
	
	public function calculateTotalPrice($chainCalculated = false) {
		$priceWithoutWitholding = $this->getPriceWithoutWithholding($chainCalculated);
		$withholding = $chainCalculated ? $this->calculateWithholding($chainCalculated) : $this->getWithholding();
		return $priceWithoutWitholding - $withholding;
	}
	
	private function getPriceWithoutWithholding($chainCalculated = false) {
		$certificateTotalPrice = $this->getCertificate()->getTotalprice();
		$advancePaymentRecovery = $chainCalculated ? $this->calculateAdvancePaymentRecovery() : $this->getAdvancepaymentrecovery();
		return $certificateTotalPrice - $advancePaymentRecovery;
	}
	

} // CertificateInvoice
