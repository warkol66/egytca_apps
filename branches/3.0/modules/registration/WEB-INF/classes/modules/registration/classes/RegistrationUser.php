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
	
	public function getUserInfo() {
		
		require_once('RegistrationUserInfoPeer.php');
		
		return RegistrationUserInfoPeer::get($this);
		
	}
	
	public function getLevel() {
		require_once("Level.php");
		$level = new Level();
		$level->setBitLevel(1);
		return $level;
	}
	
	/**
	 * Indica si el usuario por registracion se encuentra activo
	 * @return boolean
	 */
	public function isActive() {
		return ($this->getActive() == 1);
	}

	/**
	 * Indica si el usuario por registracion se encuentra verificado
	 * @return boolean
	 */	
	public function isVerified() {
		return ($this->getVerified() == 1);
	}

	/**
	 * Indica si un usuario ha sido creado por un proceso de importacion
	 * @return boolean
	 */
	public function isImported() {
		return $this->getImported();
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


} // RegistrationUser
