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
	
	function getExtrasPrice() {
		$price = 0;
		
		$fines = $this->getMeasurementRecord()->getFines();
		$dailyWorks = $this->getMeasurementRecord()->getDailyWorks();
		$adjustments = $this->getMeasurementRecord()->getAdjustments();
		
		foreach ($fines as $fine)
			$price += $fine->getPrice();
		
		foreach ($dailyWorks as $dailyWork)
			$price += $dailyWork->getPrice();
		
		foreach ($adjustments as $adjustment)
			$price += $adjustment->getPrice();
		
		return $price;
	}
	
	function calculatePrice() {
		
		$measurementRecordId = $this->getMeasurementrecordid();
		$relations = MeasurementRecordRelationQuery::create()
			->filterByMeasurementrecordid($measurementRecordId)->find();
		
		$price = 0;
		foreach ($relations as $relation) {
			$price += $relation->getTotalPrice();
		}
		$price += $this->getExtrasPrice();
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
		$price += $this->getExtrasPrice();
		return $price;
	}

} // Certificate
