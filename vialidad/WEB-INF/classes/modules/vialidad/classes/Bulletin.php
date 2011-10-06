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
	 * Determina la existencia de una relacion con un determindo Supply.
	 * @param $supply Supply
	 */
	public function hasSupply($supply) {
		$related = PriceBulletinQuery::create()->filterByBulletin($this)
                        ->filterBySupply($supply);
		return ($related->count() > 0);														 		
	}
	
	public function addSupply($supply)
	{
		if ($this->collSupplys === null) {
			$this->initSupplys();
		}
		if (!$this->collSupplys->contains($supply)) { // only add it if the **same** object is not already associated
			$priceBulletin = new PriceBulletin();
			$priceBulletin->setSupply($supply);
			$priceBulletin->setPreliminaryprice(-1);
			$priceBulletin->setDefinitiveprice(-1);
			$this->addPriceBulletin($priceBulletin);

			$this->collSupplys[]= $supply;
		}
	}
	
	public function getPriceBulletin($supplyid) {
		return PriceBulletinPeer::retrieveByPK($this->getId(), $supplyid);
	}
	
} // Bulletin
