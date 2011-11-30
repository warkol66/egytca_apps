<?php



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
	
	public function getConstruction() {
		return ConstructionQuery::create()->findOneById($this->getConstructionid());
	}

} // MeasurementRecord
