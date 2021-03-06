<?php

/**
 * Skeleton subclass for performing query and update operations on the 'SecurityAction' table.
 *
 * Actions del sistema
 *
 * @package    security
 */
class SecurityActionPeer extends BaseSecurityActionPeer {

	const LEVEL_ALL = 1073741823;

	/**
	* Obtiene todos los actions cargados en la base de datos
	*
	* @return array con los actions cargados
	*/
	function getAll() {
		return SecurityActionQuery::create()->find();
	}

	/**
	* Obtiene todos los actions cargados en la base de datos por permiso para el bitlevel
	*
	* @param int $bitLevel Bit Level
	* @return array Actions
	*/
	function getAllByBitLevel($bitLevel) {
		$allActions = SecurityActionPeer::getAll();
		return SecurityActionPeer::getOnlyActionsWithAccess($allActions,$bitLevel);
	}

	/**
	* Obtiene todos los actions cargados en la base de datos por permiso para el bitlevelAffiliateUser
	*
	* @param int $bitLevel Bit Level
	* @return array Actions
	*/
	function getAllByBitLevelAffiliateUser($bitLevel) {
		$allActions = SecurityActionPeer::getAll();
		return SecurityActionPeer::getOnlyActionsWithAccess($allActions,$bitLevel);
	}

	/**
	* Obtiene todos los actions cargados en la DB con acceso
	*
	* @param stringg $allActions todos los actions
	* @param int $bitLevel Bit Level
	* @return array Actions
	*/
	function getOnlyActionsWithAccess($allActions,$bitLevel) {
		$actions = array();
		foreach ($allActions as $action) {
			if (($action->getAccess() & $bitLevel) > 0)
				$actions[] = $action;
		}
		return $actions;
	}

	/**
	* Obtiene todos los actions cargados en la DB con acceso para users by affiliate
	*
	* @param stringg $allActions todos los actions
	* @param int $bitLevel Bit Level
	* @return array Actions
	*/
	function getOnlyActionsWithAccessAffiliateUser($allActions,$bitLevel) {
		$actions = array();
		foreach ($allActions as $action) {
			if (($action->getAccessAffiliateUser() & $bitLevel) > 0)
				$actions[] = $action;
		}
		return $actions;
	}

	/**
	* elimina un action
	* @param string $action nombre del action
	* @return true
	*/
	function delete($action){
		try{
			$obj = SecurityActionPeer::retrieveByPK($action);
			if(!empty($obj))
				$obj->delete();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return 0;
		}
		return true;
	}

	/**
	* Limpia el acceso de un determinado action
	*
	* @param string $action con el nombre del action a limpiar
	*/
	function clearAccess($action,$baseLevel) {
		$securityAction = SecurityActionPeer::retrieveByPK($action);
		$securityAction->setAccess($baseLevel);
		$securityAction->save();
		return;
	}

	/**
	* Limpia el acceso AffiliateUser de un determinado action
	*
	* @param string $action con el nombre del action a limpiar
	*/
	function clearAccessAffiliateUser($action,$baseLevel) {
		$securityAction = SecurityActionPeer::retrieveByPK($action);
		$securityAction->setAccessAffiliateUser($baseLevel);
		$securityAction->save();
		return;
	}

	/**
	*  Guarda actions en la base de datos
	*
	* @param string $action con el nombre del action
	* @param string $modulo con el nombre del modulo al cual pertenece el action
	* @param int $access con el numero de acceso que tendrá el action
	* @return true si todo está ok
	*/
	function addAction($action,$module,$access) {
		try{
			$security = new securityAction();
			$security->setAction($action);
			$security->setModule($module);
			$security->setSection(1);
			$security->setAccess($access);
			$security->setAccessAffiliateUser($access);
			$security->save();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return 0;
		}
		return;
	}

	/**
	*  Guarda un action con su par en la base de datos
	*
	* @param string $action con el nombre del action
	* @param string $modulo con el nombre del modulo al cual pertenece el action
	* @param int $access con el numero de acceso que tendrá el action
	* @param string $pair Nombre del par
	* @return true si todo está ok
	*/
	function addActionWithPair($action,$modulo,$access,$pair=null,$labels) {
		try{
			$security = new securityAction();
			$security->setAction($action);
			$security->setModule($modulo);
			if ($pair)
				$security->setPair($pair);
			$security->setSection(1);
			$security->setAccess($access);
			$security->setActive(1);
			$security->setAccessAffiliateUser($access);
			$security->save();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return 0;
		}

		foreach ($labels as $language => $label){
			$securityLabelPeer = new SecurityActionLabel();
			$securityLabelPeer->setAction($action);
			$securityLabelPeer->setLanguage($language);
			$securityLabelPeer->setLabel($label);
			$securityLabelPeer->save();
		}
		return true;
	}

	/**
	* Actualiza los actions en la base de datos
	*
	* @param string $action con el nombre del action
	* @param int $access con el numero de acceso que tendrá el action
	* @return true si todo está ok
	*/
	function setNewAccess($action,$access) {
		$securityAction = SecurityActionPeer::retrieveByPK($action);
		$securityAction->setAccess($access);
		$securityAction->save();
		return;
	}

	/**
	* Actualiza el action con el acceso AffiliateUser
	*
	* @param string $action con el nombre del action
	* @param int $access con el numero de acceso que tendrá el action
	* @return true si todo está ok
	*/
	function setNewAccessAffiliateUser($action,$access) {
		$securityAction = SecurityActionPeer::retrieveByPK($action);
		$securityAction->setAccessAffiliateUser($access);
		$securityAction->save();
		return;
	}

	/**
	* obtiene un action
	* @param string $action nombre del action
	* @return object $obj action encontrado
	*/
	function get($action) {
		$securityAction = SecurityActionPeer::retrieveByPK($action);
		return $securityAction;
	}

	/**
	* Obtiene un action a partir de su nombre o del par
	* @param string $action nombre del action
	* @return object $obj action encontrado
	*/
	function getByNameOrPair($action) {
		$securityAction = SecurityActionQuery::create()
												->setIgnoreCase('true')
												->filterByAction($action)
													->_or()
												->filterByPair($action)
												->findOne();
		return $securityAction;
	}

	/**
	* obtengo todos los actions de un modulo
	* @param string $module nombre del modulo
	* @return object $obj actions encontrados
	*/
	function getAllByModule($module) {
		return SecurityActionQuery::create()->setIgnoreCase('true')->filterByModule()->find();
	}

	/**
	* obtengo todos los actions de un modulo que chequean login
	* @param string $module nombre del modulo
	* @return object $obj actions encontrados
	*/
	function getAllByModuleCheckingLogin($module) {
		$criteria = new Criteria();
		$criteria->setIgnoreCase();
		$criteria->add(SecurityActionPeer::MODULE, $module);
		$criteria->add(SecurityActionPeer::NOCHECKLOGIN, false);
		$obj = SecurityActionPeer::doSelect($criteria);
		return $obj;
	}

	/**
	* obtengo todos los actions de un modulo, dependiendo el nivel para users by affiliate, sin los action que no chequean login
	* @param string $module nombre del modulo
	* @param int $bitLevel  nivel
	* @return object $obj actions encontrados
	*/
	function getAllByModuleAndBitLevelAffiliateUser($module,$bitLevel) {
		$allActions = SecurityActionPeer::getAllByModuleCheckingLogin($module);
		return SecurityActionPeer::getOnlyActionsWithAccessAffiliateUser($allActions,$bitLevel);
	}

	/**
	* obtengo todos los actions de un modulo, dependiendo el nivel, sin los action que no chequean login
	* @param string $module nombre del modulo
	* @param int $bitLevel  nivel
	* @return object $obj actions encontrados
	*/
	function getAllByModuleAndBitLevel($module,$bitLevel) {
		$allActions = SecurityActionPeer::getAllByModuleCheckingLogin($module);
		return SecurityActionPeer::getOnlyActionsWithAccess($allActions,$bitLevel);
	}

	/**
	* obtengo todos los actions de un modulo, dependiendo el nivel
	* @param string $module nombre del modulo
	* @param int $bitLevel  nivel
	* @return object $obj actions encontrados
	*/
	function getAllByModuleAndBitLevelAll($module,$bitLevel) {
		$allActions = SecurityActionPeer::getAllByModule($module);
		return SecurityActionPeer::getOnlyActionsWithAccess($allActions,$bitLevel);
	}

	/**
	* Verifico si un action está o no
	* @param string $action nombre del action
	* @return true si se encuentra
	*/
	function getAllByAction($action) {
		$criteria = new Criteria();
		$criteria->setIgnoreCase();
		$criteria->add(SecurityActionPeer::ACTION, $action);
		if ($obj = SecurityActionPeer::doSelect($criteria))
			return true;
		else
			return false;
	}

	/**
	* Obtiene un action a partir de su par
	* @param string $pair nombre del action par
	* @return object $obj si lo encontró
	*/
	function getByPair($pair) {
		$criteria = new Criteria();
		$criteria->setIgnoreCase();
		$criteria->add(SecurityActionPeer::PAIR, $pair);
		$objs = SecurityActionPeer::doSelectOne($criteria);
		if (!empty($objs))
			return $objs;
		else
			return false;
	}

	/**
	* Obtiene todos los nombres de modulos (1 sola vez por nombre)
	* @return array $result los modulos encontrados
	*/
	function getModules() {

		$criteria = new Criteria();
		$criteria->clearSelectColumns()->addSelectColumn(SecurityActionPeer::MODULE);
		$criteria->setDistinct(MODULE);
		 $rs = BasePeer::doSelect($criteria);
		 $result = array();
		 while($res = $rs->fetch()) {
		 $result[] = $res['MODULE'];
		 }
		 return $result;
	 }

	/**
	* checkea el permiso de un usuario al modulo de un action
	* @param array $user niveles de acceso del usuario
	* @param string $action nombre del action
	* @return true si todo salio ok
	*/
	function checkAccess($user,$action){

		//////////
		// obtengo el nombre del modulo a tratar
		$module=SecurityActionPeer::getModuleByAction($action);

		//////////
		// obtengo el nivel al modulo segun tipo de usuario
		// user['type'] cotiene el tipo de usuario, donde 0 es user,
		// 999999 es user by registration y cualquier otro es user by affiliate

		if ( $user['userType']== 999999 )
			$moduleLevel=4;
		else if ($user['userType']== 0 )
			$moduleLevel=1;
		else
			$moduleLevel=2;

		//////////
		// Obtengo el acceso al modulo
		include_once 'SecurityModulePeer.php';
		$securityModule=SecurityModulePeer::getAccessByModule($module);

		//////////
		// comparo accesos bit a bit
		$access=SecurityActionPeer::checkAccessBitToBit($moduleLevel,$securityModule);

		//////////
		// comprobacion Modulo: retorno falso si el tipo de usuario no puede entrar al modulo
		if ($access == 0) return false;

		//////////
		// Obtengo action y su nivel de acceso
		$actionProperties = SecurityActionPeer::get($action);
		$actionAccess=$actionProperties->getAccess();

		//////////
		// comprobacion Modulo: retorno falso si el nivel de usuario no es suficiente para acceder al action
		if ( ($user['levelId'] & $actionAccess) == 0 )
			return false;


		return true;
	}


	/**
	* obtiene el nombre del modulo de un action
	* @param string $action nombre del action
	* @return string $module nombre del modulo del action
	*/
	function getModuleByAction($action) {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->add(SecurityActionPeer::ACTION, $action);
		$obj = SecurityActionPeer::doSelectOne($criteria);
		return $obj->getModule();
	}

	/**
	 * Compara 2 numberos bit a bit
	 * @param int $paramUser bit del usuario
	 * @param int $paramModule bit del modulo
	 * @return 1 si un numero se incluye en otro
	 */
	function checkAccessBitToBit($paramUser,$paramModule) {
		if ((intval($paramModule) & intval($paramUser)) > 0 )
			return 1;
		else
			return 0;
	}

	/**
	* obtiene el nivel de usuario y el id de afiliado de dicho usuario
	* @return array $info informacion encontrada
	*/
	function userInfoToSecurity() {
		$info = array();
		if (!empty($_SESSION['loginUser'])){
			$info["levelId"] = $_SESSION['loginUser'];
			$info["userType"] = 0;
			if (is_object($info["levelId"]))
				$info["levelId"] = $info["levelId"]->getLevelId();
		}
		else if (!empty($_SESSION['loginRegistrationUser'])){
			$info["levelId"] = $_SESSION['loginRegistrationUser'];
			$info["userType"] =999999 ;
		}
		else {
			if(is_object($_SESSION["loginAffiliateUser"])){
				$info["levelId"]=$_SESSION["loginAffiliateUser"]->getLevelId();
				$info["userType"]=$_SESSION["loginAffiliateUser"]->getAffiliateId();
			}
			// version sin propel toma esta linea
			else
				$info["levelId"]=$_SESSION["loginAffiliateUser"];
		}
		return $info;
	}

	/**
	 * Obtiene un array con todas las acciones a las que se tiene permiso
	 * @return array de acciones
	 */
	function getAccessToActions($actions) {
		$access = array();

		foreach ($actions as $action) {
			$lcAction = lcfirst($action);
			$securityAction = SecurityActionPeer::getByNameOrPair($lcAction);
			if (!empty($securityAction)) {
	
				$access[$action] = array();
				$access[$action]['noCheckLogin'] = $securityAction->getNoCheckLogin();
	
				$bitLevel = $securityAction->getAccess();
				if ($bitLevel == SecurityModulePeer::LEVEL_ALL) {
					$access[$action]['bitLevel'] = 0;
					$access[$action]['all'] = 1;
				}
				else
					$access[$action]['bitLevel'] = $bitLevel;
				// end User

				if (class_exists("AffiliateLevelPeer")) {
					$bitLevelAffiliate = $securityAction->getAccessAffiliateUser();
					if ($bitLevelAffiliate == SecurityModulePeer::LEVEL_ALL) {
						$access[$action]['bitLevelAffiliate'] = 0;
						$access[$action]['affiliateAll'] = 1;
					}
					else
						$access[$action]['bitLevelAffiliate'] = $bitLevelAffiliate;
				} // end AffiliateUser

				if (class_exists("RegistrationUser"))
					$access[$action]['permissionRegistration'] = $securityAction->getAccessRegistrationUser();
 				// end RegistrationUser

				if (class_exists("ClientUserPeer")) {
					$bitLevelClient = $securityAction->getAccessClientUser();
					if ($bitLevelAffiliate == SecurityModulePeer::LEVEL_ALL) {
						$access[$action]['bitLevelClient'] = 0;
						$access[$action]['clientAll'] = 1;
					}
					else
						$access[$action]['bitLevelClient'] = $bitLevelClient;
				} // end ClientUser

			}
		}
		return $access;
	}

	/**
	 * genera el codigo SQL de limpieza de las tablas afectadas al modulo.
	 * @return string SQL
	 */
	function getSQLCleanup($module) {
		$sql = "DELETE FROM `security_action` WHERE `module` = '" . $module . "';\n";
		$sql .= "OPTIMIZE TABLE `security_action`;";
		return  $sql;
	}

} // SecurityActionPeer
