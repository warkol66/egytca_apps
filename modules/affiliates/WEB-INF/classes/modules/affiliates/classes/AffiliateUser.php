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



	function getAll() {
		return AffiliateUserQuery::create()->find();
	}

	/**
	* Obtiene el nombre del afiliado
	*
	* @return string Nombre del afiliado
	*/
	function getAffiliate() {
		$affiliateId = $this->getAffiliateId();
		$affiliate = AffiliateQuery::create()->findPk($affiliateId);
		if($affiliate)
			return $affiliate->getName();
		else
			return;
	}

	/**
	* Determina si el usuario es owner de un afiliado
	*
	* @return true o false
	*/
	function isAffiliateOwner() {
		$affiliateId = $this->getAffiliateId();
		$affiliate = AffiliateQuery::create()->findPk($affiliateId);
		if ($affiliate->getOwnerId() == $this->getId())
			return true;
		else
			return false;
	}

	/**
	* Devuelve el nombre dle afiliado
	*
	* @return string con nombre del afiliado
	*/
	function getAffiliateName() {
		$affiliateId = $this->getAffiliateId();
		$affiliate = AffiliateQuery::create()->findPk($affiliateId);
		if ($affiliate)
			return $affiliate->getName();
		else
			return;
	}

	/**
	 * Redefinimos para que se pase a minusculas el username.
	 */
	public function setUserName($username) {
		$usernameLowercase = strtolower($username);
		parent::setUserName($usernameLowercase);
		return $this;
	}

	public function setPassword($password) {
		if(!empty($password)){
			parent::setPassword(md5($password."ASD"));
			$this->setPasswordUpdatedTime(time());
		}
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
			if($elapsedHours <= ConfigModule::get('affiliates','passwordRecoveryExpirationTimeInHours'))
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
		$this->setPassword($password);
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
		$this->setPassword($password);
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

} // AffiliateUser
