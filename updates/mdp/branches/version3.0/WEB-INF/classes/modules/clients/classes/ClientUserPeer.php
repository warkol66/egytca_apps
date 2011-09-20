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

	private $searchClientId;

	private $searchString;
	private $perPage;
	private $limit;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"searchClientId"=>"setSearchClientId",
					"perPage"=>"setPerPage",
					"limit" => "setLimit"
	);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

 /**
	 * Especifica el id de cliente
	 * @param clientId id del cliente
	 */
	public function setSearchClientId($clientId) {
		$this->searchClientId = $clientId;
	}

 /**
	 * Especifica cantidad de resultados por pagina.
	 * @param perPage integer cantidad de resultados por pagina.
	 */
	function setPerPage($perPage){
		$this->perPage = $perPage;
	}

	/**
	 * Especifica una cantidad maxima de registros.
	 * @param limit cantidad maxima de registros.
	 */
	function setLimit($limit){
		$this->limit = $limit;
	}

	/**
	 * Obtiene los usuarios por id de cliente
	 * @param int $clientId id de cliente
	 */
	function getByClientId($clientId) {
		return ClientUserQuery::create()->findByClientId($clientId);
	}

	/**
	* Obtiene todos los usuarios por cliente.
	* @return array Informacion sobre todos los usuarios
	*/
	function getAll() {
		return ClientUserQuery::create()->find();
	}

	/**
	* Obtiene todos los usuarios desactivados.
	* @return array Informacion sobre los usuarios
	*/
	function getDeleteds() {
		ClientUserQuery::disableSoftDelete();
		return ClientUserQuery::create()->filterByDeletedAt(null, Criteria::ISNOTNULL)
					 ->find();
	}

	/**
	* Obtiene todos los usuarios desactivados.
	* @param int $clientId Id del cliente
	* @return array Informacion sobre los usuarios
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

		if (!empty($user)) {
			if ($user->getPassword() == Common::md5($password)) {
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
		if (!ConfigModule::get("clients","usersSoftDelete"))
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
		return ClientUserQuery::create()->findPk($id);
	}

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		if (!isset($this->perPage))
			$this->perPage = Common::getRowsPerPage();
		return $this->perPage;
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
	* @return boolean true
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
				$newPassword = Common::generateRandomPassword();
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
	 * Retorna el criteria generado a partir de los parametros de busqueda
	 * @return criteria $criteria Criteria con parametros de busqueda
	 */
	private function getSearchCriteria() {
		$criteria = new ClientUserQuery();
		$criteria->setIgnoreCase(true);
		$criteria->setLimit($this->limit);
		$criteria->orderById();

		if ($this->searchString) {
			$criteria->add(ClientUserPeer::USERNAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionName = $criteria->getNewCriterion(ClientUserPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionName);
			$criterionSurname = $criteria->getNewCriterion(ClientUserPeer::SURNAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionSurname);
			$criterionEmail = $criteria->getNewCriterion(ClientUserPeer::MAILADDRESS,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionEmail);
		}

		if (!empty($_SESSION["loginUser"])) {
			if (!empty($this->searchClientId) && $this->searchClientId > 0)
				$criteria->filterByClientId($this->searchClientId);
		}
		else if (!empty($_SESSION["loginClientUser"])) {
			$clientId = $_SESSION["loginClientUser"]->getClientId();
			$criteria->filterByClientId($clientId);
		}

		return $criteria;
	}

 /**
	* Obtiene todos los ClientUser paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los actores
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = $this->getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"ClientUserPeer", "doSelect",$page,$perPage);
		return $pager;
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
	 * Devuelve el usuario con recuperacion de contrase🟰endiente que corresponda a partir
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
	* @param string $pass Contrase🟤el usuario
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

	/**
	* Obtiene todos los usuarios owners
	* @return array propel obj clientUSers
	*/
	public static function getAllOwners() {
		return ClientUserQuery::create()->owners()->find();
	}

	/**
	* Obtiene un array de Id de usuarios de un cliente determinado
	* @param propel obj $client Cliente
	* @return array Ids de usuarios asociados al cliente
	*/
	public static function getIdsArray($client) {
		return ClientUserQuery::create()->select('Id')->findByClientid($client->getId());
	}

} // ClientUserPeer
