<?php



/**
 * Skeleton subclass for performing query and update operations on the 'actors_actorsCategory' table.
 *
 * Relacion Actores y Categorias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.actors.classes
 */
class ActorCategoryRelationPeer extends BaseActorCategoryRelationPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Actors-Category Relations';

	private  $actorId;
	private  $categoryId;

	/**
	 * Especifica el Id del Indicador.
	 * @param int Id del Indicador.
	 */
	public function setActorId($actorId) {
		$this->actorId = $actorId;
	}

	/**
	 * Especifica el Id de la Categoria.
	 * @param int Id del Categoria.
	 */
	public function setCategoryId($categoryId) {
		$this->categoryId = $categoryId;
	}

	/**
	* Elimina un actor a partir de los valores de la clave.
	*
	* @param int $id id del actor
	*	@return boolean true si se elimino correctamente el actor, false sino
	*/
  function delete($actorId,$categoryId) {
    $cond = new Criteria();
    $cond->add(ActorCategoryRelationPeer::ACTORID,$actorId);
    $cond->add(ActorCategoryRelationPeer::CATEGORYID,$categoryId);

    $relation = ActorCategoryRelationPeer::doSelectOne($cond);

    try {
      $relation->delete();
    }
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}

    return true;
  }

} // ActorCategoryRelationPeer
