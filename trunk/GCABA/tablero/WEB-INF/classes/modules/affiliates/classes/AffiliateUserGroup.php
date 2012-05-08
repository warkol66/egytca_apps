<?php

require_once 'affiliates/classes/om/BaseAffiliateUserGroup.php';

require_once("CategoryPeer.php");
require_once("AffiliateGroupCategoryPeer.php");


/**
 * Skeleton subclass for representing a row from the 'affiliates_userGroup' table.
 *
 * Users / Groups
 *
 * @package    affiliates
 */
class AffiliateUserGroup extends BaseAffiliateUserGroup {

  /**
  * Obtiene las categorias que puede acceder un grupos de usuarios.
  *
  * @return array GroupCategories
  */
  function getCategories() {
		$cond = new Criteria();
		$cond->add(AffiliateGroupCategoryPeer::GROUPID, $this->getId());
		$todosObj = AffiliateGroupCategoryPeer::doSelectJoinCategory($cond);
		return $todosObj;
  }
  
  /**
  * Obtiene las categorias que no puede acceder un grupos de usuarios.
  *
  * @return array Categories
  */
  function getNotAssignedCategories() {
    $categories = CategoryPeer::getAll();
    $groupCategories = $this->getCategories();
    $notAssignedCategories = array();
    foreach ($categories as $category) {
    	$assigned = false;
    	$i = 0;
			while ($i < count($groupCategories) and !$assigned ) {
				$cat = $groupCategories[$i]->getCategory();
				if ($cat->getId() == $category->getId())
					$assigned = true;
				$i++;
			}
			if (!$assigned)
				$notAssignedCategories[] = $category;
    }
		return $notAssignedCategories;
  }

} // AffiliateUserGroup
