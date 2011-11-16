<?php



/**
 * Skeleton subclass for performing query and update operations on the 'vialidad_priceBulletin' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class PriceBulletinPeer extends BasePriceBulletinPeer {
	
    /** Precio definitivo */
    const PRICE_DEFINITIVE = "Definitivo";
    
    /** Precio provisorio */
    const PRICE_PROVISORY = "Provisorio";
    
    /** Precio modificado a mano */
    const PRICE_MODIFIED = "Modificado";
    
    /** Precio modificado a mano definitivo */
    const PRICE_MODIFIED_DEFINITIVE = "Definitivo*";
    
	/**
	 * Elimina un PriceBulletin.
	 * 
	 * @param PriceBulletin $priceBulletin
	 * @return boolean true si se elimino correctamente el PriceBulletin, false sino
	 */
	function delete($priceBulletin){
		try {
			$priceBulletin->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // PriceBulletinPeer
