<?php

/**
 *
 * @package    users
 */
class UserPeer extends BaseUserPeer {

		//Setea si se eliminan realmente los usuarios de la base de datos o se marcan como no activos
		const DELETEUSERS = false;

	private $searchString;
	private $notInIds;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

	/**
	* Obtiene todos los usuarios.
	*
	*	@return array Informacion sobre todos los usuarios
	*/
	function getAll() {
		$cond = new Criteria();
		$cond->add(UserPeer::ACTIVE, 1);
		$cond->add(UserPeer::ID, 0, Criteria::GREATER_THAN);
		$todosObj = UserPeer::doSelect($cond);
		return $todosObj;
	}

	 /**
	* Obtiene todos los usuarios desactivados.
	*
	*	@return array Informacion sobre los usuarios
	*/
	function getInactives() {
		$cond = new Criteria();
		$cond->add(UserPeer::ACTIVE, 0);
		$todosObj = UserPeer::doSelect($cond);
		return $todosObj;
	}

	 /**
	* Obtiene todos los usuarios desactivados.
	*
	*	@return array Informacion sobre los usuarios
	*/
	function getSoftDeleted()
	{
		$cond = new Criteria();
		$cond->add(UserPeer::DELETED_AT, null, Criteria::ISNOTNULL);
		UserPeer::disableSoftDelete();
		$users = UserPeer::doSelect($cond);
		return $users;
	}

	/**
	* Crea un usuario nuevo.
	*
	* @param string $username Nombre de usuario
	* @param string $name Nombre del usuario
	* @param string $surname Apellido del usuario
	* @param string $pass Contraseña del usuario
	* @param int $levelId Id del nivel de usuarios
	* @param string $mailAddress Email del usuario
	* @return boolean true si se creo el usuario correctamente, false sino
	*/
	function createX($username,$name,$surname,$pass,$levelId,$mailAddress,$timezone){
		try {
			$user = new User();
			$user->setUsername($username);
			$user->setPassword(md5($pass."ASD"));
			$user->setCreated(time());
			$user->setUpdated(time());
			$user->setLevelId($levelId);
			$user->setActive(1);
			$user->setTimezone($timezone);
			$user->save();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return 0;
		}
		return $user->getId();
	}

 /**
	* Crea un usuario nuevo.
	*
	* @param object $object Objeto del cual se va a crear el registro
	* @param array $params con los datos del usuario
	* @param string $con Nombre de la conexion a la base
	* @return int El id del usuario creado
	*/
	function create($object,$params,$con = null){
		foreach ($params as $key => $value){
			$setMethod = "set".$key;
			if ( method_exists($object,$setMethod) ){
				if (!empty($value) || $value == "0")
					$object->$setMethod($value);
				else
					$object->$setMethod(null);
			}
		}
		$object->setPassword(md5($params["pass"]."ASD"));
		$object->setCreated(time());
		$object->setUpdated(time());
		$object->setActive(1);
		try {
			$object->save($con);
			return $object->getId();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un usuario.
	*
	* @param object $object Objeto del cual se va a crear el registro
	* @param array $params con los datos del usuario
	* @param string $con Nombre de la conexion a la base
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($object,$params,$con = null) {
		foreach ($params as $key => $value){
			$setMethod = "set".$key;
			if ( method_exists($object,$setMethod) ){
				if (!empty($value) || $value == "0")
					$object->$setMethod($value);
				else
					$object->$setMethod(null);
			}
		}
		$object->setUpdated(time());
		if (!empty($pass)) {
			$object->setPassword(md5($params["pass"]."ASD"));
			$object->setPasswordUpdated(time());
		}
		try {
			$object->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Obtiene la informacion de un usuario.
	*
	* @param int $id Id del usuario
	* @return array Informacion del usuario
	*/
	function get($id)
	{
		$user = UserPeer::retrieveByPK($id);
		return $user;
	}

	/**
	* Obtiene la informacion de un usuario segun su nombre de usuario
	*
	* @param int $id Id del usuario
	* @return array Informacion del usuario
	*/
	function getByUsername($username) {
		$user = UserQuery::create()->setIgnoreCase(1)->findOneByUsername($username);
		return $user;
	}


	/**
	* Obtiene los grupos de usuarios en los cuales es miembro un usuario.
	*
	* @param int $id Id del usuario
	* @return array Grupos de Usuarios
	*/
	function getGroupsByUser($id) {
		$cond = new Criteria();
		$cond->add(UserGroupPeer::USERID, $id);
		$todosObj = UserGroupPeer::doSelectJoinGroup($cond);
		return $todosObj;
	}

	/**
	* Agrega un usuario a un grupo de usuarios.
	*
	* @param int $user Id del usuario
	* @param int $group Id del grupo de usuarios
	* @return boolean true si se agrego correctamente, false sino
	*/
	function addUserToGroup($user,$group) {
		try {
			$userGroup = new UserGroup();
			$userGroup->setUserId($user);
			$userGroup->setGroupId($group);
			$userGroup->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina un usuario de un grupo de usuarios.
	*
	* @param int $user Id del usuario
	* @param int $group Id del grupo de usuarios
	* @return boolean true si se elimino correctamente, false sino
	*/
	function removeUserFromGroup($user,$group) {
		try {
			$cond = new Criteria();
			$cond->add(UserGroupPeer::USERID, $user);
			$cond->add(UserGroupPeer::GROUPID, $group);
			$userGroup = UserGroupPeer::doSelectOne($cond);
			$userGroup->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un usuario.
	*
	* @param int $id Id del usuario
	* @param string $username Nombre de usuario
	* @param string $name Nombre del usuario
	* @param string $surname Apellido del usuario
	* @param string $pass Contraseña del usuario
	* @param int $levelId Id del nivel de usuarios
	* @param string $mailAddress Email del usuario
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function updateX($id,$username,$name,$surname,$pass,$levelId,$mailAddress,$timezone) {
		try {
			$user = UserPeer::retrieveByPK($id);
			$user->setUsername($username);
			$user->setUpdated(time());
			$user->setLevelId($levelId);
			$user->setTimezone($timezone);
			$user->setName($name);
			$user->setSurname($surname);
			$user->setMailAddress($mailAddress);
			if ( !empty($pass) )
				$user->setPassword(md5($pass."ASD"));
			$user->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un usuario.
	*
	* @param int $id Id del usuario
	* @param string $pass Contraseña del usuario
	* @param int $timezone Zona horaria del usuario
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function updatePass($id,$pass,$mailAddress,$timezone) {
		try {
			$user = UserPeer::retrieveByPK($id);
			$user->setUpdatedAt(time());
			$user->setPasswordUpdated(time());
			$user->setPassword(md5($pass."ASD"));
			$user->setTimezone($timezone);
			$user->setMailAddress($mailAddress);
			$user->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un usuario.
	*
	* @param int $id Id del usuario
	* @param string $pass Contraseña del usuario
	* @param int $timezone Zona horaria del usuario
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function updateMail($id,$mailAddress,$timezone) {
		try {
			$user = UserPeer::retrieveByPK($id);
			$user->setMailAddress($mailAddress);
			$user->setUpdated(time());
			if ( !empty($timezone) )
				$user->setTimezone($timezone);
			$user->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina un usuario a partir del id.
	*
	* @param int $id Id del usuario
	* @return boolean true
	*/
	function softDelete($id) {
		$user = UserPeer::retrieveByPk($id);
		$user->delete();
		return true;
	}

	/**
	* Elimina un usuario a partir del id.
	*
	* @param int $id Id del usuario
	* @return boolean true
	*/
	function hardDelete($id) {
		UserPeer::disableSoftDelete();
		$user = UserPeer::retrieveByPk($id);
		$user->forceDelete();
		return true;
	}

	/**
	* Elimina un usuario a partir del id.
	*
	* @param int $id Id del usuario
	* @return boolean true
	*/
	function recoverDeleted($id) {
		UserPeer::disableSoftDelete();
		$user = UserPeer::retrieveByPk($id);
		$user->unDelete();
		return true;
	}

	/**
	* Elimina un usuario a partir del id.
	*
	* @param int $id Id del usuario
	* @return boolean true
	*/
	function delete($id) {
		$user = UserPeer::retrieveByPk($id);
		if (UserPeer::DELETEUSERS)
			$user->delete();
		else {
			$user->setActive(0);
			$user->save();
		}
		return true;
	}

	/**
	* Elimina un usuario a partir del id.
	*
	* @param int $id Id del usuario
	* @return boolean true
	*/
	function deleteOnCascade($id) {
		UserPeer::disableSoftDelete();
		$cond = new Criteria();
		$cond->add(UserPeer::ID, $id);
		$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		$delete = UserPeer::doOnDeleteCascade($cond,$con);
		$user = UserPeer::retrieveByPk($id);
		$user->forceDelete();
		return true;
	}

	/**
	* Activa un usuario a partir del id.
	*
	* @param int $id Id del usuario
	*	@return boolean true si se activo correctamente al usuario, false sino
	*/
	function activate($id) {
		$user = UserPeer::retrieveByPk($id);
		$user->setActive(1);
		$user->save();
		return true;
	}

	/**
	* Autentica a un usuario.
	*
	* @param string $username Nombre de usuario
	* @param string $password Contraseña
	* @return User Informacion sobre el usuario, false si no fue exitosa la autenticacion
	*/
	function auth($username,$password) {
		$cond = new Criteria();
		$cond->add(UserPeer::USERNAME, $username);
		$cond->add(UserPeer::ACTIVE, "1");
		$user = UserPeer::doSelectOne($cond);
		if (!empty($user)) {
			if ($user->getPassword() == md5($password."ASD")) {
				$_SESSION['lastLogin'] = $user->getLastLogin();
				$user->setLastLogin(time());
				$user->save();
				if (is_null($user->getPasswordUpdated()) && ConfigModule::get("users","forceFirstPasswordChange"))
					$_SESSION['firstLogin'] = "firstLogin";
				else
					unset($_SESSION['firstLogin']);
				return $user;
			}
		}
		return false;
	}

	/**
	 * Authentica un usuario por nombre de usuario y mail.
	 *
	 * @param string $username Nombre de usuario.
	 * @param string $mailAddress Email.
	 * @return User si fue exitosa la autenticacion, false si no.
	 */

	function authenticateByUserAndMail($username, $mailAddress) {
		$criteria = new Criteria();
		$criteria->add(UserPeer::ACTIVE,1);
		$criteria->add(UserPeer::USERNAME,$username);
		$criteria->add(UserPeer::MAILADDRESS,$mailAddress);
		$user = UserPeer::doSelectOne($criteria);
		if (!empty($user))
			return $user;
		return false;
	}


	/**
	* Autentica a un usuario.
	*
	* @param string $username Nombre de usuario
	* @param string $mailAddress Email
	* @return array [0] -> User Informacion sobre el usuario; [1] -> New password, false si no fue exitosa la autenticacion de usuario e email
	*/
	function generatePassword($username,$mailAddress) {
		$cond = new Criteria();
		$cond->add(UserPeer::USERNAME, $username);
		$cond->add(UserPeer::ACTIVE, "1");
		$user = UserPeer::doSelectOne($cond);
		if (!empty($user)) {
			if ($user->getMailAddress() == $mailAddress ) {
				$newPassword = UserPeer::getNewPassword();
				$user->setPassword(md5($newPassword."ASD"));
				$user->save();
				$result = array();
				$result[0] = $user;
				$result[1] = $newPassword;
				return $result;
			}
		}
		return false;
	}

	/**
	* Genera una nueva contraseña.
	*
	* @param int $length [optional] Longitud de la contraseña
	* @return string Contraseña
	*/
	function getNewPassword($length = 8){
		$password = "";
		$possible = "23456789bcdfghjkmnpqrstvwxyz@%";
		$i = 0;
		while ($i < $length) {
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			if (!strstr($password, $char)) {
				$password .= $char;
				$i++;
			}
		}
		return $password;
	}

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		global $system;
		return $system["config"]["system"]["rowsPerPage"];
	}

	/**
	* Obtiene todos los noticias paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los newsarticles
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	UserPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$cond->add(UserPeer::ACTIVE, 1);
		$pager = new PropelPager($cond,"UserPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	 /**
		* Devuelve el usuario con recuperacion de contraseña pendiente que corresponda a partir
		* del hash pasado por parametro, si existe.
		*
		* @param string $recoveryHash hash mediante el cual se realiza la busqueda.
		* @return user usuario correspondiente si existe, false si no.
		*
		*/
	 function getByRecoveryHash($recoveryHash) {
			if (!empty($recoveryHash)){
				$user = UserQuery::create()->findOneByRecoveryHash($recoveryHash);
				if (!empty($user)) {
					return $user;
				} else {
					return false;
				}
		} else {
			return false;
		}
	 }

 /**
	* Obtiene todos los grupos posibles a elegir
	*
	* @param int $id Id del usuario
	* @return array grupos posibles a elegir
	*/
	function getGroupCandidates($id){
		$groups = GroupQuery::create()
 			->select("Id")
			->filterByUser(UserPeer::get($id))
			->find(); 

		$criteria = new Criteria;
		$criteria->add(GroupPeer::ID, $groups, Criteria::NOT_IN);
		$groups = GroupPeer::doSelect($criteria);
		return $groups;
	}

 /**
	 * Retorna el criteria generado a partir de lso parámetros de búsqueda
	 *
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->add(UserPeer::ACTIVE, 1);

		if ($this->searchString) {
			$criteria->add(UserPeer::USERNAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionName = $criteria->getNewCriterion(UserPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionName);
			$criterionSurname = $criteria->getNewCriterion(UserPeer::SURNAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionSurname);
			$criterionEmail = $criteria->getNewCriterion(UserPeer::MAILADDRESS,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionEmail);
		}

		return $criteria;

	}

	/**
	* Obtiene todos los noticias paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los newsarticles
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	UserPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"UserPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Obtiene los tipos de documento
	*	@return array Tipos de documento
	*/
	public function getDocumentTypes() {
		$moduleConfig = Common::getModuleConfiguration("users");
		$documentTypes = $moduleConfig['documentTypes'];
		return $documentTypes;
	}

	/**
	* Obtiene los usuarios candidatos para listados de autocomplete
	*	@return array Usuarios
	*/
	public function getCandidatesList($searchString,$limit) {
		$users = UserQuery::create()->where('User.Username LIKE ?', "%" . $searchString . "%")
									->orWhere('User.Name LIKE ?', "%" . $searchString . "%")
									->orWhere('User.Surname LIKE ?', "%" . $searchString . "%")
									->where('User.Id NOT IN ?', $this->notInIds)
									->limit($limit)
									->find();
		return $users;
	}

	/**
	* Obtiene un array con los ids los usuarios de los candidatos a excluir
	*	@return array Usuarios
	*/
	function setNotInIds($relationEntityQuery,$entityTo,$entityToId) {
		$filterBy = "filterBy" . $entityTo . "id";
		$notInIdsQuery = new $relationEntityQuery();
		$notInIds = $notInIdsQuery->$filterBy($entityToId)
								->select('Objectid')
								->find()
								->toArray();
		$this->notInIds = $notInIds;
	}

}
