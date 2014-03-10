<?php

/**
 * Skeleton subclass for representing a row from the 'users_user' table.
 *
 * Users
 *
 * @package    users
 */
class User extends BaseUser {

	private $passwordString;
	private $passwordUpdatedTime;

	const FIRST_LOGIN = true;

 /**
	* Genera el string a entregar por defecto reemplazando el __toString() del modelo
	*
	*	@return string string texto por defecto a mostar cuando se llama al objeto user
	*/
	public function __toString() {
		$string = '';
		$name = $this->getName();
		$surname = $this->getSurname();

		if (ConfigModule::get("users","toStringFormat") == "Surname, Name (Username)")
			$string .= $surname . ', ' . $name;
		else
			$string .= $name . ' ' . $surname;

		$string .= ' (' . $this->getUserName() . ')';

		return $string;
	}

 /**
	 * Genera la clave encriptada a guardar
	 * @param passwordString string clave ingresada pro usuario.
	 */
	function setPasswordString($passwordString){
		$this->setPassword(Common::md5($passwordString));
	}

 /**
	* Especifica la fecha de actualizacion de la clave
	*/
	function setPasswordUpdatedTime(){
		$this->setPasswordUpdated(time());
	}

 /**
	* Guarda el objecto, validandolo previamente.
	*/
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
	* Obtiene los grupos a los que pertenece un usuario
	*
	* @returns todos los grupos.
	*/
	public function getGroups() {

		$criteria = UserGroupQuery::create()
													->useGroupQuery()
														->orderByName()
													->endUse();
		$allGroups = $this->getUserGroups($criteria);
		return $allGroups;

	}

 /**
	* Indica si un usuario forma parte de un grupo
	*
	* @param array $groups array de grupos
	* @returns true si pertenece al grupo, de lo contrario, false.
	*/
	public function belongsToGroups($groups) {
		$groupsArray = explode(";",$groups);

		$belongs = BaseQuery::create("UserGroup")->filterByUser($this)->filterByGroupid($groupsArray)->find();
		if ($belongs)
			return true;
		else
			return false;
	}

 /**
	* Indica si un usuario forma parte del grupo supervisor
	*
	* @returns true si pertenece al grupo, de lo contrario, false.
	*/
	public function isSupervisor() {
		if ($this->getLevelId() == 1)
			return true;
		$groups = $this->getGroups();
		foreach ($groups as $group){
			if ($group->getGroupId() == 1)
				return true;
		}
		return false;
	}

 /**
	* Indica si un usuario forma parte del grupo admin
	*
	* @returns true si pertenece al grupo, de lo contrario, false.
	*/
	public function isAdmin() {
		if ($this->getLevelId() == 2 || $this->isSupervisor())
			return true;

		$groups = $this->getGroups();
		foreach ($groups as $group) {
			if ($group->getGroupId() == 2)
				return true;
		}
		return false;
	}

 /**
	* Indica si un usuario es un supplier dependiendo si el mismo tiene
	* el nivel de usuario supplier
	*
	* @returns true si es un supplier, false sino.
	*/
	public function isSupplier(){

		$result = false;

		if ($this->getLevelId() == 4)
			$result = true;

		return $result;
	}


 /**
	* Obtiene el valor para permisos de acceso total
	*
	* @returns integer ocn el valor de permisos de acceso total
	*/
	public function getTotalAccess() {
		$userLevel = $this->getLevelId();
		$baseLevel = 1;
		while ($userLevel > 1) {
			$baseLevel += $userLevel;
			$userLevel = $userLevel / 2;
		}
		return $baseLevel;
	}

 /**
	* Genera un hash único a partir de datos del usuario. Y lo almacena junto con la fecha
	* de creación.
	*
	* @return string hash.
	*/
	public function createRecoveryHash() {
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
	public function recoveryRequestAlredyMade() {
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
	public function recoveryRequestIsValid() {
		//se obtiene un objeto DateTime con el momento de la solicitud.
		$recoveryCreatedOn = $this->getRecoveryHashCreatedOn(null);
		if (!empty($recoveryCreatedOn)) {
			$recoveryCreatedOnTimestamp = $recoveryCreatedOn->format('U');
			$elapsedHours = (time() - $recoveryCreatedOnTimestamp) / 3600;
			if( $elapsedHours <= ConfigModule::get('users','passwordHashExpirationTime'))
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
	public function changePassword($password) {
		$this->setPasswordString($password);
		$this->setPasswordUpdatedTime();
		$this->save();
	}

 /**
	* Genera y asigna al usuario una nueva contraseña.
	*
	* @param int $length [optional] Longitud de la contraseña
	* @return mixed string Contraseña o false sino la pudo generar
	*/
	public function resetPassword($length = 8){
		$password = Common::generateRandomPassword();
		$this->setPasswordString($password);
		$this->setPasswordUpdatedTime();
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
	* Devuelve aquellas positions en las que el usuario es funcionario a cargo.
	*/
	public function getPositions() {
		if (class_exists("PositionTenure") && class_exists("Position"))
			return PositionQuery::create()
											->joinPositionTenure()
											->where('PositionTenure', 'PositionTenure.PositionCode = ?', 'Position.Code')
											->filterByObjecttype('User', Criteria::EQUAL)
											->filterByObjectid($this->getId(), Criteria::EQUAL)
											->find();
		else
			return;
	}

 /**
	* Devuelve el nivel del usuario.
	* @return propel Obje Level
	*/
	public function getLevel() {
		return LevelQuery::create()->findOneById($this->getLevelId());
	}


 /**
	* Obtiene el ID de afiliado por compatibilidad ocn otros tipos de usuario
	*
	* @return ID de afiliado, en todos lso casos 0
	*/
	public function getAffiliateId(){
		return 0;
	}

 /**
	* Informo a que modulo pertenece el usuario
	*
	* @return string module Nombre de modulo
	*/
	public function getModule() {
		return "Users";
	}

 /**
	* Activa el usuario
	*/
	public function setActiveUser(){
		$this->setActive('1');
	}

	/**
	* Autentica a un usuario.
	*
	* @param string $username Nombre de usuario
	* @param string $password Contraseña
	* @return User Informacion sobre el usuario, false si no fue exitosa la autenticacion
	*/
	public static function auth($username, $password) {
		$criteria = new Criteria();
		$maintenance = $system["config"]["system"]["parameters"]["underMaintenance"]["value"];
		$user = UserQuery::create()
													->filterByUsername($username)
													->filterById(0, Criteria::GREATER_THAN) //Saco de los posibles resultados al usuario "system" id =-1
													->filterByActive(1)
													->findOne();
		if (!empty($user)) {
			if ($maintenance == "YES" && !$user->isSupervisor())
				return false;
			if ($user->getPassword() == Common::md5($password)) {
				$_SESSION['lastLogin'] = $user->getLastLogin();
				$user->setLastLogin(time());
				$user->setSession(session_id());
				$user->save();
				if (is_null($user->getPasswordUpdated()) && ConfigModule::get("users","forceFirstPasswordChange"))
					$_SESSION['firstLogin'] = User::FIRST_LOGIN;
				else
					unset($_SESSION['firstLogin']);
				return $user;
			}
		}
		return false;
	}

	/**
	 * Verifica la correspondencia entre nombre de usuario y direccion de correo
	 *
	 * @param string $username Nombre de usuario.
	 * @param string $mailAddress Email.
	 * @return mixed Object User el mail del usuario se corresponde, false si no.
	 */

	public static function verifyUsernameAndMail($username, $mailAddress) {
		$user = UserQuery::create()
													->filterByUsername($username)
													->filterByMailaddress($mailAddress)
													->filterById(0, Criteria::GREATER_THAN) //Saco de los posibles resultados al usuario "system" id =-1
													->filterByActive(1)
													->findOne();
		if (!empty($user))
			return $user;
		return false;
	}

 /**
	* Verifica que la sesion sea la correspondiente
	*
	* @return bool true si la sesion se corresponde con el usuario o si no se verifica
	*/
	public function verifySession() {
		$this->reload();
		if ($this->getSession() == session_id())
			return true;
		else {
			if($_SESSION["loginUser"])
				unset($_SESSION["loginUser"]);
			return false;
		}
	}

 /**
	* Activa un usuario a partir del id.
	*
	* @param int $id Id del usuario
	*	@return boolean true si se activo correctamente al usuario, false sino
	*/
	public static function activate($id) {
		$user = UserQuery::create()->findOneById($id);
		if (!empty($user)) {
			$user->setActive(1);
			try {
				$user->save();
				return true;
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
				return false;
			}
		}
		return false;
	}


 /**
	* Obtiene los usuarios que tiene sesion iniciada.
	*
	* @return de usuarios con sesion activa
	*/
	public function getLoggedUsers() {

		return BaseQuery::create("User")
			->filterBySession(null, Criteria::ISNOTNULL)
			->find();

	}

 /**
	* Cuenta los usuarios que tiene sesion iniciada.
	*
	* @return de usuarios con sesion activa
	*/
	public function countLoggedUsers() {

		return BaseQuery::create("User")
			->filterBySession(null, Criteria::ISNOTNULL)
			->count();

	}

 /**
	* Obtiene los usuarios que tiene sesion iniciada.
	*
	* @return de usuarios con sesion activa
	*/
	public function isLoged() {

		if (is_null($this->getSession()))
			return false;
		else
			return true;
	}

 /**
	* Obtiene los usuarios que tiene sesion iniciada.
	*
	* @return de usuarios con sesion activa
	*/
	function hasRecentlyAction() {

		$limit = date('U') + (60 * 60 * $system["config"]["system"]["parameters"]["applicationTimeZoneGMT"]["value"]) - (2 * 60 * 60);

		if ($this->isLoged() && $this->getLastAction('U') < $limit)
			return false;
		else
			return true;
	}
	
 /**
	* Devuelve el string para ser usado en el historico de operaciones
	*	@return string con el texto a guardar en el historico de operaciones
	*/
	public function getLogData(){
		return substr($this->getUsername(),0,50);
	}

 /**
	* Obtiene todos los grupos posibles a elegir
	*
	* @return array grupos posibles a elegir
	*/
	public function getGroupCandidates(){
		$groups = GroupQuery::create()
					 			->select("Id")
								->filterByUser($this)
								->find(); 

		$candidates = GroupQuery::create()
											->filterById($groups, Criteria::NOT_IN)
											->find();
		return $candidates;
	}

 /**
	* Obtiene todos los usuarios desactivados.
	*
	*	@return array Informacion sobre los usuarios
	*/
	public static function getInactives() {
		return BaseQuery::create("User")->filterById(0, Criteria::GREATER_THAN)->filterByActive(0)->find();
	}

 /**
	* Obtiene un array con los tipos de documento de identidad
	*
	*	@return array Tipos de documento
	*/
	public static function getDocumentTypes() {
		$moduleConfig = Common::getModuleConfiguration("users");
		$documentTypes = $moduleConfig['documentTypes'];
		return $documentTypes;
	}

// ---- Deprecated

/* Categories
 *
 */

 /**
	* Return an array with all the categories this user can access
	*
	* @return array of Catetegory
	*/
	function getCategories(){
		if ($this->isAdmin() || $this->isSupervisor())
			return CategoryQuery::create()->find();

		$sql = "SELECT ".CategoryPeer::TABLE_NAME.".* FROM ".UserGroupPeer::TABLE_NAME ." ,".
						GroupCategoryPeer::TABLE_NAME .", ".CategoryPeer::TABLE_NAME .
						" where ".UserGroupPeer::USERID ." = '".$this->getId()."' and ".
						UserGroupPeer::GROUPID ." = ".GroupCategoryPeer::GROUPID ." and ".
						GroupCategoryPeer::CATEGORYID ." = ".CategoryPeer::ID ." and ".
						CategoryPeer::ACTIVE ." = 1";

		$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		$stmt = $con->prepare($sql);
		$stmt->execute();
		return CategoryPeer::populateObjects($stmt);
	}

	/**
	 * Obtiene las categorias padres generales.
	 *
	 * @return array instancias de Category
	 */
	function getDocumentsGeneralParentCategories() {

		//solo se usan las categorias del modulo documentos
		//no se usan generales
		if (!DocumentPeer::usesGlobalCategories())
			return array();

		$criteria = new Criteria();

		$criteria->addJoin(UserGroupPeer::GROUPID,GroupCategoryPeer::GROUPID,Criteria::INNER_JOIN);
		$criteria->addJoin(GroupCategoryPeer::CATEGORYID,CategoryPeer::ID,Criteria::INNER_JOIN);
		$criteria->add(UserGroupPeer::USERID,$this->getId());
		$criteria->add(CategoryPeer::ACTIVE,1);
		$criteria->add(CategoryPeer::PARENTID,0);
		$criteria->add(CategoryPeer::MODULE,'');

		$result = CategoryPeer::doSelect($criteria);
		return $result;

	}

	function getParentsCategories() {
		if ($this->isAdmin() || $this->isSupervisor())
			return CategoryPeer::getAllParentsByModule($module);

		$sql = "SELECT ".CategoryPeer::TABLE_NAME.".* FROM ".UserGroupPeer::TABLE_NAME ." ,".
						GroupCategoryPeer::TABLE_NAME .", ".CategoryPeer::TABLE_NAME .
						" where ".UserGroupPeer::USERID ." = '".$this->getId()."' and ".
						UserGroupPeer::GROUPID ." = ".GroupCategoryPeer::GROUPID ." and ".
						GroupCategoryPeer::CATEGORYID ." = ".CategoryPeer::ID ." and ".
						CategoryPeer::ACTIVE ." = 1" . " and " .
						CategoryPeer::MODULE . " = '$module' and " .
						CategoryPeer::PARENTID . " = 0" ;

		$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		$stmt = $con->prepare($sql);
		$stmt->execute();
		return CategoryPeer::populateObjects($stmt);
	}

	function getDocumentsChildrenCategories($categoryId) {

		if (!class_exists("Category"))
			return;
		$criteria = new Criteria();
		$criteria->add(CategoryPeer::ACTIVE, 1, Criteria::EQUAL);
//		$criteria->add(CategoryPeer::PARENTID, $categoryId, Criteria::EQUAL);
		$criteria->add(CategoryPeer::ISPUBLIC, 1, Criteria::EQUAL);

		if (DocumentPeer::usesGlobalCategories()) {
			//Documentos usa categor�as globales
			$criterion = $criteria->getNewCriterion(CategoryPeer::MODULE,'documents', Criteria::EQUAL);
			$criterion->addOr($criteria->getNewCriterion(CategoryPeer::MODULE, '', Criteria::EQUAL));
			$criteria->add($criterion);
		}
		else
			$criteria->add(CategoryPeer::MODULE,'documents');

		if (DocumentPeer::usesCategoriesGroupPermission()) {
			$criteriOn1 = $criteria->getNewCriterion(CategoryPeer::ISPUBLIC, 1, Criteria::EQUAL);

			$criteria->addJoin(UserGroupPeer::GROUPID,GroupCategoryPeer::GROUPID,Criteria::INNER_JOIN);
			$criteria->addJoin(GroupCategoryPeer::CATEGORYID, CategoryPeer::ID, Criteria::INNER_JOIN);
			$criteria->add(UserGroupPeer::USERID,$this->getId());

			$criteriOn2 = $criteria->getNewCriterion(UserGroupPeer::USERID, $this->getId(), Criteria::EQUAL);
			$criteriOn1->addOr($criteriOn2);
			$criteria->add($criteriOn1);
		}

		$criteria->setDistinct();


		$result = CategoryPeer::doSelect($criteria);
		return $result;
	}

	function getDocumentsParentCategories() {
		return $this->getDocumentsChildrenCategories(0);
	}

	function getCategoriesByModule($module){
		if ($this->isAdmin() || $this->isSupervisor())
			return CategoryPeer::getAllByModule($module);

		$sql = "SELECT ".CategoryPeer::TABLE_NAME.".* FROM ".UserGroupPeer::TABLE_NAME ." ,".
						GroupCategoryPeer::TABLE_NAME .", ".CategoryPeer::TABLE_NAME .
						" where ".UserGroupPeer::USERID ." = '".$this->getId()."' and ".
						UserGroupPeer::GROUPID ." = ".GroupCategoryPeer::GROUPID ." and ".
						GroupCategoryPeer::CATEGORYID ." = ".CategoryPeer::ID ." and ".
						CategoryPeer::ACTIVE ." = 1" . " and " .
						CategoryPeer::MODULE . " = '$module'";

		$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		$stmt = $con->prepare($sql);
		$stmt->execute();
		return CategoryPeer::populateObjects($stmt);
	}

	function getParentCategoriesByModule($module){
		if ($this->isAdmin() || $this->isSupervisor())
			return CategoryPeer::getAllParentsByModule($module);

		$sql = "SELECT ".CategoryPeer::TABLE_NAME.".* FROM ".UserGroupPeer::TABLE_NAME ." ,".
						GroupCategoryPeer::TABLE_NAME .", ".CategoryPeer::TABLE_NAME .
						" where ".UserGroupPeer::USERID ." = '".$this->getId()."' and ".
						UserGroupPeer::GROUPID ." = ".GroupCategoryPeer::GROUPID ." and ".
						GroupCategoryPeer::CATEGORYID ." = ".CategoryPeer::ID ." and ".
						CategoryPeer::ACTIVE ." = 1" . " and " .
						CategoryPeer::PARENTID ." = 0" . " and " .
						CategoryPeer::MODULE . " = '$module'";

		$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		$stmt = $con->prepare($sql);
		$stmt->execute();
		return CategoryPeer::populateObjects($stmt);
	}

	function getChildrenCategories($categoryId) {
		if ($this->isAdmin() || $this->isSupervisor())
			return CategoryPeer::getAllParentsByModule($module);

		$sql = "SELECT ".CategoryPeer::TABLE_NAME.".* FROM ".UserGroupPeer::TABLE_NAME ." ,".
						GroupCategoryPeer::TABLE_NAME .", ".CategoryPeer::TABLE_NAME .
						" where ".UserGroupPeer::USERID ." = '".$this->getId()."' and ".
						UserGroupPeer::GROUPID ." = ".GroupCategoryPeer::GROUPID ." and ".
						GroupCategoryPeer::CATEGORYID ." = ".CategoryPeer::ID ." and ".
						CategoryPeer::ACTIVE ." = 1" . " and " .
						CategoryPeer::PARENTID . " = $categoryId" ;

		$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		$stmt = $con->prepare($sql);
		$stmt->execute();
		return CategoryPeer::populateObjects($stmt);
	}

	function getParentCategories(){
		return $this->getChildrenCategories(0);
	}
 /**
	* Asigna los grupos del usuario a una categoria.
	*
	* @param int $categoryId Id de la categoria
	*/
	function setGroupsToCategory($categoryId) {

		foreach ($this->getGroups() as $group) {

			//verificamos si la relacion no existe
			$exist = BaseQuery::create("GroupCategory")
									->filterByCategoryid($categoryId)
									->filterByGroupid($group->getGroupId())
									->findOne();
			if (empty($exist)) {
				$groupCategory = new GroupCategory();
				$groupCategory->setGroupId($group->getGroupId());
				$groupCategory->setCategoryId($categoryId);
				$groupCategory->save();
			}

		}
		return;
	}


} // User
