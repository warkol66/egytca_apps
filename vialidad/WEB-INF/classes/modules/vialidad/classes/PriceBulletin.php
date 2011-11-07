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

 /**
	 * Obtiene el precio final si ha sido modificado
	 * return array precio definitivo y su estado
	 */
	function getPrice(){
		if (!is_null($this->getModifiedPrice())) {
			$price["price"] = $this->getModifiedPrice();
			$price["status"] = "Modificado";
			$price["modifiedOn"] = $this->getModifiedOn();
		}
		else if (!$this->getDefinitive() && !is_null($this->getDefinitiveOn())) {
			$price["price"] = $this->getAveragePrice();
			$price["status"] = "Definitivo*";
			$price["definitiveOn"] = $this->getDefinitiveOn();
		}
		else if (!$this->getDefinitive() && is_null($this->getDefinitiveOn())) {
			$price["price"] = $this->getAveragePrice();
			$price["status"] = "Provisorio";
		}
		else {
			$price["price"] = $this->getAveragePrice();
			$price["status"] = "Definitivo";
		}
		return $price;
	}
    
} // PriceBulletin
