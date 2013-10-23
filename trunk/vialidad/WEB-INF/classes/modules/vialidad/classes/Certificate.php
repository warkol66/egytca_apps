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
	
	function getMeasurementRecordRelations() {
		
		return MeasurementRecordRelationQuery::create()
			->filterByMeasurementrecordid($this->getMeasurementrecordid())
			->useConstructionItemQuery()
				->filterByClassKey(ConstructionItemPeer::CLASSKEY_CONSTRUCTIONITEM)
			->endUse()
			->find();
	}
	
	function updateAccumulatedItems() {
		$relations = $this->getMeasurementRecordRelations();
		foreach ($relations as $relation) {
			$relation->updateAccumulated();
		}
	}
	
	function getExtrasPrice() {
		$price = 0;
		
		$fines = $this->getMeasurementRecord()->getFines();
		$dailyWorks = $this->getMeasurementRecord()->getDailyWorks();
		$adjustments = $this->getMeasurementRecord()->getAdjustments();
		$others = $this->getMeasurementRecord()->getOthers();
		
		foreach ($fines as $fine)
			$price += $fine->getPrice();
		
		foreach ($dailyWorks as $dailyWork)
			$price += $dailyWork->getPrice();
		
		foreach ($adjustments as $adjustment)
			$price += $adjustment->getPrice();
		
		foreach ($others as $other)
			$price += $other->getPrice();
		
		return $price;
	}
	
	function calculatePrice() {
		
		$measurementRecordId = $this->getMeasurementrecordid();
		$relations = MeasurementRecordRelationQuery::create()
			->filterByMeasurementrecordid($measurementRecordId)
			->useConstructionItemQuery()
			->filterByClassKey(ConstructionItemPeer::CLASSKEY_CONSTRUCTIONITEM)
			->endUse()
			->find();
		
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
			->useConstructionItemQuery()
			->filterByClassKey(ConstructionItemPeer::CLASSKEY_CONSTRUCTIONITEM)
			->endUse()
			->find();
		
		$price = 0;
		foreach ($relations as $relation) {
			$price += $relation->getEstimatedTotalPrice($datestring, $format);
		}
		return $price;
	}

/**
 * Precio del total de items de construccion
 */
	function getConstructionItemsPrice() {
		$relations = MeasurementRecordRelationQuery::create()
			->filterByMeasurementrecordid($this->getMeasurementrecordid())
			->useConstructionItemQuery()
				->filterByClassKey(ConstructionItemPeer::CLASSKEY_CONSTRUCTIONITEM)
			->endUse()
			->find();
		
		$price = 0;
		foreach ($relations as $relation) {
			$price += $relation->getTotalPrice();
		}
		return $price;
	}

/**
 * Precio del total de items de construccion ajustado por coeficientes de ajuste 
 */
	function getAdjustedPrice($datestring, $format = 'd-m-Y') {
		$relations = MeasurementRecordRelationQuery::create()
			->filterByMeasurementrecordid($this->getMeasurementrecordid())
			->useConstructionItemQuery()
				->filterByClassKey(ConstructionItemPeer::CLASSKEY_CONSTRUCTIONITEM)
			->endUse()
			->find();
		
		$price = 0;
		foreach ($relations as $relation) {
			$price += $relation->getAdjustedTotalPrice($datestring, $this->getMeasurementRecord()->getContract()->getSigndate('d-m-Y'), $format);
		}
		return $price;
	}

} // Certificate
