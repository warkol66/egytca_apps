<?php


/**
 * Skeleton subclass for representing a row from the 'registration_user' table.
 *
 * Users by registration
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    infocivica
 */
class RegistrationUser extends BaseRegistrationUser {

	/**
	 * Initializes internal state of RegistrationUser object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	public function canChangeToUsername($username) {
		
		$usernameActual = $this->getUsername();
		if (strcmp(trim($usernameActual),trim($username)) != 0) {
			return !(RegistrationUserPeer::usernameIsUsed($username));
		}
			
		return true;
		
	}
	
	public function getLevel() {
		require_once("Level.php");
		$level = new Level();
		$level->setBitLevel(1);
		return $level;
	}

	/**
	 * Indica si un usuario quiere recibir un newsletter
	 * @return boolean
	 */
	public function wantsNewsletter() {
		$userInfo = $this->getRegistrationUserInfo();
		return $userInfo->getNewsletterSubscribe();
	}
	
	public function cancel() {
		parent::delete();
	}

	/**
	 * Autentica el usuario y devuelve un objetio de tipo RegistrationUser si es correcto o null en otro caso.
	 * @static
	 * @param $username
	 * @param $password
	 * @return RegistrationUser
	 */
	public static function auth($username,$password){
		$user=RegistrationUserQuery::create()->filterByUsername($username)->filterByPassword(RegistrationUser::encryptPassword($password))->findOne();
		// Si no son correctos el usuario y password deveuvel null
		if(is_null($user)) return null;
		// Si no esta activo o no se ha verificado el email
		if(!$user->getActive() || $user->getVerificationhash()!="") return false;
		return $user;
	}

	/**
	 * Esta funcion encripta el password para la BD.
	 * @static
	 * @param $password
	 * @return string
	 */
	public static function encryptPassword($password){
		return md5($password);
	}

} // RegistrationUser
