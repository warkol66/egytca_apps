<?php



/**
 * Skeleton subclass for representing a row from the 'actors_actorsCategory' table.
 *
 * Relacion Actores y Categorias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.actors.classes
 */
class ActorCategoryRelation extends BaseActorCategoryRelation {

	/**
	* Obtiene el nombre del padre de un ActorCategory.
	*
	* @return array Informacion del ActorCategory
	*/
	function getCategoryName() {
		$categoryId = $this->getCategoryId();
		$category = ActorCategoryQuery::create()->findPk($categoryId);
		return $category->getName();
	}

} // ActorCategoryRelation
