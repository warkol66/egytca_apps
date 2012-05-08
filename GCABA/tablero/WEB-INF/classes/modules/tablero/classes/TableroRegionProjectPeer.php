<?php


// include object class
include_once 'tablero/classes/TableroRegionProject.php';


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_regionProject' table.
 *
 * Asociacion entre Barrios y Proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroRegionProjectPeer extends BaseTableroRegionProjectPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Regions-Projects Relations';

  /**
   * Elimina una relacion entre un barrio y proyecto
   * @param $projectId id del proyecto
   * @param $regionId id de la barrio
   */
  function delete($projectId,$regionId) {
    $cond = new Criteria();
    $cond->add(TableroRegionProjectPeer::PROJECTID,$projectId);
    $cond->add(TableroRegionProjectPeer::REGIONID,$regionId);

    $relation = TableroRegionProjectPeer::doSelectOne($cond);

    try {
      $relation->delete();
    }
    catch (PropelException $exp) {
      return false;
    }

    return true;
  }

} // TableroRegionProjectPeer
