<?php

/**
 * Skeleton subclass for representing a row from the 'security_module' table.
 *
 * Modulos del sistema
 *
 * @package    security
 */
class SecurityModule extends BaseSecurityModule {
	
	const LEVEL_ALL = 1073741823;

	static function createFromModule($module) {
		
		$securityModule = new SecurityModule();
		$securityModule->setModule($module)
			->setAccess(0)
			->setAccessaffiliateuser(0)
			->setAccessregistrationuser(0)
			->setNochecklogin(0);
		
		return $securityModule;
	}
	
	function setAccessForBitLevel($access, $bitLevel) {
		if ($access)
			$this->setAccess($this->getAccess() | $bitLevel);
		else
			$this->setAccess($this->getAccess() & ~$bitLevel);
	}

	/**
	 * Genera instrucciones sql para insertar informacion de seguridad del modulo
	 * @return string sql de insercion
	 */
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
	
	function hasAllUsersAccess() {
		return $this->getAccess() == SecurityModulePeer::LEVEL_ALL;
	}

	/**
	 * Genera el codigo SQL de limpieza de las tablas afectadas al modulo.
	 * @return string SQL
	 */
	function getSQLCleanup() {
		$sql = "DELETE FROM `security_module` WHERE `module` = '" . $this->getModule() . "';\n";
		$sql .= "OPTIMIZE TABLE `security_module`;";
		return  $sql;
	}

	/**
	 * Obtienen el acceso segun el tipo de usuario
	 * @return boolean
	 */
	function getAccessByUser($user) {
		$userClass = get_class($user);
		$access = 0;
		$method = "getAccess";
		if ($userClass != "User")
			$method .= $userClass;
		$moduleBitLevel = $this->$method();

		$level = $user->getLevel();
		if ($level->getBitLevel() & $moduleBitLevel)
			return true;
		else
			return false;
	}

} // SecurityModule
