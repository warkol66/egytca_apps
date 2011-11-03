<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_priceBulletin' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class PriceBulletin extends BasePriceBulletin {

 /**
	 * Especifica el precio modificado (modifiedPrice) y la fecha de modificacion
	 * params $price decimal precio modificado
	 */
	function setModified($price){
		$this->setModifiedPrice($price);
		$this->setModifiedOn(time());
	}

} // PriceBulletin
