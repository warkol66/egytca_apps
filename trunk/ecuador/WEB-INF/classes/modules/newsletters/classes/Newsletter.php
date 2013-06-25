<?php

/**
 * Skeleton subclass for representing a row from the 'newsletters_newsletter' table.
 *
 * Newsletters
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    infocivica
 */
class Newsletter extends BaseNewsletter {

	/**
	 * Initializes internal state of Newsletter object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	/**
	 * Obtiene los usuarios por registracion a los cuales se 
	 * les ha enviado este newsletter.
	 * @return array Instancia de RegistrationUser
	 */
	public function getUsersSent() {
		
		$criteria = new Criteria();
		$criteria->addJoin(RegistrationUserPeer::ID,NewsletterUserPeer::REGISTRATIONUSERID,Criteria::INNER_JOIN);
		$criteria->add(NewsletterUserPeer::NEWSLETTERID,$this->getId());
		
		return RegistrationUserPeer::doSelect($criteria);
		
	}
	
	public function getLastUserSent() {

		$criteria = new Criteria();
		$criteria->addJoin(RegistrationUserPeer::ID,NewsletterUserPeer::REGISTRATIONUSERID,Criteria::INNER_JOIN);
		$criteria->add(NewsletterUserPeer::NEWSLETTERID,$this->getId());
		$criteria->addDescendingOrderByColumn(NewsletterUserPeer::REGISTRATIONUSERID);
		$criteria->setLimit(1);
		
		$result = RegistrationUserPeer::doSelect($criteria);
		return $result[0];
		
	}

} // Newsletter
