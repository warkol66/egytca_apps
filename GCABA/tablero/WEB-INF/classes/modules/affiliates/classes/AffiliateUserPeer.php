<?php


/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_user' table.
 *
 * Usuarios de afiliado
 *
 * @package    affiliates
 */
class AffiliateUserPeer extends BaseAffiliateUserPeer {

		//Setea si se eliminan realmente los usuarios de la base de datos o se marcan como no activos
		const DELETEUSERS = false;

		function getAffiliate($affiliateId) {
		$cond = new Criteria();
		$cond->add(AffiliateUserPeer::AFFILIATEID,$affiliateId);
		$cond->add(AffiliateUserPeer::ACTIVE,1);
		$todosObj = AffiliateUserPeer ::doSelect($cond);
		return $todosObj;
	}

	/**
	 * Aplica Id de Affiliate
	 */
	public function setAffiliateId($id) {

		$this->setAffiliateId = $id;

	}

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {

		$criteria = new Criteria();

		if (!empty($this->AffiliateId)) {
			$criteria->add(AffiliateUserPeer::AFFILIATEID, $this->getAffiliateId);
		}

		return $criteria;

	}


	/**
	* Obtiene todos los usuarios por afiliado.
	*
	*	@return array Informacion sobre todos los usuarios
	*/
	function getAll() {
		$cond = new Criteria();
		$cond->add(AffiliateUserPeer::ACTIVE,1);
		$cond->addJoin(AffiliateUserPeer::ID,AffiliateUserInfoPeer::USERID,Criteria::LEFT_JOIN);
		$todosObj = AffiliateUserPeer::doSelect($cond);
		return $todosObj;
	}

	/**
	* Obtiene todos los los usuarios por afiliado.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los AffiliateUser
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$cond->addAscendingOrderByColumn(AffiliateUserPeer::ID);

		$pager = new PropelPager($cond,"AffiliateUserPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Obtiene todos los usuarios por afiliado paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los AffiliateUser
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"AffiliateUserPeer", "doSelect",$page,$perPage);
		return $pager;
	 }


	/**
	* Obtiene todos los usuarios desactivados.
	*
	*	@return array Informacion sobre los usuarios
	*/
	function getDeleteds() {
		$cond = new Criteria();
		$cond->add(AffiliateUserPeer::ACTIVE, 0);
		$todosObj = AffiliateUserPeer::doSelect($cond);
		return $todosObj;
	}

	/**
	* Obtiene todos los usuarios desactivados.
	*
	* @param int $affiliateId Id del afiliado
	*	@return array Informacion sobre los usuarios
	*/
	function getDeletedsByAffiliate($affiliateId) {
		$cond = new Criteria();
		$cond->add(AffiliateUserPeer::AFFILIATEID,$affiliateId);
		$cond->add(AffiliateUserPeer::ACTIVE, 0);
		$todosObj = AffiliateUserPeer::doSelect($cond);
		return $todosObj;
	}

	function getFromArray($params) {
		$obj = new AffiliateUser();
		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($obj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$obj->$setMethod($value);
				else
					$obj->$setMethod(null);
			}
		}
		return $obj;
	}


	/**
	* Crea un usuario nuevo por afiliado.
	*
	* @param string $username Nombre de usuario
	* @param string $name Nombre del usuario
	* @param string $surname Apellido del usuario
	* @param string $pass Contrase�a del usuario
	* @param int $levelId Id del nivel de usuarios
	* @param string $mailAddress Email del usuario
	* @return boolean true si se creo el usuario correctamente, false sino
	*/
	function create($affiliateId,$username,$password,$levelId,$name,$surname,$mailAddress,$timezone,$con = null) {

		$userByAffiliate = new AffiliateUser();
		$userByAffiliate->setUsername($username);
		$userByAffiliate->setAffiliateId($affiliateId);
		$userByAffiliate->setActive(1);
		$userByAffiliate->setTimezone($timezone);
		$userByAffiliate->setCreated(time());
		$userByAffiliate->setUpdated(time());
		$userByAffiliate->setLevelId($levelId);
		$userByAffiliate->setPassword(common::md5($password));
		$userByAffiliate->save($con);


		$userByAffiliateInfo = new AffiliateUserInfo();
		$userByAffiliateInfo->setUserId($userByAffiliate->getId());
		$userByAffiliateInfo->setName($name);
		$userByAffiliateInfo->setSurname($surname);
		$userByAffiliateInfo->setMailAddress($mailAddress);
		$userByAffiliateInfo->save($con);

		global $system;
		$mediaWikiIntegration = $system["config"]["affiliates"]["mediaWikiIntegration"]["value"];

		if ($mediaWikiIntegration == "YES") {
			//Creo el user en la wiki
			$user_password = ':A:' . md5($password);
			$user_registration = date("YmdHis");
			$user_real_name = $name . " " . $surname;
			$sql = "INSERT INTO user (user_name,user_real_name,user_password,user_newpassword,user_email,user_options,user_registration,user_editcount)
					VALUES (:user_name,:user_real_name,:user_password,'',:user_email,'',:user_registration,'0')";

			if (empty($con))
				$con = Propel::getConnection(AffiliateUserPeer::DATABASE_NAME);

			$stmt = $con->prepare($sql);
			$stmt->bindParam(':user_name', ucfirst($username));
			$stmt->bindParam(':user_real_name', $user_real_name);
			$stmt->bindParam(':user_password', $user_password);
			$stmt->bindParam(':user_email', $mailAddress);
			$stmt->bindParam(':user_registration', $user_registration);

			$stmt->execute();

			$wiki_user_id = $con->lastInsertId();

			//Lo agrego al grupo del afiliado
			$sql = "INSERT INTO user_groups (ug_user,ug_group)
					VALUES (:wiki_user_id,:ug_group)";

			$stmt = $con->prepare($sql);
			$stmt->bindParam(':wiki_user_id', $wiki_user_id);
			$affiliate = AffiliatePeer::get($affiliateId);
			$stmt->bindParam(':ug_group', $affiliate->getName());

			$stmt->execute();
		}

		return $userByAffiliate;
	}


	/**
	* Autentica a un usuario por afiliado.
	*
	* @param string $username Nombre de usuario
	* @param string $password Contrase�a
	* @return User Informacion sobre el usuario, false si no fue exitosa la autenticacion
	*/
	function auth($username,$password) {
		$cond = new Criteria();
		$cond->add(AffiliateUserPeer::USERNAME, $username);
		$cond->add(AffiliateUserPeer::ACTIVE, "1");
		$cond->addJoin(AffiliateUserPeer::ID,AffiliateUserInfoPeer::USERID);
		$user = AffiliateUserPeer::doSelectOne($cond);
		if (!empty($user)) {
			if ($user->getPassword() == common::md5($password)) {
				$_SESSION['lastLogin'] = $user->getLastLogin();
				$user->setLastLogin(time());
				$user->save();
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
		$affiliate = AffiliateUserPeer::retrieveByPk($id);
		if (AffiliateUserPeer::DELETEUSERS)
			$affiliate->delete();
		else {
			$affiliate->setActive(0);
			$affiliate->save();
		}
		return true;
	}


	/**
	* Obtiene la informacion de un usuario.
	*
	* @param int $id Id del usuario
	* @return array Informacion del usuario
	*/
	function get($id) {
		$cond = new Criteria();
		$cond->add(AffiliateUserPeer::ID, $id);
		$cond->addJoin(AffiliateUserPeer::ID,AffiliateUserInfoPeer::USERID,Criteria::LEFT_JOIN);
		$obj = AffiliateUserPeer::doSelectOne($cond);

		return $obj;
	}


	/**
	* Actualiza la informacion de un usuario por afiliado.
	*
	* @param int $id Id del usuario
	* @param string $username Nombre de usuario
	* @param string $name Nombre del usuario
	* @param string $surname Apellido del usuario
	* @param string $pass Contrase�a del usuario
	* @param int $levelId Id del nivel de usuarios
	* @param string $mailAddress Email del usuario
	* @return boolean true si se actualizo la informacion correctamente
	*/
	function update($id,$affiliateId,$username,$password,$levelId,$name,$surname,$mailAddress,$timezone) {
		$userByAffiliate = AffiliateUserPeer::retrieveByPK($id);

		$oldUsername = $userByAffiliate->getUsername();

		$userByAffiliate->setUsername($username);
		$userByAffiliate->setAffiliateId($affiliateId);
		$userByAffiliate->setUpdated(now);
		$userByAffiliate->setTimezone($timezone);
		$userByAffiliate->setLevelId($levelId);
		if (!empty($password)){
			$userByAffiliate->setPassword(common::md5($password));
		}
		$userByAffiliate->save();

		$userByAffiliateInfo = AffiliateUserInfoPeer::retrieveByPK($id);
		$userByAffiliateInfo->setName($name);
		$userByAffiliateInfo->setSurname($surname);
		$userByAffiliateInfo->setMailAddress($mailAddress);
		$userByAffiliateInfo->save();

		global $system;
		$mediaWikiIntegration = $system["config"]["affiliates"]["mediaWikiIntegration"]["value"];

		if ($mediaWikiIntegration == "YES") {
			//Modifico el user en la wiki
			$user_password = ':A:' . md5($password);
			$user_registration = date("YmdHis");
			$user_real_name = $name . " " . $surname;
			$sql = "UPDATE user SET user_name = :user_name, user_real_name = :user_real_name, ";
			if (!empty($password)) {
				$sql .= "user_password = :user_password, ";
			}
			$sql .= "user_email = :user_email where user_name = :old_user_name";

			$con = Propel::getConnection(AffiliateUserPeer::DATABASE_NAME);

			$stmt = $con->prepare($sql);
			$stmt->bindParam(':user_name', ucfirst($username));
			$stmt->bindParam(':user_real_name', $user_real_name);
			if (!empty($password)) {
				$stmt->bindParam(':user_password', $user_password);
			}
			$stmt->bindParam(':user_email', $mailAddress);
			$stmt->bindParam(':old_user_name', ucfirst($oldUsername));

			$stmt->execute();
		}

		return true;
	}

	/**
	* Obtiene los grupos de usuarios en los cuales es miembro un usuario por afiliado.
	*
	* @param int $id Id del usuario
	* @return array Grupos de Usuarios
	*/
	function getGroupsByUser($id) {
		$cond = new Criteria();
		$cond->add(AffiliateUserGroupPeer::USERID, $id);
		$todosObj = AffiliateUserGroupPeer::doSelectJoinAffiliateGroup($cond);
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
			$userGroup = new AffiliateUserGroup();
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
	function removeUserFromGroup($user,$group) {
		try {
			$cond = new Criteria();
			$cond->add(AffiliateUserGroupPeer::USERID, $user);
			$cond->add(AffiliateUserGroupPeer::GROUPID, $group);
			$todosObj = AffiliateUserGroupPeer::doSelect($cond);
			$obj = $todosObj[0];
			$obj->delete();
			return true;
		}
		catch (PropelException $e) {
			return false;
		}
	}

	/**
	* Activa un usuario por afiliado a partir del id.
	*
	* @param int $id Id del usuario
	*	@return boolean true
	*/
	function activate($id) {
		$user = AffiliateUserPeer::retrieveByPk($id);
		$user->setActive(1);
		$user->save();
		return true;
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
		$cond->add(AffiliateUserPeer::USERNAME, $username);
		$cond->add(AffiliateUserPeer::ACTIVE, "1");
		$todosObj = AffiliateUserPeer::doSelectJoinAffiliateUserInfo($cond);
		$user = $todosObj[0];
		if ( !empty($user) ) {
			$userInfo = $user->getAffiliateUserInfo();
			if ( !empty($userInfo) && $userInfo->getMailAddress() == $mailAddress ) {
				$newPassword = Common::generateRandomPassword();
				$user->setPassword(Common::md5($newPassword));
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
	* @param int $length [optional] Longitud de la contrase�a
	* @return string Contraseña
	*/
	function getNewPassword($length = 8)
	{
		// start with a blank password
		$password = "";

		// define possible characters
		$possible = "0123456789bcdfghjkmnpqrstvwxyz";

		// set up a counter
		$i = 0;

		// add random characters to $password until $length is reached
		while ($i < $length) {

			// pick a random character from the possible ones
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);

			// we don't want this character if it's already in the password
			if (!strstr($password, $char)) {
				$password .= $char;
				$i++;
			}
		}
		// done!
		return $password;
	}

	/**
	* Obtiene la informacion de un usuario segun su nombre de usuario
	*
	* @param int $id Id del usuario
	* @return array Informacion del usuario
	*/
	function getByUsername($username) {
		$cond = new Criteria();
		$cond->setIgnoreCase(true);
		$cond->add(AffiliateUserPeer::USERNAME, $username);
		$result = AffiliateUserPeer::doSelectOne($cond);
		return $result;
	}


} // AffiliateUserPeer
