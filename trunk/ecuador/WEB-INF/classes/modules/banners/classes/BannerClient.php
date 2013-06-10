<?php


/**
 * Skeleton subclass for representing a row from the 'banners_client' table.
 *
 * Clientes de los banners
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    banners.classes
 */
class BannerClient extends BaseBannerClient {

	/**
	 * Initializes internal state of BannerClient object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	public function getLogData(){
		return substr($this->getName(),0,50);
	}

} // BannerClient
