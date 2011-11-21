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
