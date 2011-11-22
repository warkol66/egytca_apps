<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_bulletin' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class Bulletin extends BaseBulletin {
	
	/**
	 * Inicializa un bulletin con varios campos de otro.
	 * 
	 * @param Bulletin $other the bulletin to be copied.
	 */
	public function createFrom($other) {
		
	}
	
	/**
	 * Replica los priceBulletins de otro bulletin (aunque algunos
	 * campos como "definitive" se inicializan en false).
	 * 
	 * @param Bulletin $other the bulletin to be copied.
	 */
	public function copyPricesFrom($other) {
		foreach ($other->getPriceBulletins() as $priceBulletin) {
			
			$newPriceBulletin = new PriceBulletin();
			$priceBulletin->copyInto($newPriceBulletin);
			$newPriceBulletin->setBulletin($this);
			
			$newPriceBulletin->setPublish(false);
			$newPriceBulletin->setAverageprice(0);
			$newPriceBulletin->setDefinitive(false);
			$newPriceBulletin->setDefinitive1(false);
			$newPriceBulletin->setSupplierdocument1(null);
			$newPriceBulletin->setDefinitive2(false);
			$newPriceBulletin->setSupplierdocument2(null);
			$newPriceBulletin->setDefinitive3(false);
			$newPriceBulletin->setSupplierdocument3(null);
		
			$newPriceBulletin->save();
			$this->save();	
		}
	}
	
	/**
	 * Determina la existencia de una relacion con un determindo Supply.
	 * @param $supply Supply
	 */
	public function hasSupply($supply) {
		$related = PriceBulletinQuery::create()->filterByBulletin($this)
                        ->filterBySupply($supply);
		return ($related->count() > 0);														 		
	}
	
	public function getPriceBulletin($supplyid) {
		return PriceBulletinQuery::create()->filterByBulletinid($this->getId())
			->filterBySupplyid($supplyid)->findOne();
	}
	
	/**
	 * Asocia un Supply al Bulletin
	 * 
	 * @param Supply $supply Supply a asociar.
	 */
	public function addSupply($supply) {
		$priceBulletin = new PriceBulletin();
		$priceBulletin->setBulletin($this);
		$priceBulletin->setSupply($supply);
		$priceBulletin->setDefinitive(false);
	}
	
} // Bulletin
