<?php



/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'affiliates_affiliate' table.
 *
 * Afiliados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class Client extends Affiliate {

	/**
	 * Constructs a new Client class, setting the class_key column to AffiliatePeer::CLASSKEY_2.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setClassKey(AffiliatePeer::CLASSKEY_2);
	}

} // Client
