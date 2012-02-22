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
	
	/**
	 * Calcula el precio sugerido para el ConstructionItem asociado en el
	 * período del MeasurementRecord asociado.
	 */
	function suggestedPrice() {
		
		$periodo = $this->getMeasurementRecord()->getMeasurementdate('%d/%m/%Y');
		return $this->getEstimatedPrice($periodo, 'd/m/Y');
	}
	
	function getEstimatedPrice($datestring, $format = 'd-m-Y') {
		return $this->getConstructionItem()->getEstimatedPrice($datestring, $format);
	}
	
	function getTotalPrice() {
		return $this->getPrice() * $this->getQuantity();
	}
	
	function getEstimatedTotalPrice($datestring, $format = 'd-m-Y') {
		return $this->getEstimatedPrice($datestring, $format) * $this->getQuantity();
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
