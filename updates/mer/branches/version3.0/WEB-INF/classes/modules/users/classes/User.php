<?php

/** 
 * The skeleton for this class was autogenerated by Propel  on:
 *
 * [07/25/06 16:04:22]
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package mer 
 */
class User extends BaseUser {

	function getGroups() {
		$cond = new Criteria();
		$cond->add(UserGroupPeer::USERID, $this->getId());
		$todosObj = UserGroupPeer::doSelectJoinGroup($cond);
		return $todosObj;
	}

	function isAdmin() {
  	$groups = $this->getGroups();
  	foreach ($groups as $group) {
  		if ( $group->getGroupId() == 1 ) {
  			return true;
  		}
		}
		return false;
	}
	
	function isSupervisor() {
  	$groups = $this->getGroups();
  	foreach ($groups as $group) {
  		if ( $group->getGroupId() == 2 ) {
  			return true;
  		}
		}
		return false;
	}
	
   /**
    * Return an array with all the actors this user can access
    *
    * @return array of Actor
    */
  function getActors(){
  	$sql = "SELECT DISTINCT ".ActorPeer::TABLE_NAME.".* FROM ".UserGroupPeer::TABLE_NAME ." ,".GroupCategoryPeer::TABLE_NAME ." , ".ActorPeer::TABLE_NAME ." where ".UserGroupPeer::USERID ." = '".$this->getId()."' and ".UserGroupPeer::GROUPID ." = ".GroupCategoryPeer::GROUPID ." and ".GroupCategoryPeer::CATEGORYID ." = ".ActorPeer::CATEGORYID ;
  	
  	$con = Propel::getConnection(UserPeer::DATABASE_NAME);

$stmt = $con->prepare($sql);
$stmt->execute();

$formatter = new PropelObjectFormatter();
$formatter->setClass('Actor');
$userActors = $formatter->format($stmt);


    return $userActors;	  	

//    $stmt = $con->createStatement();
//    $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);    
//    return BaseActorPeer::populateObjects($rs);
  }
  
   /**
    * Return an array with all the actors this user can access
    *
    * @return array of Actor
    */
  function getCategories(){
  	if ($this->isAdmin() || $this->isSupervisor())
  		return CategoryPeer::getAll();
  	$sql = "SELECT ".CategoryPeer::TABLE_NAME.".* FROM ".UserGroupPeer::TABLE_NAME ." ,".
						GroupCategoryPeer::TABLE_NAME .", ".CategoryPeer::TABLE_NAME .
						" where ".UserGroupPeer::USERID ." = '".$this->getId()."' and ".
						UserGroupPeer::GROUPID ." = ".GroupCategoryPeer::GROUPID ." and ".
						GroupCategoryPeer::CATEGORYID ." = ".CategoryPeer::ID ." and ".
						CategoryPeer::ACTIVE ." = 1";
  	
  	$con = Propel::getConnection(UserPeer::DATABASE_NAME);

$stmt = $con->prepare($sql);
$stmt->execute();

$formatter = new PropelObjectFormatter();
$formatter->setClass('Category');
$userActors = $formatter->format($stmt);


    return $userActors;	  	

//    $stmt = $con->createStatement();
//    $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);    
//    return BaseCategoryPeer::populateObjects($rs);
  }

}
