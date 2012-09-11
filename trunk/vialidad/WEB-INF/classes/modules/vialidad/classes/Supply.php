<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_supply' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class Supply extends BaseSupply {

	/**
	 * Devuelve array con posibles tipos de suministro (supply)
	 *  id => Estados posibles
	 *
	 * @return array tipos de suministro
	 */
	public static function getSupplytypes() {
		$supplyTypes = array(
			1 => 'Insumos de construcción',
			2 => 'Otro insumos'
		);
		return $supplyTypes;
	}


} // Supply
