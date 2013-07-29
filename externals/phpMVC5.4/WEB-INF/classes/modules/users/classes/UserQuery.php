<?php


/**
 * Skeleton subclass for performing query and update operations on the 'users_user' table.
 *
 * Users
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.users.classes
 */
class UserQuery extends BaseUserQuery {
	
	function selectBlocked($blocked){
		if($blocked)
			$this->where('User.BlockedAt IS NOT NULL');
		return $this;
	}

	function getLoged(){
		return $this->filterBySession(null, Criteria::ISNOTNULL);
	}

} // UserQuery
