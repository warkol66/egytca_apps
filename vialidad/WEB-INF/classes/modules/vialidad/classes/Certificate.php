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
	
	function totalPrice() {
		
		$measurementRecordId = $this->getMeasurementrecordid();
		$relations = MeasurementRecordRelationQuery::create()
			->filterByMeasurementrecordid($measurementRecordId)->find();
		
		$price = 0;
		foreach ($relations as $relation) {
			$price += $relation->getPrice();
		}
		return $price;
	}

} // Certificate
