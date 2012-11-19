<?php



/**
 * Skeleton subclass for performing query and update operations on the 'positions_version' table.
 *
 * Versiones de organigramas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.positions.classes
 */
class PositionVersionQuery extends BasePositionVersionQuery {

 /**
	* Busca version vigente
	* @return version vigente
	*/
  public function getLastVersion() {
    return PositionVersionQuery::create()->orderById(Criteria::DESC)->findOne();
  }
  
  /**
   * Devuelve el id de la version vigente o 0 si no existe
   * @return id de la version vigente
   */
  public static function getLastVersionId() {
	  $lastVersion = PositionVersionQuery::create()->orderById(Criteria::DESC)->findOne();
	  return $lastVersion ? $lastVersion->getId() : 0;
  }

} // PositionVersionQuery
