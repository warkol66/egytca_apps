<?php



/**
 * Skeleton subclass for representing a row from the 'actors_actor' table.
 *
 * Base de Actores
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.actors.classes
 */
class Actor extends BaseActor {

	/** the default item name for this class */
	const ITEM_NAME = 'Actor';

	/**
	* Obtiene el id de todas las categorķas asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getAssignedCategoriesArray(){
		return ActorCategoryRelationQuery::create()->filterByActor($this)->select('Categoryid')->find()->toArray();
	}

} // Actor
