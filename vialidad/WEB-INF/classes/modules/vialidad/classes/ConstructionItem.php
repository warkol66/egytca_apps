<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_constructionItem' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class ConstructionItem extends BaseConstructionItem {
	
	/**
	 * @param Supply $supply
	 * @return float proportion of $supply in the ConstructionItem
	 */
	public function getProportionForSupply($supply) {
		$itemRelation = ConstructionItemRelationQuery::create()->filterByConstructionItem($this)
			->filterBySupply($supply)->findOne();
		return is_null($itemRelation) ? 0.00 : $itemRelation->getProportion();
	}
	
	/**
	 * Determina la existencia de una relacion con un determindo Supply.
	 * @param $supply Supply
	 */
	public function hasSupply($supply) {
		$related = ConstructionItemRelationQuery::create()->filterByConstructionItem($this)
			->filterBySupply($supply);
		return ($related->count() > 0);														 		
	}

} // ConstructionItem
