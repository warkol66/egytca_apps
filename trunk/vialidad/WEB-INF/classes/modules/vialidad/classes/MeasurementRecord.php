<?php

require_once 'Period.php';

/**
 * Skeleton subclass for representing a row from the 'vialidad_measurementRecord' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class MeasurementRecord extends BaseMeasurementRecord {
	
	/**
	 * Crea los MeasurementRecordRelation que le falten al MeasurementRecord
	 */
	public function updateItems() {
		$recordPeriodTimestamp = DateTime::createFromFormat('m/Y', $this->getMeasurementdate('%m/%Y'));
		$actualPeriodTimestamp = DateTime::createFromFormat('m/Y', date(m/Y));
		
		// si el acta es de un período anterior a la creacion del item no lo agrego
		if ( ($recordPeriodTimestamp - $actualPeriodTimestamp ) < 0)
			return;
		
		$construction = ConstructionQuery::create()->findOneById($this->getConstructionid());
		if ($construction) {
			$items = $construction->getConstructionItems();
			
			// Si un item se agrego, creo su itemRecord
			foreach ($items as $item) {
				if (!$this->hasItem($item)) {
					$this->addItem($item);
				}
			}
			$this->save();
		} else {
			throw new Exception('measurementRecord doesn\'t have a valid Construction ID');
		}
	}
	
	public function updateExtrasRelations() {
		
		$fines = $this->getFines();
		foreach ($fines as $fine) {
			if (!$this->hasItem($fine)) {
				$this->addItem($fine);
			}
		}
		
		$dailyWorks = $this->getDailyWorks();
		foreach ($dailyWorks as $dailyWork) {
			if (!$this->hasItem($dailyWork)) {
				$this->addItem($dailyWork);
			}
		}
		
		$adjustments = $this->getAdjustments();
		foreach ($adjustments as $adjustment) {
			if (!$this->hasItem($adjustment)) {
				$this->addItem($adjustment);
			}
		}

		$others = $this->getOthers();
		foreach ($others as $other) {
			if (!$this->hasItem($other)) {
				$this->addItem($other);
			}
		}

		$this->save();
	}
	
	/**
	 * Determina la existencia de una relacion con un determindo ConstructionItem.
	 * @param $constructionItem ConstructionItem
	 */
	public function hasItem($item) {
		$related = MeasurementRecordRelationQuery::create()->filterByItemid($item->getId())
			->filterByMeasurementRecord($this);
		return ($related->count() > 0);														 		
	}
	
	public function addItem($item) {
		$relation = new MeasurementRecordRelation();
		$relation->setConstructionItem($item);
		$relation->setMeasurementRecord($this);
		$relation->setQuantity(0);
		$relation->setPrice($relation->suggestedPrice());
		$relation->setVerified(false);
	}
	
/*	public function getConstruction() {
		return ConstructionQuery::create()->findOneById($this->getConstructionid());
	}
*/
	/**
	 * Obtiene el Contractor
	 *
	 * @return  object contractor
	 */
	public function getContract() {
		$construction = $this->getConstruction(); 
		if (empty($construction))
			$construction = new Construction();
		return $construction->getContract();
	}

	/**
	 * Obtiene el Contractor
	 *
	 * @return  object contractor
	 */
	public function getContractor() {
		$construction = $this->getConstruction();
		if (empty($construction))
			$construction = new Construction();
		return $construction->getContractor();
	}
	
	/**
	 * Obtiene los items de tipo Fine
	 * @return type 
	 */
	function getFines() {
		return FineQuery::create()
			->filterByConstructionid($this->getConstructionid())
			->filterByDate($this->getPeriod()->getLimits('Y-m-d'))
			->find();
	}
	
	/**
	 * Obtiene los items de tipo DailyWork
	 * @return type 
	 */
	function getDailyWorks() {
		return DailyWorkQuery::create()
			->filterByConstructionid($this->getConstructionid())
			->filterByDate($this->getPeriod()->getLimits('Y-m-d'))
			->find();
	}
	
	/**
	 * Obtiene los items de tipo Adjustment
	 * @return type 
	 */
	function getAdjustments() {
		return AdjustmentQuery::create()
			->filterByConstructionid($this->getConstructionid())
			->filterByDate($this->getPeriod()->getLimits('Y-m-d'))
			->find();
	}

	/**
	 * Obtiene los items de tipo Others
	 * @return type 
	 */
	function getOthers() {
		return OtherQuery::create()
			->filterByConstructionid($this->getConstructionid())
			->filterByDate($this->getPeriod()->getLimits('Y-m-d'))
			->find();
	}

	/**
	 * Obtiene el periodo
	 * 
	 * @return Period 
	 */
	function getPeriod() {
		return new Period($this->getMeasurementdate('%Y-%m-%d'), 'Y-m-d');
	}

} // MeasurementRecord
