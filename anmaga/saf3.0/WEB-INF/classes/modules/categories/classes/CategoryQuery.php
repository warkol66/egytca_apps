<?php


/**
 * Skeleton subclass for performing query and update operations on the 'categories_category' table.
 *
 * Categorias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.categories.classes
 */
class CategoryQuery extends BaseCategoryQuery {
  
  /**
   * Devuelve aquellas categorias a las que tiene acceso el usuario más
   * aquellas que no tienen grupo asignado.
   */
  public function filterByUser($user) {
    if (!empty($user) && !$user->isAdmin() && !$user->isSupervisor()) {
      $this->join('GroupCategory', Criteria::LEFT_JOIN)
           ->join('GroupCategory.Group', Criteria::LEFT_JOIN)
           ->join('Group.UserGroup', Criteria::LEFT_JOIN)
           ->join('UserGroup.User', Criteria::LEFT_JOIN)
           ->where('(User.Id = ? OR Group.Id IS NULL)', $user->getId());
    }
    return $this;
  }
} // CategoryQuery
