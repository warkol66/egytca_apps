<?php



/**
 * Skeleton subclass for representing a row from the 'affiliates_userGroup' table.
 *
 * Users / Groups
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
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
