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
	
	public function __toString() {
		$string = '';
		$name = $this->getName();
		$surname = $this->getSurname();
		if ( !empty($name) || !empty($surname) )
			$string .= $surname . ', ' . $name . ' - ';
		$string .= '(' . $this->getUserName() . ')';
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
	 * @param passwordUpdatedTime string con fecha de actualizacion de clave.
	 */
	function setPasswordUpdatedTime(){
		$this->setPasswordUpdated(time());
	}

	/*
	 * Guarda el objecto, validandolo previamente. 
	 */
	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) { 
				parent::save($con);
				return true;
			} else
				return false;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/*
	 * Obtiene los grupos a los que pertenece un usuario
	 * @returns todos los grupos.
	 */
	function getGroups() {

		$criteria = UserGroupQuery::create()
													->useGroupQuery()
														->orderByName()
													->endUse();
		$allObjs = $this->getUserGroups($criteria);
		return $allObjs;

	}

	/*
	 * Indica si un usuario forma parte de un grupo
	 * @param array $groups array de grupos
	 * @returns true si pertenece al grupo, de lo contrario, false.
	 */
	function belongsToGroups($groups) {
		$groupsArray = explode(";",$groups);

		$c = new Criteria();
		$c->add(UserGroupPeer::USERID, $this->getId());
		$all = UserGroupPeer::doSelect($c);
		foreach ($all as $userGroup) {
			if (in_array($userGroup->getGroupId(),$groupsArray))
				return true;
		}
		return false;
	}

	/*
	 * Indica si un usuario forma parte del grupo supervisor
	 * @returns true si pertenece al grupo, de lo contrario, false.
	 */
	function isSupervisor() {
		if ( $this->getLevelId() == 1 )
			return true;
		$groups = $this->getGroups();
  	foreach ($groups as $group){
  		if ( $group->getGroupId() == 1 )
  			return true;
  	}
		return false;
	}

	/*
	 * Indica si un usuario forma parte del grupo supervisor
	 * @returns true si pertenece al grupo, de lo contrario, false.
	 */
	function isAdmin() {
		if ( $this->getLevelId() == 2 )
			return true;

  	$groups = $this->getGroups();
  	foreach ($groups as $group) {
  		if ( $group->getGroupId() == 2 )
  			return true;
  	}
		return false;
	}

	/*
	 * Indica si un usuario es un supplier dependiendo si el mismo tiene
	 * el nivel de usuario supplier
	 * @returns true si es un supplier, false sino.
	 */
	function isSupplier(){

		$result = false;

		if ($this->getLevelId() == 4)
			$result = true;

		return $result;
	}


	function getTotalAccess() {
		$userLevel = $this->getLevelId();
		$baseLevel = 1;
		while ($userLevel > 1) {
			$baseLevel += $userLevel;
			$userLevel = $userLevel / 2;
		}
		return $baseLevel;
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
		if (($this->getRecoveryHash() != null) && ($this->recoveryRequestIsValid())) {
			return true;
		} else {
			return false;
		}
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
			if($elapsedHours <= ConfigModule::get('users','passwordRecoveryExpirationTimeInHours')) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
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
	 * Devuelve aquellas positions en las que el usuario es funcionario a cargo.
	 */
	public function getPositions() {
		return PositionQuery::create()->addJoin(PositionTenurePeer::POSITIONCODE, PositionPeer::CODE)
								  	  ->add(PositionTenurePeer::OBJECTTYPE, 'User', Criteria::EQUAL)
								  	  ->add(PositionTenurePeer::OBJECTID, $this->getId(), Criteria::EQUAL)
								  	  ->find();
	}

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
  		return CategoryPeer::getAll();

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

  function getDocumentsChildrenCategories($categoryId) {

		$criteria = new Criteria();
		$criteria->add(CategoryPeer::ACTIVE, 1, Criteria::EQUAL);
		$criteria->add(CategoryPeer::PARENTID, $categoryId, Criteria::EQUAL);
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

  /**
  * Asigna los grupos del usuario a una categoria.
  *
  * @param int $categoryId Id de la categoria
  * @return void
  */
  function setGroupsToCategory($categoryId) {

		foreach ($this->getGroups() as $group) {

			//verificamos si la relacion no existe
			$criteria = new Criteria();
			$criteria->add(GroupCategoryPeer::GROUPID,$group->getGroupId());
			$criteria->add(GroupCategoryPeer::CATEGORYID,$categoryId);
			$result = GroupCategoryPeer::doSelect($criteria);
			if (empty($result)) {
				$groupCategory = new GroupCategory();
				$groupCategory->setGroupId($group->getGroupId());
				$groupCategory->setCategoryId($categoryId);
				$groupCategory->save();
			}

		}
		return;
	}

	function getAffiliateId(){
		return 0;
	}

	/**
	 * Obtiene las categorias padres generales.
	 *
	 * @return array instancias de Category
	 */
	function getDocumentsGeneralParentCategories() {

		//solo se usan las categorias del modulo documentos
		//no se usan generales
		if (!DocumentPeer::usesGlobalCategories()) {
			return array();
		}
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

} // User
