<?php



/**
 * Skeleton subclass for performing query and update operations on the 'clients_user' table.
 *
 * Usuarios de cliente
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.clients.classes
 */
class ClientUserPeer extends BaseClientUserPeer {

	//Setea si se eliminan realmente los usuarios de la base de datos o se usa soft delete
	const DELETEUSERS = false;
	
	private $searchClientId;
	
	
	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchClientId"=>"setSearchClientId",
	);
	
	public function setSearchClientId($clientId) {
		$this->searchClientId = $clientId;
	}

	function getByClientId($clientId) {
		return ClientUserQuery::create()->findByClientId($clientId);
	}

	/**
	* Obtiene todos los usuarios por cliente.
	*
	*	@return array Informacion sobre todos los usuarios
	*/
	function getAll() {
		return ClientUserQuery::create()->find();
	}

	/**
	* Obtiene todos los usuarios desactivados.
	*
	*	@return array Informacion sobre los usuarios
	*/
	function getDeleteds() {
		ClientUserQuery::disableSoftDelete();
		return ClientUserQuery::create()->filterByDeletedAt(null, Criteria::ISNOTNULL)
					 ->find();
	}

	/**
	* Obtiene todos los usuarios desactivados.
	*
	* @param int $clientId Id del cliente
	*	@return array Informacion sobre los usuarios
	*/
	function getDeletedsByClient($clientId) {
		ClientUserQuery::disableSoftDelete();
		return ClientUserQuery::create()->filterByClientId($clientId)
					 ->filterByDeletedAt(null, Criteria::ISNOTNULL)
					 ->find();
	}

	/*
	* Verifica si ya existe un usuario con ese nombre de usuario
	* @param string $username nombre de usuario
	* @return boolean true si el nombre de usuario existe, false sino.
	*/
	function usernameExists($username) {
		$usernameLowercase = strtolower($username);
		return ClientUserQuery::create()->filterByUserName($usernameLowercase)->count() > 0;
	}


	/**
	* Crea un usuario nuevo por cliente.
	*
	* @param string $username Nombre de usuario
	* @param string $name Nombre del usuario
	* @param string $surname Apellido del usuario
	* @param string $pass Contrase?a del usuario
	* @param int $levelId Id del nivel de usuarios
	* @param string $mailAddress Email del usuario
	* @return boolean true si se creo el usuario correctamente, false sino
	*/
	function create($params) {
		$userByClient = new ClientUser();
		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($userByClient,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$userByClient->$setMethod($value);
				else
					$userByClient->$setMethod(null);
			}
		}
		try {
			$userByClient->save($con);
			return $userByClient;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}


	/**
	* Autentica a un usuario por cliente.
	*
	* @param string $username Nombre de usuario
	* @param string $password Contrase?a 
	* @return User Informacion sobre el usuario, false si no fue exitosa la autenticacion
	*/
	function auth($username, $password) {
		
		$usernameLowercase = strtolower($username);
		$user = ClientUserQuery::create()->filterByUsername($usernameLowercase)->findOne();

		if ( !empty($user) ) {
			if ( $user->getPassword() == md5($password."ASD") ) {
				$_SESSION['lastLogin'] = $user->getLastLogin();	
				$user->setLastLogin(time());
				$user->save();
				if (is_null($user->getPasswordUpdated()) && ConfigModule::get("clients","forceFirstPasswordChange"))
					$_SESSION['firstLogin'] = "firstLogin";
				else
					unset($_SESSION['firstLogin']);
				return $user;
			}
		}
		return false;
	}

	/**
	* Setea el acceso en 0 o elimina usuario 
	*
	* @param int $id Id del usuario
	* @return boolean true
	*/
	function delete($id) {
		$client = ClientUserPeer::retrieveByPk($id);
		if (ClientUserPeer::DELETEUSERS)
			$client->forceDelete();
		else
			$client->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un usuario.
	*
	* @param int $id Id del usuario
	* @return array Informacion del usuario
	*/
	function get($id) {
		$user = ClientUserQuery::create()->findPk($id);
		return $user;
	}

	/**
	* Actualiza la informacion de un usuario por cliente.
	*
	* @param int $id Id del usuario
	* @param string $username Nombre de usuario
	* @param string $name Nombre del usuario
	* @param string $surname Apellido del usuario
	* @param string $pass Contrase?a del usuario
	* @param int $levelId Id del nivel de usuarios
	* @param string $mailAddress Email del usuario
	* @return boolean true si se actualizo la informacion correctamente
	*/
	function update($id, $params) {
		$userByClient = ClientUserPeer::retrieveByPK($id);
		
		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($userByClient,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$userByClient->$setMethod($value);
				else
					$userByClient->$setMethod(null);
			}
		}
		try {
			$userByClient->save($con);
			return $userByClient;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	* Obtiene los grupos de usuarios en los cuales es miembro un usuario por cliente.
	*
	* @param int $id Id del usuario
	* @return array Grupos de Usuarios
	*/
	function getGroupsByUser($id) {
			return ClientGroupQuery::create()->join('ClientUserGroup')
							->useQuery('ClientUserGroup')
									->filterByUserId($id)
							->endUse()
								->find();
	}
	
	/**
	* Agrega un usuario a un grupo de usuarios.
	*
	* @param int $user Id del usuario
	* @param int $group Id del grupo de usuarios
	* @return boolean true si se agrego correctamente, false sino
	*/
	function addUserToGroup($user, $group) {
		try {
			$userGroup = new ClientUserGroup();
			$userGroup->setUserId($user);
			$userGroup->setGroupId($group);
			$userGroup->save();
			return true;
		}
		catch (PropelException $e) {
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
	function removeUserFromGroup($user, $group) {
		try {
			ClientUserGroupQuery::create()->filterByUserId($user)
				 ->filterByGroupId($group)
				 ->delete();
			return true;
		}
		catch (PropelException $e) {
			return false;
		}
	}
	
	/**
	* Activa un usuario por cliente a partir del id.
	*
	* @param int $id Id del usuario
	*	@return boolean true
	*/
	function activate($id) {
			ClientUserQuery::disableSoftDelete();
		$user = ClientUserPeer::retrieveByPk($id);
		ClientUserQuery::enableSoftDelete();
		$user->unDelete();
		return true;
	}

	/**
	* Autentica a un usuario.
	*
	* @param string $username Nombre de usuario
	* @param string $mailAddress Email
	* @return array [0] -> User Informacion sobre el usuario; [1] -> New password, false si no fue exitosa la autenticacion de usuario e email
	*/
	function generatePassword($username, $mailAddress) {
		$usernameLowercase = strtolower($username);
		$user = ClientUserQuery::create()->filterByUsername($usernameLowercase)->findOne();
		if ( !empty($user) ) {
			if ($user->getMailAddress() == $mailAddress ) {
				$newPassword = ClientUserPeer::getNewPassword();
				$user->setPassword($newPassword);
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
	* Genera una nueva contrase?a.
	*
	* @param int $length [optional] Longitud de la contrase?a
	* @return string Contrase?a
	*/
	function getNewPassword($length = 8) {
		$password = "";
		$possible = "23456789bcdfghjkmnpqrstvwxyz$#%";
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
	 * Retorna el criteria generado a partir de lso parï¿½metros de bï¿½squeda
	 *
	 * @return criteria $criteria Criteria con parï¿½metros de bï¿½squeda
	 */
	private function getSearchCriteria() {
		$criteria = new ClientUserQuery();
		$criteria->setIgnoreCase(true);
		$criteria->orderById();
		
		if (!empty($_SESSION["loginUser"])) {
			if (!empty($this->searchClientId)) {
				$clientId = $this->searchClientId;
				if ($clientId != -1)
					$criteria->filterByClientId($clientId);
			}
		} 
		else if (!empty($_SESSION["loginClientUser"])) {
			$clientId = $_SESSION["loginClientUser"]->getClientId();
			$criteria->filterByClientId($clientId);
		}
			
		return $criteria;
	}
		
	 /**
	* Obtiene todos los usuarios por cliente paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los usuarios por cliente
	*/
	function getSearchPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getSearchCriteria();
		$pager = new PropelPager($cond,"ClientUserPeer", "doSelect",$page,$perPage);
		return $pager;
	}
	
	 /**
	* Obtiene todos los usuarios por cliente paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los usuarios por cliente
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();

		if (empty($page))
			$page = 1;

		$cond = new ClientUserQuery();

		$pager = new PropelPager($cond,"ClientUserPeer", "doSelect",$page,$perPage);
		return $pager;
	}
	
	/**
	* Obtiene todas los usuarios por cliente con las opciones de filtro asignadas al peer.
	*
	*/
	function getAllFiltered() {
		$cond = $this->getSearchCriteria();
		return $cond->find();
	}

	/**
	* Obtiene la informacion de un usuario segun su nombre de usuario
	*
	* @param int $id Id del usuario
	* @return array Informacion del usuario
	*/
	function getByUsername($username) {
		$user = ClientUserQuery::create()->setIgnoreCase(1)->findOneByUsername($username);
		return $user;
	}
	
	/**
	 * Authentica un usuario por nombre de usuario y mail.
	 *
	 * @param string $username Nombre de usuario.
	 * @param string $mailAddress Email.
	 * @return User si fue exitosa la autenticacion, false si no.
	 */

	function authenticateByUserAndMail($username, $mailAddress) {
		$criteria = new ClientUserQuery();
		$criteria->filterByUserName($username);
		$criteria->filterByMailAddress($mailAddress);
		$user = $criteria->findOne();
		if (!empty($user))
			return $user;
		return false;
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
			$user = ClientUserQuery::create()->findOneByRecoveryHash($recoveryHash);
			if (!empty($user))
				return $user;
			else
				return false;
		}
		else
			return false;
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
			$user = ClientUserPeer::retrieveByPK($id);
			$user->setUpdatedAt(time());
			$user->setPasswordUpdated(time());
			$user->setPassword($pass);
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
	
	public static function getAllOwners() {
		return ClientUserQuery::create()->owners()->find();
	}

} // ClientUserPeer
