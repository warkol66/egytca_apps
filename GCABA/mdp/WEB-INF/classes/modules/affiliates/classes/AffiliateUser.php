<?php



/**
 * Skeleton subclass for representing a row from the 'affiliates_user' table.
 *
 * Usuarios de afiliado
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateUser extends BaseAffiliateUser {

	private $passwordString;
	private $passwordUpdatedTime;

	/**
	* Genera el string a entregar por defecto reemplazando el __toString() del modelo
	*
	*	@return string string texto por defecto a mostar cuando se llama al objeto affiliateUser
	*/
	public function __toString() {
		$string = '';
		$name = $this->getName();
		$surname = $this->getSurname();

		if (ConfigModule::get("affiliates","toStringFormat") == "Surname, Name (Username)")
			$string .= $surname . ', ' . $name;
		else
			$string .= $name . ', ' . $surname;

		$string .= ' (' . $this->getUserName() . ')';

		return $string;
	}

	function getGroups() {
		return AffiliateGroupQuery::create()->filterByAffiliateUser($this)->find();
	}

	function getNotAssignedGroups() {
		$id = $this->getId();
		if (empty($id))
			return new PropelObjectCollection;
		$obj = AffiliateGroupQuery::create()->join('AffiliateUserGroup', Criteria::LEFT_JOIN)
										->where('AffiliateUserGroup.Userid <> ?', $id)
										->orWhere('AffiliateUserGroup.Userid IS NULL')
										->find();
		return $obj;
	}

 /**
	* Return an array with all the categories this user can access
	*
	* @return array of Catetegory
	*/
	function getCategories(){
		return CategoryQuery::create()->join('AffiliateGroupCategory')
									->join('AffiliateGroupCategory.AffiliateUserGroup')
									->join('AffiliateUserGroup.AffiliateUser')
									->useQuery('AffiliateUser')
										->filterByPrimaryKey($this->getPrimaryKey())
									->endUse()
									->find();
	}

	/**
	* Asigna los grupos del usuario a una categoria.
	*
	* @param int $categoryId Id de la categoria
	* @return void
	*/
	function setGroupsToCategory($categoryId) {
		foreach ($this->getGroups() as $group) {
			$groupCategory = new AffiliateGroupCategory();
			$groupCategory->setGroupId($group->getGroupId());
			$groupCategory->setCategoryId($categoryId);
			$groupCategory->save();
		}
		return;
	}

	/**
	 * Informa si un usuario es owner del affiliate relacionado al usuario
	 * @param $user obj objeto propel user
	 * @return bool true si es owner false si no.
	 */
	public function isOwner($user) {
		$affiliate = $this->getAffiliate();
		if ($affiliate->isOwner($user))
			return true;
		else
			return false;
	}

	function getAll() {
		return AffiliateUserQuery::create()->find();
	}

	/**
	* Obtiene el nombre del afiliado
	*
	* @return string Nombre del afiliado
	*/
	function getAffiliate() {
		$affiliate = $this->getAffiliateRelatedByAffiliateid();
		if (!empty($affiliate))
			return $affiliate;
		else
			return new Affiliate();
	}

	/**
	* Determina si el usuario es owner de un afiliado
	*
	* @return true o false
	*/
	function isAffiliateOwner() {
		$affiliate = $this->getAffiliate();
		if ($affiliate->getOwnerId() == $this->getId())
			return true;
		else
			return false;
	}

	/**
	 * Redefinimos para que se pase a minusculas el username.
	 */
	public function setUserName($username) {
		$usernameLowercase = strtolower($username);
		parent::setUserName($usernameLowercase);
		return $this;
	}

	/**
	 * Especifica la fecha de actualizacion de la clave
	 * @param passwordUpdatedTime string con fecha de actualizacion de clave.
	 */
	function setPasswordUpdatedTime(){
		$this->setPasswordUpdated(time());
	}

	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) {
				parent::save($con);
				return true;
			}
			else
				return false;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	 * Genera un hash para único a partir de datos del usuario. Y lo almacena junto con la fecha
	 * de creación.
	 *
	 * @return string hash.
	 */
	function createRecoveryHash() {
		$currentTime = time();
		$unencryptedString = $this->getId() . $this->getUserName() . $currentTime . mt_rand(0, 100);
		$recoveryHash = md5($unencryptedString);
		$this->setRecoveryhashcreatedon($currentTime);
		$this->setRecoveryhash($recoveryHash);
		$this->save();
		return $recoveryHash;
	}

	/**
	 * Indica si el usuario ya tiene una peticion de recuperacion de contraseña pendiente de confirmacion.
	 *
	 * @return bool verdadero si el usuario ya tiene una peticion de recuperacion de contraseña pendiente de confirmacion.
	 */
	function recoveryRequestAlredyMade() {
		if (($this->getRecoveryHash() != null) && ($this->recoveryRequestIsValid()))
			return true;
		else
			return false;

	}

	/**
	 * Chequea si el tiempo transcurrido desde la petición de recuperacion de contraseña es
	 * valido según los parametros configurados en el systema.
	 *
	 * @return bool true si el timpo transcurrido es válido, false si no.
	 */
	function recoveryRequestIsValid() {
		//se obtiene un objeto DateTime con el momento de la solicitud.
		$recoveryCreatedOn = $this->getRecoveryHashCreatedOn(null);
		if (!empty($recoveryCreatedOn)) {
			$recoveryCreatedOnTimestamp = $recoveryCreatedOn->format('U');
			$elapsedHours = (time() - $recoveryCreatedOnTimestamp) / 3600;
			if($elapsedHours <= ConfigModule::get('affiliates','passwordHashExpirationTime'))
				return true;
			else
				return false;
		}
		else
			return false;
	}

	/**
	 * Cambia la contraseña del usuario por la pasada por parametro (encriptada).
	 *
	 * @param string $password contraseña nueva
	 */
	function changePassword($password) {
		$this->setPasswordString($password);
		$this->setPasswordUpdatedTime(time());
		$this->save();
	}

	/**
		* Genera una nueva contraseña.
		*
		* @param int $length [optional] Longitud de la contraseña
		* @return string Contraseña
		*/
	function resetPassword($length = 8){
		$password = Common::generateRandomPassword();
		$this->setPasswordString($password);
		$this->setPasswordUpdatedTime(time());
		try {
			$this->save();
			return $password;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Genera la clave encriptada a guardar
	 * @param passwordString string clave ingresada pro usuario.
	 */
	function setPasswordString($passwordString){
		$this->setPassword(Common::md5($passwordString));
	}

	/*
	 * Se agrega al AffiliateUser por compatibilidad con el User
	 * @returns false siempre.
	 */
	function isSupervisor() {
		return false;
	}

	/*
	 * Se agrega al AffiliateUser por compatibilidad con el User
	 * @returns false siempre.
	 */
	function isAdmin() {
		return false;
	}

	/**
	 * Informo a que modulo pertenece el usuario
	 * @return string module Nombre de modulo
	 */
	function getModule() {
		return "Affiliates";
	}

	/**
	 * Obtengo el nivel del usuario por afiliado para usar el mismo nombre de metodo que el usuario de sistema
	 * @return object AffiliateLevel
	 */
	function getLevel() {
		return $this->getAffiliateLevel();
	}


} // AffiliateUser
