<?php

/**
 * Skeleton subclass for performing query and update operations on the 'registration_user' table.
 *
 * Users by registration
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    infocivica
 */
class RegistrationUserPeer extends BaseRegistrationUserPeer {

		//Setea si se eliminan realmente los usuarios de la base de datos o se marcan como no activos
		const DELETEUSERS = false;
		
		private $userFields = array(
					'password'
			);
		
		private $userInfoFields = array(
					'mailAddress',
					'surname',
					'name',
					'group',
					'country'
			);
	private $searchString;

	/**
	 * Especifica una cadena de busqueda. Cada palabra de la cadena sera extraida y buscada en
	 * identificación de usuario, nombre, apellido, etc.
	 * @param string cadena de busqueda.
	 */
	public function setSearchString($string) {
		$this->searchString = $string;
	}



	  /**
	  * Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	  *
	  * @return int Cantidad de filas por pagina
	  */
	  public function getRowsPerPage() {
	    global $system;
	    return $system["config"]["system"]["rowsPerPage"];
	  }	
	
	function doSelectJoinUserInfo($criteria) {
		
		require_once('RegistrationUserInfoPeer.php');
		
		if (empty($criteria))
			$criteria = new Criteria();
			
		$criteria->addJoin(RegistrationUserPeer::ID,RegistrationUserInfoPeer::USERID,Criteria::INNER_JOIN);
		
		return RegistrationUserPeer::doSelect($criteria);
		
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
		$cond->add(RegistrationUserPeer::USERNAME, $username);
		$cond->add(RegistrationUserPeer::ACTIVE, "1");
		$cond->add(RegistrationUserPeer::VERIFIED, "1");
		$result = RegistrationUserPeer::doSelectJoinUserInfo($cond);
		$user = $result[0];

		if ( !empty($user) ) {
			if ( $user->getPassword() == md5($password."ASD") ) {
				$user->setLastLogin(time());
				$user->save();
				return $user;
			}
		}
		return false;
  	}

	/**
	 * Obtiene todos los usuarios que estan activos.
	 *
	 * @return array de instancias de RegistrationUser.
	 */
	function getAll() {

		$condition = new Criteria();
		$result = RegistrationUserPeer::doSelectJoinUserInfo($condition);
		return $result;

	}
	
	/**
	* Obtiene todos los noticias paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los newsarticles
	*/
	function getAllPaginated($page=1,$perPage=-1) {  
		if ($perPage == -1)
			$perPage = 	RegistrationUserPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();     
		$pager = new PropelPager($cond,"RegistrationUserPeer", "doSelect",$page,$perPage);
		return $pager;
	}
	

	/**
	 * Devuelve todos los UsersByRegistration desactivados.
	 * @return array de instancia de RegistrationUser.
	 */
	function getAllInactive() {
		$condition = new Criteria();
		$condition->add(RegistrationUserPeer::ACTIVE, 0);
		$result = RegistrationUserPeer::doSelectJoinUserInfo($condition);
		return $result;
	}

	public function validateParamsUser($paramsUser) {
		
		$validation = true;
		foreach ($this->userFields as $field) {
			$validation = $validation && !empty($paramsUser[$field]);

		}
		
		return $validation;
		
	}
	
	public function validateParamsUserInfo($paramsUserInfo) {

		$validation = true;

		foreach ($this->userInfoFields as $field) {
			
			$validation = $validation && !empty($paramsUserInfo[$field]);
		}
		
		//casos especiales
		
		//validacion de que un email sea valido
		$validation = $validation && eregi('^[a-zA-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$',$paramsUserInfo['mailAddress']);
		
		$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
		
		$mailValid = Common::verifyMailbox($paramsUserInfo['mailAddress'],$mailFrom);
		
		$validation = $validation && $mailValid;
		
		//si Argentina es el pais seleccionado, La provincia es obligatoria
		if (!empty($paramsUserInfo['country']) && $paramsUserInfo['country'] == 'Argentina')
			$validation = $validation && !empty($paramsUserInfo['state']);

		return $validation;
	}


	/**
	 * Crea un nuevo usuario de registracion
	 * 
	 * @param string $username nombre de usuario
  	 * @param string $name Nombre de pila del usuario
	 * @param string $surname apellido del usuario
	 * @param $pass contrasenia
	 * @param string $email email del usuario
	 * @return boolean true si se creo el usuario, false en caso de error. 
	 */
	function create($paramsUser,$paramsUserInfo) {

		try {

			$registrationUserObj = new RegistrationUser();
			foreach ($paramsUser as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($registrationUserObj,$setMethod) ) {
					//caso especial para set de password
					if ($key == 'password' && $value != '') {
						$registrationUserObj->setPassword(md5($value."ASD"));	
					}
					else {
						if (($value == 0) || !empty($value))
						    $registrationUserObj->$setMethod($value);
						  else
						    $registrationUserObj->$setMethod(null);
					}
				}
			}

			//el email especificado es el nombre de usuario del sistema.
			$registrationUserObj->setUsername($paramsUserInfo['mailAddress']);
			$registrationUserObj->setCreated(time());
			$registrationUserObj->setUpdated(time());
			$registrationUserObj->setActive(1);
			$registrationUserObj->setIp($_SERVER["REMOTE_ADDR"]);

			$registrationUserObj->save();

			$registrationUserInfoObj = new RegistrationUserInfo();
			
			//establezco relacion con los el user y el userId
			$registrationUserInfoObj->setUserId($registrationUserObj->getId());
			
			foreach ($paramsUserInfo as $key => $value) {
				$setMethod = "set".$key;
		
				if ( method_exists($registrationUserInfoObj,$setMethod) ) {
					
					if (!empty($value))
					    $registrationUserInfoObj->$setMethod($value);
					  else
					    $registrationUserInfoObj->$setMethod(null);
				}
			}

			$registrationUserInfoObj->save();

		} catch (Exception $exp) {

			return false;
		}

		return $registrationUserObj;

	}
	
	/**
	 * Activa un Usuario por Registracion
	 * @param RegistrationUser instance
	 */
	public function activateUser($user) {
		try {
			//al activarse el usuario, no tiene asignado un hash de verificacion.
			$user->setVerificationHash('');
			$user->setActive(1);
			$user->setVerified(1);
			$user->setImported(0);
			$user->save();
		} catch (Exception $e) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Verifica un Usuario por Registracion
	 * @param RegistrationUser instance
	 */
	public function verifyUser($user) {
		try {
			//al activarse el usuario, no tiene asignado un hash de verificacion.
			$user->setVerificationHash('');
			$user->setVerified(1);
			$user->save();
		} catch (Exception $e) {
			return false;
		}
		
		return true;
	}	
	
	/**
	 * Activa un Usuario por Registracion utilizando un hash de verificacion
	 * @param RegistrationUser instance
	 */
	public function activateUserByHash($user,$hash) {
		
		if ($user->getVerificationHash() != $hash)
				return false;
		return $this->activateUser($user);
	}

	/**
	 * Cancela la registracion de un Usuario por Registracion utilizando un hash de verificacion
	 * @param RegistrationUser instance
	 */
	public function cancelUserByHash($user,$hash) {
		
		if ($user->getVerificationHash() != $hash)
				return false;
		return $this->cancelUser($user);
	}

	/**
	 * Cancela la registracion de un Usuario por Registracion 
	 * @param RegistrationUser instance
	 */	
	public function cancelUser($user) {
		try {
			$user->cancel();
		} catch (PropelException $e) {
			return false;
		}
		return true;
	}
	
	/**
	 * Verifica un Usuario por Registracion utilizando un hash de verificacion
	 * @param RegistrationUser instance
	 */
	public function verifyUserByHash($user,$hash) {
		
		if ($user->getVerificationHash() != $hash)
				return false;
		return $this->verifyUser($user);
	}		
	
  	/**
	 * Obtiene la informacion de un usuario por registracion segun su id.
  	 *
	 * @param int $id Id del usuario por registracion
	 * @return array con informacion del usuario por registracion
  	 */  
	function getByHash($hash) {
		$cond = new Criteria();
		$cond->add(RegistrationUserPeer::VERIFICATIONHASH, $hash);
		$todosObj = RegistrationUserPeer::doSelectJoinUserInfo($cond);
		return $todosObj[0];
  	}	
	
	/**
	 * Genera un hash y se lo asocia a un determinado usuario
	 * @param RegistrationUser RegistrationUser instance
	 */
	public function generateHash($user) {
		
		try {
			
			$hash = sha1($user->getId() . $user->getUsername() . date("Y-m-d H:i:s"));
			$user->setVerificationHash($hash);
			$user->save();
			
		} catch (Exception $e) {
			
			return false;
			
		}
		
		return $user->getVerificationHash();
		
	}

  	/**
	 * Obtiene la informacion de un usuario por registracion segun su id.
  	 *
	 * @param int $id Id del usuario por registracion
	 * @return array con informacion del usuario por registracion
  	 */  
	function get($id) {
		$cond = new Criteria();
		$cond->add(RegistrationUserPeer::ID, $id);
		$todosObj = RegistrationUserPeer::doSelectJoinUserInfo($cond);
		return $todosObj[0];
  	}

  /**
  * Actualiza la informacion de un usuario.
  *
  * @param int $id Id del usuario
  * @param string $username Nombre de usuario
  * @param string $name Nombre del usuario
  * @param string $surname Apellido del usuario
  * @param string $pass Contraseña del usuario
  * @param string $mailA Email del usuario
  * @return boolean true si se actualizo la informacion correctamente, false sino
  */
  function update($paramsUser,$paramsUserInfo) {

		try {
			
			$registrationUserObj = RegistrationUserPeer::retrieveByPK($paramsUser['id']);


			foreach ($paramsUser as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($registrationUserObj,$setMethod) ) {
					//caso especial para set de password
					if ($key == 'password') {
						if ($value != '')
							$registrationUserObj->setPassword(md5($value."ASD"));	
					}
					else {
						if (($value == 0) || !empty($value))
						    $registrationUserObj->$setMethod($value);
						  else
						    $registrationUserObj->$setMethod(null);
					}
				}
			}

			$registrationUserObj->setUpdated(time());
			$registrationUserObj->save();

			$registrationUserInfoObj = RegistrationUserInfoPeer::retrieveByPK($paramsUser['id']);
			foreach ($paramsUserInfo as $key => $value) {
				$setMethod = "set".$key;

				if ( method_exists($registrationUserInfoObj,$setMethod) ) {

					if (!empty($value))
					    $registrationUserInfoObj->$setMethod($value);
					  else
					    $registrationUserInfoObj->$setMethod(null);
				}
			}

			$registrationUserInfoObj->save();

		} catch (Exception $exp) {
			return false;
		}

		return true;

  	}

  /**
   * Elimina un usuario a partir del id.
   *
   * @param int $id Id del usuario
   * @return boolean true
   */
  function delete($id) {

		$user = RegistrationUserPeer::retrieveByPk($id);
		$user->setActive(0);
		$user->save();
		return true;
  }

  /**
   * Verifica si un nombre de usuario se encuentra en uso.
   * @param string $username nombre de usuario candidato
   * @return boolean devuelve true si esta en uso y false en caso contrario
   */
  function usernameIsUsed($username) {
		$cond = new Criteria();
		$cond->add(RegistrationUserPeer::USERNAME, $username);
		$result = RegistrationUserPeer::doSelect($cond);
		if (empty($result)) {
			return false;
		}

		return true;
  }

	/**
	* Autentica a un usuario.
	*
	* @param string $username Nombre de usuario
	* @param string $mailAddress Email
	* @return array [0] -> User Informacion sobre el usuario; [1] -> New password, false si no fue exitosa la autenticacion de usuario e email
	*/
  function generatePassword($username) {
		$cond = new Criteria();
		$cond->add(RegistrationUserPeer::USERNAME, $username);
		$cond->add(RegistrationUserPeer::ACTIVE, "1");
		$todosObj = RegistrationUserPeer::doSelectJoinUserInfo($cond);
		$user = $todosObj[0];
		if ( !empty($user) ) {
			$userInfo = $user->getUserInfo();
			if ( !empty($userInfo)) {
				$newPassword = RegistrationUserPeer::getNewPassword();
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
	
	public function assignRandomPassword($user) {

		$password = RegistrationUserPeer::getNewPassword();		

		try {
			$user->setPassword(md5($password."ASD"));
			$user->save();			
		} catch (PropelException $e) {
			return false;
		}

		return $password;
	}

  /**
  * Obtiene todos usuarios registrados con las opciones de filtro asignadas al peer.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los registrationUsers
  */
  function getAllPaginatedFiltered($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	RegistrationUserPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = $this->getCriteria();     
    $pager = new PropelPager($cond,"RegistrationUserPeer", "doSelect",$page,$perPage);
    return $pager;
   }


  /**
   * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
   * @return Criteria instancia de criteria
   */
  private function getCriteria() {
		$criteria = new Criteria();

		$criteria->addJoin(RegistrationUserPeer::ID,RegistrationUserInfoPeer::USERID,Criteria::INNER_JOIN);
		$criteria->setIgnoreCase(true);

		$criterion = $criteria->getNewCriterion(RegistrationUserPeer::USERNAME,"%" . $this->searchString . "%",Criteria::LIKE);
		$criterion->addOr($criteria->getNewCriterion(RegistrationUserInfoPeer::NAME,"%" . $this->searchString . "%", Criteria::LIKE));
		$criterion->addOr($criteria->getNewCriterion(RegistrationUserInfoPeer::SURNAME,"%" . $this->searchString . "%", Criteria::LIKE));
		$criterion->addOr($criteria->getNewCriterion(RegistrationUserInfoPeer::MAILADDRESS,"%" . $this->searchString . "%", Criteria::LIKE));

		$criteria->addOr($criterion);

		return $criteria;
	
  }


} // RegistrationUserPeer
