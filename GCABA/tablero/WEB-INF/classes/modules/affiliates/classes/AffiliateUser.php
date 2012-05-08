<?php

require_once 'affiliates/classes/om/BaseAffiliateUser.php';


/**
 * Skeleton subclass for representing a row from the 'affiliates_user' table.
 *
 * Usuarios de afiliado
 *
 * @package    affiliates
 */
class AffiliateUser extends BaseAffiliateUser {

	
 /**
  * Return an array with all the categories this user can access
  *
  * @return array of Catetegory
  */
  function getCategories(){
		require_once("AffiliateUserGroupPeer.php");
  	require_once("AffiliateGroupCategoryPeer.php");
  	$sql = "SELECT ".AffiliateCategoryPeer::TABLE_NAME.".* FROM ".AffiliateUserGroupPeer::TABLE_NAME ." ,".
						AffiliateGroupCategoryPeer::TABLE_NAME .", ".AffiliateCategoryPeer::TABLE_NAME .
						" where ".AffiliateUserGroupPeer::USERID ." = '".$this->getId()."' and ".
						AffiliateUserGroupPeer::GROUPID ." = ".AffiliateGroupCategoryPeer::GROUPID ." and ".
						AffiliateGroupCategoryPeer::CATEGORYID ." = ".AffiliateCategoryPeer::ID ." and ".
						AffiliateCategoryPeer::ACTIVE ." = 1";
  	
  	$con = Propel::getConnection(AffiliateUserPeer::DATABASE_NAME);
	$stmt = $con->prepare($sql);
	$stmt->execute();
	return CategoryPeer::populateObjects($stmt);
  }
  
 /**
  * Asigna los grupos del usuario a una categoria.
  *
  * @param int $categoryId Id de la categoria
  * @return void
  */
  function setGroupsToCategory($categoryId) {
		require_once("AffiliateGroupCategoryPeer.php");                                            	
		foreach ($this->getGroups() as $group) {
			$groupCategory = new AffiliateGroupCategory();
			$groupCategory->setGroupId($group->getGroupId());
			$groupCategory->setCategoryId($categoryId);
			$groupCategory->save();
		}
		return;
	}

 /**
	* Obtiene los grupos a los que pertenece un usuario
	*
	* @returns todos los grupos.
	*/
	function getGroups() {
		require_once("AffiliateGroupPeer.php");
		$cond = new Criteria();
		$cond->add(AffiliateUserGroupPeer::USERID, $this->getId());
		$todosObj = AffiliateUserGroupPeer::doSelectJoinGroup($cond);
		return $todosObj;
	}

 /**
	* Indica si un usuario forma parte de un grupo
	*
	* @param array $groups array de grupos
	* @returns true si pertenece al grupo, de lo contrario, false.
	*/
	function belongsToGroups($groups) {
		$groupsArray = explode(";",$groups);
		require_once("AffiliateUserGroupPeer.php");
		$c = new Criteria();
		$c->add(AffiliateUserGroupPeer::USERID, $this->getId());
		$all = AffiliateUserGroupPeer::doSelect($c);
		foreach ($all as $userGroup) {
			if (in_array($userGroup->getGroupId(),$groupsArray))
				return true;
		}
		return false;
	}

 /**
	* Obtiene todos los usuarios por afiliado
	*
	* @returns todos los usuarios por afiliado
	*/
	function getAll() {
		$cond = new Criteria();
		$todosObj = AffiliatePeer::doSelect($cond);
		return $todosObj;
  }




	function getTotalAccess() {
		$userLevel = $this->getLevelId();
		$baseLevel = 1;
		while ($userLevel > 1) {
			$baseLevel += $userLevel;
			$userLevel = $userLevel / 2;
		}	
		return $baseLevel;
	}


} // AffiliateUser
