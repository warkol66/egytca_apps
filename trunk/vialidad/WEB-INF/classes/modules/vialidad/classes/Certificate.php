<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_certificate' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class Certificate extends BaseCertificate {
	
	function calculatePrice() {
		
		$measurementRecordId = $this->getMeasurementrecordid();
		$relations = MeasurementRecordRelationQuery::create()
			->filterByMeasurementrecordid($measurementRecordId)->find();
		
		$price = 0;
		foreach ($relations as $relation) {
			$price += $relation->getTotalPrice();
		}
		return $price;
	}
	
	function getEstimatedPrice($datestring, $format = 'd-m-Y') {
		$relations = MeasurementRecordRelationQuery::create()
			->filterByMeasurementrecordid($this->getMeasurementrecordid())
			->find();
		
		$price = 0;
		foreach ($relations as $relation) {
			$price += $relation->getEstimatedTotalPrice($datestring, $format);
		}
		return $price;
	}
	
	function getAdjustmentCoeficient() {
		$contractDate = $this->getMeasurementRecord()->getContract()->getStartdate('%d-%m-%Y');
		$certificateDate = $this->getMeasurementRecord()->getMeasurementdate('%d-%m-%Y');
		
		return $this->getEstimatedPrice($certificateDate, 'd-m-Y') / $this->getEstimatedPrice($contractDate, 'd-m-Y');
	}

} // Certificate
