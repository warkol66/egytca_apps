<?php



/**
 * Skeleton subclass for representing a row from the 'affiliates_contractor' table.
 *
 * Constructoras
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class Contractor extends BaseContractor {

	/**
	 * Validaciones para el guardado de un contratista
	 * @return bool affiliate creado o no
	 */
	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) {
				parent::save($con);
				return true;
			} else {
				return false;
			}
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	 * Obtengo el usuario Owner con permisos de administracion sobre el contratista
	 * @return object usuario owner
	 */
	function getOwner() {
		return AffiliateUserPeer::get($this->getOwnerId());
	}

	/**
	 * Informo si el usuario pasado a la funcion es el owner
	 * @param $user obj objeto propel user
	 * @return bool true si es owner, false si no
	 */
	function isOwner($user) {
		$affiliateOwner = $this->getOwner();
		if ($affiliateOwner == $user)
			return true;
		else
			return false;
	}

} // Contractor
