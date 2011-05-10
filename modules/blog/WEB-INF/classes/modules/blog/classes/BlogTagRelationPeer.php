<?php



/**
 * Skeleton subclass for performing query and update operations on the 'blog_tagRelation' table.
 *
 * Asociacion entre Entradas y Etiquetas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.blog.classes
 */
class BlogTagRelationPeer extends BaseBlogTagRelationPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Entry-Tags Relations';

	private  $entryId;
	private  $tagId;

	/**
	 * Especifica el Id del Indicador.
	 * @param int Id del Indicador.
	 */
	public function setEntryId($entryId) {
		$this->entryId = $entryId;
	}

	/**
	 * Especifica el Id de la Categoria.
	 * @param int Id del Categoria.
	 */
	public function setTagId($tagId) {
		$this->tagId = $tagId;
	}
	/**
	* Crea un indicator nuevo.
	*
	* @param string $name name del indicator
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo el indicator correctamente, false sino
	*/
	function create($relationParams)
	{
		$relationObj = new BlogTagRelation();
		foreach ($relationParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($relationObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$relationObj->$setMethod($value);
				else
					$relationObj->$setMethod(null);
			}
		}

		try {
			$relationObj->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina un indicator a partir de los valores de la clave.
	*
	* @param int $id id del indicator
	*	@return boolean true si se elimino correctamente el indicator, false sino
	*/
  function delete($entryId,$tagId)
  {
    $cond = new Criteria();
    $cond->add(BlogTagRelationPeer::ENTRYID,$entryId);
    $cond->add(BlogTagRelationPeer::TAGID,$tagId);

    $relation = BlogTagRelationPeer::doSelectOne($cond);

    try {
      $relation->delete();
    }
    catch (PropelException $exp) {
      return false;
    }

    return true;
  }

	/**
	* Obtiene la informacion de un indicator.
	*
	* @param int $id id del indicator
	* @return array Informacion del indicator
	*/
	function get($id)
	{
		$relationObj = BlogTagRelationQuery::create()->findPk($id);
		return $relationObj;
	}

	/**
	* Obtiene todos los indicators.
	*
	*	@return array Informacion sobre todos los indicators
	*/
	function getAll()
	{
		$indicators = BlogTagRelationQuery::create()->find();
		return $indicators;
	}

} // BlogTagRelationPeer
