<?php


/**
 * Skeleton subclass for representing a row from the 'tablero_measure' table.
 *
 * Measure
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroMeasure extends BaseTableroMeasure {

	/** the default item name for this class */
	const ITEM_NAME = 'Measure';

	/**
	 * Indica si un afiliado/dependencia es duenio de la instancia
	 * @param $affiliateId id de afiliado/dependencia
	 * @return true si lo es, false sino
	 */
	function isOwner($affiliateId) {
		$affiliate = $this->getIndicator()->getProject()->getObjective()->getAffiliate();
		if ($affiliate->getId() == $affiliateId)
			return true;
		
		return false;
	}

} // TableroMeasure
