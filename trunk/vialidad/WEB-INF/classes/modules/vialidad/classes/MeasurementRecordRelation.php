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
