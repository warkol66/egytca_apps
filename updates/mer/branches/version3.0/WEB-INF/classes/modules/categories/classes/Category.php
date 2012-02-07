<?php



/**
 * Skeleton subclass for representing a row from the 'MER_category' table.
 *
 * Categorias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.categories.classes
 */
class Category extends BaseCategory {

	function hasAccessUser($user) {
			foreach ($user->getGroups() as $groupUser) {
				if ( $this->hasAccessGroup($groupUser->getGroup()) )
					return true;
			}
			return false;
	}

	function hasAccessGroup($group) {
  	$groupCategory = GroupCategoryPeer::retrieveByPK($group->getId(),$this->getId());
  	if ( !empty($groupCategory) )
  		return true;
  	return false;
	}

} // Category
