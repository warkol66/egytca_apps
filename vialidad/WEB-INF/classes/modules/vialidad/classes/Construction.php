<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_construction' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class Construction extends BaseConstruction {
	
	function getPriceOnPeriod($period) {
		require_once 'Period.php';
		$certificate = CertificateQuery::create()->useMeasurementRecordQuery()->filterByConstruction($this)
			->filterByMeasurementdate($period->getLimits("d-m-Y"))->endUse()->findOne();
		return is_null($certificate) ? 0 : $certificate->getTotalPrice();
	}
	
	function getAccumulatedPriceOnPeriod($period) {
		require_once 'Period.php';
		$certificates = CertificateQuery::create()->useMeasurementRecordQuery()->filterByConstruction($this)
			->filterByMeasurementdate($period->getMax("d-m-Y"), Criteria::LESS_EQUAL)->endUse()->find();
		
		$price = 0;
		foreach($certificates as $certificate)
			$price += $certificate->getTotalPrice();
		
		return $price;
	}

} // Construction
