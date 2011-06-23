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
	*
	* Obtiene el nivel de acceso de un modulo
	* @param string $modulename nombre del modulo
	* @return object $obj el objeto encontrado
	*/
	function getAccess($moduleName){
		$cond = new Criteria();
		$cond->add(SecurityModulePeer::MODULE, $moduleName);
		$obj = SecurityModulePeer::doSelectOne($cond);
		return $obj;
	}

	/**
	* Limpia el acceso de un determinado modulo
	* @param string $module con el nombre del modulo a limpiar
	* @param string $baseLevel nivel base
	*/
  function clearAccess($module,$baseLevel) {
		$obj = new securityModule();
		$obj = SecurityModulePeer::retrieveByPK($module);
		$obj->setAccess($baseLevel);
		$obj->save();
		return true;
  }

	/**
	* Actualiza los modules en la base de datos
	* @param string $moduleName nombre del modulo
	* @param int $access con el numero de acceso que tendrá el modulo
	* @return true si todo está ok
	*/
	function setNewAccess($moduleName,$access) {
		$obj = new SecurityModule();
		$obj = SecurityModulePeer::retrieveByPK($moduleName);
		$obj->setAccess($access);
		$obj->save();
		return true;
	}

  /**
	* Agrega un modulo y su accesso
	* @param string $moduleName nombre del modulo
	* @param int $access acceso del modulo
	* @return true si salio todo ok
	*/
	function addModule($moduleName,$access) {
		$obj = new SecurityModule();
		$obj->setModule($moduleName);
		$obj ->setAccess($access);
		$obj ->save();
		return true;
	}

	/**
	*	Toma un modulo
	*	@param string $moduleName nombre del modulo
	*	@return object $module nombre del modulo seleccionado
	*/
	function get($moduleName) {
		$securityModule = SecurityModuleQuery::create()->setIgnoreCase('true')->findOneByModule($moduleName);
		return $securityModule;
	}

	/**
	*	Toma el acceso de un modulo
	*	@param string $moduleName nombre del modulo
	*	@return string $obj el acceso del modulo
	*/
	function getAccessByModule($moduleName) {
		$securityModule = SecurityModuleQuery::create()->setIgnoreCase('true')->findOneByModule($moduleName);
		return $securityModule;
	}

} // SecurityModulePeer
