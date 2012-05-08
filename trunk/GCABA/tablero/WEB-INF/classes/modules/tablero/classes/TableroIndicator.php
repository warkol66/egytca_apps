<?php


/**
 * Skeleton subclass for representing a row from the 'tablero_indicator' table.
 *
 * Indicator
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroIndicator extends BaseTableroIndicator {

	/** the default item name for this class */
	const ITEM_NAME = 'Indicator';

	/**
	 * Indica si un afiliado/dependencia es duenio de la instancia
	 * @param $affiliateId id de afiliado/dependencia
	 * @return true si lo es, false sino
	 */
	function isOwner($affiliateId) {
		$affiliate = $this->getProject()->getObjective()->getAffiliate();
		if ($affiliate->getId() == $affiliateId)
			return true;
		
		return false;
	}
	
	/**
	 * Indica si el indicador es general para todo el proyecto
	 *
	 * @return true si lo es, false sino 
	 */
	function isGeneral() {

		if (($this->getCommuneId() == 0) && ($this->getRegionId())) {
			return true;
		}
		
		return false;
	
	}
	
	/**
	 * Indica si el indicador es por comuna.
	 *
	 * @return true si lo es, false sino 
	 */
	function isForCommune() {

		if ($this->getCommuneId() != 0)
			return true;
		
		return false;	
	
	}
	
	/**
	 * Indica si el indicador es por region.
	 *
	 * @return true si lo es, false sino 
	 */
	function isForRegion() {

		if ($this->getRegionId() != 0)
			return true;
		
		return false;	

	
	
	}
	

} // TableroIndicator
