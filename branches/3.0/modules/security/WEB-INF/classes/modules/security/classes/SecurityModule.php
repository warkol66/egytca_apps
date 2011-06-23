<?php

/**
 * Skeleton subclass for representing a row from the 'security_module' table.
 *
 * Modulos del sistema
 *
 * @package    security
 */	
class SecurityModule extends BaseSecurityModule {

	/**
	 * Initializes internal state of Content object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	function getSQLInsert() {
		$module = $this->getModule();
		$noCheckLogin = $this->getNoCheckLogin();
		$access = $this->getAccess();
		$accessAffiliateUser = $this->getAccessAffiliateUser();
		$accessRegistrationUser = $this->getAccessRegistrationUser();
	
		$query = "INSERT INTO `security_module` ( `module` , `noCheckLogin` , `access` , `accessAffiliateUser` , `accessRegistrationUser` ) VALUES ('$module', '$noCheckLogin', '$access', '$accessAffiliateUser','$accessRegistrationUser');";

		return $query;
	}
	
	/**
	 * Indica si el valor pasado corresponde al bitlevel actual de admin de la instancia
	 * @param integer bitlevel
	 * @return true en caso afirmativo, false sino. 
	 */
	function hasAccessBitLevel($bitLevel) {
		return ($this->getAccess() & $bitLevel);
	}

	/**
	 * Indica si el valor pasado corresponde al bitlevel actual de afiliado de la instancia
	 * @param integer bitlevel
	 * @return true en caso afirmativo, false sino. 
	 */
	function hasAccessAffiliateBitLevel($bitLevel) {
		return ($this->getAccessAffiliateUser() & $bitLevel);
	}
	
	/**
	 * Indica si hay acceso a todos en este caso de usuario general
	 * @return boolean
	 */
	function hasAllAccess() {
		return ($this->hasAccessBitLevel(1) && $this->hasAccessBitLevel(2) && $this->hasAccessBitLevel(4));
	}
	
	/**
	 * Indica si hay acceso a todos en este caso de afiliado
	 * @return boolean
	 */
	function hasAllAffiliateAccess() {
		return ($this->hasAccessAffiliateBitLevel(1) && $this->hasAccessAffiliateBitLevel(2) && $this->hasAccessAffiliateBitLevel(4));		
	}
	
	/**
	 * genera el codigo SQL de limpieza de las tablas afectadas al modulo.
	 * @return string SQL
	 */	
	function getSQLCleanup() {
		$sql = "DELETE FROM `security_module` WHERE `module` = '" . $this->getModule() . "';\n";
		$sql .= "OPTIMIZE TABLE `security_module`;";
		return  $sql;
	}
	
	function getAccessByUser($user) {
		$userClass = get_class($user);
		$access = 0;
		switch ($userClass) {
			case "User":
				$access = $this->getAccess();
				break;
			case "AffiliateUser":
				$access = $this->getAccessAffiliateUser();	
				break;
			case "RegistrationUser":
				$access = $this->getAccessRegistrationUser();	
				break;	
		}
		return $access;			
	}	

} // SecurityModule
