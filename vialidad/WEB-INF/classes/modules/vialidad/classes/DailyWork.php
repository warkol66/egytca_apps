<?php



/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'vialidad_constructionItem' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class DailyWork extends ConstructionItem {

	/**
	 * Constructs a new DailyWork class, setting the class_key column to ConstructionItemPeer::CLASSKEY_3.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setClassKey(ConstructionItemPeer::CLASSKEY_3);
	}
	
	public function getMeasurementRecordRelation() {
		return MeasurementRecordRelationQuery::create()->filterByConstructionItem($this)->findOne();
	}

} // DailyWork
