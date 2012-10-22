<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_measurementRecordComment' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class MeasurementRecordComment extends BaseMeasurementRecordComment {
	
	public function getUser() {
		$queryClass = ($this->getUserType()) . "Query";
		if (class_exists($queryClass))
			return $queryClass::create()->findOneById($this->getUserid());
		else
			return null;
	}

} // MeasurementRecordComment