<?php

require 'affiliates/classes/om/BaseAffiliateBranch.php';


/**
 * Skeleton subclass for representing a row from the 'affiliates_branch' table.
 *
 * Affiliates branches information
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    affiliates.classes
 */
class AffiliateBranch extends BaseAffiliateBranch {

	/**
	 * Initializes internal state of AffiliateBranch object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

} // AffiliateBranch
