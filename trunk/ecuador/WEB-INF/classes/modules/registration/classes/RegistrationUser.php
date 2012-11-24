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

	/**
	 * Cuando el Usuario se esta creando se inicializan algunos campos
	 * @param PropelPDO $conn
	 * @return bloolean|bool
	 */
	public function preSave(PropelPDO $conn=null){
		if($this->isNew()){
			$now=strtotime("now");
			$this->setCreated($now);
			$this->setUpdated($now);
			$this->setIp($_SERVER['REMOTE_ADDR']);
		}
		return true;
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

} // RegistrationUser
