<?php

require 'import/classes/om/BaseBankAccount.php';


/**
 * Skeleton subclass for representing a row from the 'import_bankAccount' table.
 *
 * Cuentas bancarias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    import.classes
 */
class BankAccount extends BaseBankAccount {

	/**
	 * Initializes internal state of BankAccount object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	public function getDescription() {
		return $this->getBank() . " - " . $this->getAccountNumber();
	}

} // BankAccount
