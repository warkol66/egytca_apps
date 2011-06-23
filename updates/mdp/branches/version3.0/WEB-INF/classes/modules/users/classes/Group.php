<?php

/** 
 *
 * @package    users
 * @subpackage groups 
 */
class Group extends BaseGroup {

  /**
  * Obtiene las categorias que puede acceder un grupos de usuarios.
  *
  * @return array GroupCategories
  */
  function getCategories() {
		$cond = new Criteria();
		$cond->add(GroupCategoryPeer::GROUPID, $this->getId());
		$todosObj = GroupCategoryPeer::doSelectJoinCategory($cond);
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
		foreach ($groupCategories as $groupCategory) {
			$actualCategory = $groupCategory->getCategory();
			if ($actualCategory->getId() == $category->getId()) {
				$assigned = true;
				break;
			}
		}
		
		if (!$assigned)
			array_push($notAssignedCategories,$category);
    }
	
	return $notAssignedCategories;
	
  }

}
