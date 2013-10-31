<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_measurementRecordRelation' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class MeasurementRecordRelation extends BaseMeasurementRecordRelation {
	
	const NEXT = 0;
	const PREVIOUS = 1;
	
	function getPegado($type) {
		
		$date = $this->getMeasurementRecord()->getMeasurementdate('%Y-%m-%d');
		$period = new Period($date, 'Y-m-d');
		
		switch ($type) {
			case self::NEXT:
				$wantedPeriod = $period->getNextPeriod();
				break;
			case self::PREVIOUS:
				$wantedPeriod = $period->getPreviousPeriod();
				break;
			default:
				throw new Exception('unknown type');
		}
		
		return MeasurementRecordRelationQuery::create()
			->filterByItemid($this->getItemid())
			->useMeasurementRecordQuery()
				->filterByConstructionid($this->getMeasurementRecord()->getConstructionid())
				->filterByMeasurementdate($wantedPeriod->getLimits('Y-m-d'))
			->endUse()
			->findOne();
	}
	
	/**
	 * returns the chronologically previous MeasurementRecordRelation
	 */
	function getPrevious() {
		return $this->getPegado(MeasurementRecordRelation::PREVIOUS);
	}
	
	/**
	 * returns the chronologically next MeasurementRecordRelation
	 */
	function getNext() {
		return $this->getPegado(MeasurementRecordRelation::NEXT);
	}
	
	function getCertificate() {
		return CertificateQuery::create()
			->filterByMeasurementrecordid($this->getMeasurementrecordid())
			->findOne();
	}
	
	function getTotalMinusDown() {
		return $this->getTotalPrice() * 0.9;
	}
	
	function getKu() {
		$bulletinDate = $this->getCertificate()->getBulletin()->getBulletindate();
		return $this->getConstructionItem()->getKu($bulletinDate);
	}
	
	function getReadjustment() {
		return $this->getTotalMinusDown() * $this->getKu();
	}
	
	function getAccumulated() {
		$constructionItemAccumulated = ConstructionItemAccumulatedQuery::create()
			->filterByItemId($this->getItemid())
			->filterByCertificateid($this->getCertificate()->getId())
			->findOne();
		
		return $constructionItemAccumulated ? $constructionItemAccumulated->getAccumulated() : 0;
	}
	
	function setAccumulated($value) {
		ConstructionItemAccumulatedQuery::create()
			->filterByItemid($this->getItemid())
			->filterByCertificateid($this->getCertificate()->getId())
			->findOneOrCreate()
			->setAccumulated($value)
			->save();
	}
	
	function updateAccumulated() {
		$previous = $this->getPrevious();
		$previousAccumulated = $previous ? $previous->getAccumulated() : 0;
		$this->setAccumulated($previousAccumulated + $this->getReadjustment());
	}
	
	function getPrice() {
		return $this->getConstructionItem()->getPrice();
	}
	
	/**
	 * Calcula el precio sugerido para el ConstructionItem asociado en el
	 * período del MeasurementRecord asociado.
	 */
	function suggestedPrice() {
		$periodo = $this->getMeasurementRecord()->getMeasurementdate('%d/%m/%Y');
		return $this->getEstimatedPrice($periodo, 'd/m/Y');
	}
	
/**
 * Precio estimado item del acta de medicion
 */
	function getEstimatedPrice($datestring, $format = 'd-m-Y') {
		return $this->getConstructionItem()->getEstimatedPrice($datestring, $format);
	}
	
/**
 * Precio total del item del acta de medicion
 */
	function getTotalPrice() {
		return $this->getPrice() * $this->getQuantity();
	}
	
/**
 * Precio estimado del item del acta de medicion
 */
	function getEstimatedTotalPrice($datestring, $format = 'd-m-Y') {
		return $this->getEstimatedPrice($datestring, $format) * $this->getQuantity();
	}
	
/**
 * Precio total del item del acta de medicion ajustado por coeficientes de ajuste 
 */
	function getAdjustedTotalPrice($newDatestring, $oldDatestring, $format = 'd-m-Y') {
		return $this->getAdjustedPrice($newDatestring, $oldDatestring, $format = 'd-m-Y') * $this->getQuantity();
	}

/**
 * Precio del item del acta de medicion ajustado por coeficientes de ajuste 
 */
	function getAdjustedPrice($newDatestring, $oldDatestring, $format = 'd-m-Y') {
		return $this->getConstructionItem()->getAdjustedPrice($newDatestring, $oldDatestring, $format);
	}

	function postSave(PropelPDO $con = null) {
		parent::postSave($con);
		$certificate = CertificateQuery::create()->filterByMeasurementrecordid($this->getMeasurementrecordid())->findOne();
		if (!is_null($certificate)) { // el Certificate puede no existir
			$certificate->setTotalprice($certificate->calculatePrice());
			$certificate->save();
		}
	}

} // MeasurementRecordRelation
