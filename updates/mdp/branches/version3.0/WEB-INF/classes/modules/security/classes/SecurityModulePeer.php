<?php

/**
 * Skeleton subclass for performing query and update operations on the 'security_module' table.
 *
 * Modulos del sistema
 *
 * @package    security
 */
class SecurityModulePeer extends BaseSecurityModulePeer {

	const LEVEL_ALL = 1073741823;

	/**
	* Obtiene el nivel de acceso de un modulo
	* @param string $modulename nombre del modulo
	* @return object $obj el objeto encontrado
	*/
	function getAccess($moduleName) {
		return SecurityModuleQuery::create()->findOneByModule($moduleName);
	}

	/**
	* Limpia el acceso de un determinado modulo
	* @param string $module con el nombre del modulo a limpiar
	* @param string $baseLevel nivel base
	*/
	function clearAccess($module,$baseLevel) {
		$securityModule = SecurityModulePeer::retrieveByPK($module);
		$securityModule->setAccess($baseLevel);
		$securityModule->save();
		return true;
	}

	/**
	* Actualiza los modules en la base de datos
	* @param string $moduleName nombre del modulo
	* @param int $access con el numero de acceso que tendrá el modulo
	* @return true si todo está ok
	*/
	function setNewAccess($moduleName,$access) {
		$securityModule = SecurityModulePeer::retrieveByPK($moduleName);
		$securityModule->setAccess($access);
		$securityModule->save();
		return true;
	}

	/**
	* Agrega un modulo y su accesso
	* @param string $moduleName nombre del modulo
	* @param int $access acceso del modulo
	* @return true si salio todo ok
	*/
	function addModule($moduleName,$access) {
		$securityModule = new SecurityModule();
		$securityModule->setModule($moduleName);
		$securityModule->setAccess($access);
		$securityModule->save();
		return true;
	}

	/**
	*	Toma un modulo
	*	@param string $moduleName nombre del modulo
	*	@return object $module nombre del modulo seleccionado
	*/
	function get($moduleName) {
		return SecurityModuleQuery::create()->setIgnoreCase('true')->findOneByModule($moduleName);
	}

	/**
	*	Toma el acceso de un modulo
	*	@param string $moduleName nombre del modulo
	*	@return $obj el acceso del modulo
	*/
	function getAccessByModule($moduleName) {
		return SecurityModuleQuery::create()->setIgnoreCase('true')->findOneByModule($moduleName);
	}

	/**
	 * Obtiene un array con todos los modulos a los que se tiene permiso
	 * @return array de modulos
	 */
	function getAccessToModule($module) {

		$access = array();
		$securityModule = SecurityModulePeer::getAccess($module);

		if (!empty($securityModule)) {

			//Permisos para usuarios
			$bitLevel = $securityModule->getAccess();
			if ($bitLevel == (SecurityModulePeer::LEVEL_ALL)) {
				$access['permissionGeneral'][all] = 1;
				$bitLevel = 0;
			}
			$userLevels = LevelPeer::getAll();
			foreach ($userLevels as $level)
				$access['permissionGeneral'][$level->getBitLevel()] = Common::evaluateBitlevel($level->getBitLevel(),$bitLevel);

			//Permisos para usuarios por afiliado
			if (class_exists("AffiliateLevelPeer")) {
				$bitLevelAffiliate = $securityModule->getAccessAffiliateUser();
				$affiliateUserLevels = AffiliateLevelPeer::getAll();
				foreach ($affiliateUserLevels as $level)
					$access['permissionAffiliateGeneral'][$level->getBitLevel()] = Common::evaluateBitlevel($level->getBitLevel(),$bitLevelAffiliate);
				$access['permissionAffiliateGeneral'][all] = Common::evaluateBitlevel(SecurityModulePeer::LEVEL_ALL,$bitLevelAffiliate);
			}
			//Permisos para usauarios por registro
			if (class_exists("RegistrationUser"))
				$access['permissionRegistrationGeneral'] = $securityModule->getAccessRegistrationUser();

			//Permisos para usuarios por cliente
			if (class_exists("ClientUserPeer")) {
				$bitLevelClient = $securityModule->getAccessClientUser();
				$ClientUserLevels = ClientLevelPeer::getAll();
				foreach ($ClientUserLevels as $level)
					$access['permissionClientGeneral'][$level->getBitLevel()] = Common::evaluateBitlevel($level->getBitLevel(),$bitLevelAffiliate);
				$access['permissionClientGeneral'][all] = Common::evaluateBitlevel(SecurityModulePeer::LEVEL_ALL,$bitLevelAffiliate);
			}

		}
		return $access;
	}

} // SecurityModulePeer
