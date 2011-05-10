<?php

  // include base peer class
  require_once 'security/classes/om/BaseSecurityAction.php';

/**
 * Skeleton subclass for representing a row from the 'SecurityAction' table.
 *
 * Actions del sistema
 *
 * @package security
 */	
class SecurityAction extends BaseSecurityAction {

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

	/**
	*
	* Obtiene la etiqueta de ese Action
	*
	* @return string label la etiqueta
	*/
	
	function getLabel(){
		$language = Common::getCurrentLanguageCode();
		include_once 'SecurityActionLabelPeer.php';
		try{
			$actionLabel = SecurityActionLabelPeer::getByActionAndLanguage($this->getAction(),$language);
			if (!empty($actionLabel))
				return $actionLabel->getLabel();
			else
				return $this->getAction();
		}
		catch (PropelException $e) {}
	}
	
	/**
	*
	* Obtiene la informacion de ese Action por codigo de lenguaje.
	*
	* @return SecurityActionLabel informacion de lenguaje.
	*/
	
	function getActionInfo($languageCode = NULL){
		if ($languageCode != NULL) {
			$language = $languageCode;
		} else {
			$language = Common::getCurrentLanguageCode();
		}
		try{
			$actionLabel = SecurityActionLabelPeer::getByActionAndLanguage($this->getAction(),$language);
			return $actionLabel;
		}
		catch (PropelException $e) { return NULL; }
	}


	/**
	 * Obtiene el SQL Insert Correspondiente a la tabla con los datos de la instancia
	 *
	 *
	 */
	function getSQLInsert() {
	
		$action = $this->getAction();
		$module = $this->getModule();
		$section = $this->getSection();
		$access = $this->getAccess();
		$accessAffiliateUser = $this->getAccessAffiliateUser();
		$active = $this->getActive();
		$pair = $this->getPair();
		$noCheckLogin = $this->getNoCheckLogin();
		$accessRegistrationUser = $this->getAccessRegistrationUser();
	
		$query = "INSERT INTO `security_action` (`action`,`module`,`section`,`access`,`accessAffiliateUser`, `active` , `pair` , `noCheckLogin`, `accessRegistrationUser` ) VALUES ('$action','$module','$section','$access','$accessAffiliateUser','$active','$pair','$noCheckLogin','$accessRegistrationUser' );";
		return $query;
		
	}


	/**
	 * genera el codigo SQL de limpieza de las tablas afectadas al modulo.
	 * @return string SQL
	 */	
	function getSQLCleanup() {

		$sql = "DELETE FROM `security_action` WHERE `module` = " . "'" . $this->getModule() . "'" . ';';
		return  $sql;
		
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
	 * Obtiene los permisos en base al tipo de usuario
	 * @return int $access bit level de permisos de la acci�n
	 */
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

	/**
	 * Obtiene los permisos en base al tipo de usuario
	 * @return int $access bit level de permisos de la acci�n
	 */
	function getAccessByUserType($user) {
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

	/**
	 * Obtiene .....
	 * @return 
	 */
	function getFullAccessByUser($user) {
		
		$noCheckLoginAction = $this->getNoCheckLogin();
		
		//Si es un action que no chequea login, el nivel de acceso del action es 1 en cada bit
		if ($noCheckLoginAction)
			return SecurityActionPeer::LEVEL_ALL;
		
		$access = $this->getAccessByUserType($user);
				
		//Si el access del action es 0 significa que herada los permisos de su modulo
		if ($access == 0) {
			$actualModule = $this->getSecurityModule();
			$access = $actualModule->getAccessByUserType($user);				
		}		
		return $access;
	}
	
	/**
	 * Indica si un suario tiene acceso a una acci�n determinada
	 * @return boolean  (true tiene acceso, false no lo tiene)
	 */
	function hasAccess($user) {
		$access = $this->getFullAccessByUser($user);
		$level = $user->getLevel();

		if ( empty($level) || ($level->getBitLevel() & $access) == 0 )
			return false;
		else 
			return true;
	}

	/**
	 * Indica si una acci�n no verifica login
	 * @return int (1 si no requiere login)
	 */
	function getOverallNoCheckLogin() {
		$noCheckLogin = 0;
		if ($this->getActive() != 0)
			if ($this->getNoCheckLogin() == 1) 
				$noCheckLogin = 1;
		else {
			$securityModule = $this->getSecurityModule();
			if ($securityModule->getNoCheckLogin() == 1)
				$noCheckLogin = 1;
		}
		return $noCheckLogin;	
	}

	/**
	 * Indica si una acci�n no verifica login
	 * @return int (1 si no requiere login)
	 */
	function getActionNoCheckLogin() {
		$noCheckLogin = 0;
		if ($this->getActive() == 1)
			if ($this->getNoCheckLogin() == 1) 
				$noCheckLogin = 1;
		return $noCheckLogin;	
	}

} // SecurityAction
