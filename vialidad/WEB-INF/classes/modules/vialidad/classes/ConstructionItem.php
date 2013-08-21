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
	
/**
 * Precio estimado del item de construccion
 */
	function getEstimatedPrice($datestring, $format = 'd-m-Y') {
		$price = 0;
		
		$dateTime = DateTime::createFromFormat($format, $datestring);
		if (!empty($dateTime))
			$bulletin = BulletinQuery::create()->filterByPeriodo($dateTime->format('d/m/Y'))->findOne();
		if (is_null($bulletin))
			return null;
			
		$itemRelations = ConstructionItemRelationQuery::create()
			->filterByConstructionItem($this)->find();
		foreach ($itemRelations as $itemRelation) {
			$priceBulletin = PriceBulletinQuery::create()->filterBySupplyid($itemRelation->getSupplyId())
				->filterByBulletin($bulletin)->findOne();
			if (!empty($priceBulletin))
				$price += $priceBulletin->getAverageprice() * $itemRelation->getProportion() / 100;
		}

		return $price;
	}
	
/**
 * Coeficientes de ajuste 
 */
	function getAdjustmentCoeficient($newDatestring, $oldDatestring, $format = 'd-m-Y') {
		return $this->getEstimatedPrice($newDatestring, $format) / $this->getEstimatedPrice($oldDatestring, $format);
	}

/**
 * Precio total del item de construccion ajustado por coeficientes de ajuste 
 */
	function getAdjustedPrice($newDatestring, $oldDatestring, $format = 'd-m-Y') {
		return $this->getEstimatedPrice($newDatestring, $format) * $this->getAdjustmentCoeficient($newDatestring, $oldDatestring, $format);
	}

	/**
	 * Determina si la proporcion esta completada
	 * @param $supply Supply
	 */
	public function completed() {
		$related = ConstructionItemRelationQuery::create()->filterByConstructionItem($this)->find();
		foreach ($related as $itemRelated)
			$completed += $itemRelated->getProportion();

		return ($completed == 100);														 		
	}

} // ConstructionItem
