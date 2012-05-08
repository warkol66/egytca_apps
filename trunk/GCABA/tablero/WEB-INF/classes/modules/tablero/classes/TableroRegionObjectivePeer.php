<?php


// include object class
include_once ('tablero/classes/TableroRegionObjective.php');


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_regionObjective' table.
 *
 * Asociacion entre Barrios y Objetivos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroRegionObjectivePeer extends BaseTableroRegionObjectivePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Regions-Objecttives Relations';

	private  $objectiveId;
	private  $regionId;

	/**
	 * Especifica el Id del Objetivo.
	 * @param int Id del Objetivo.
	 */
	public function setObjectiveId($objectiveId) {
		$this->objectiveId = $objectiveId;
	}

	/**
	 * Especifica el Id del Documento.
	 * @param int Id del Documento.
	 */
	public function setRegionId($regionId) {
		$this->regionId = $regionId;
	}

  /**
  * Crea una una relacion entre un documento y un objetivo
  *
   * @param $objectiveId id del objetivo
   * @param $regionId id de la region
  * @return boolean true si se creo la relacion correctamente, false sino
	*/
	function create($objectiveId,$regionId) {
    $relationObj = new TableroRegionObjective();
    $relationObj->setObjectiveId($objectiveId);
		$relationObj->setRegionId($regionId);
    try {
		  $relationObj->save();
      return true;
    } catch (PropelException $exp) {
      return false;
    }
	}

 /**
   * Elimina una relacion entre un barrio y proyecto
   * @param $objectiveId id del proyecto
   * @param $regionId id de la barrio
   */
  function delete($objectiveId,$regionId) {
    $cond = new Criteria();
    $cond->add(TableroRegionObjectivePeer::OBJECTIVEID,$objectiveId);
    $cond->add(TableroRegionObjectivePeer::REGIONID,$regionId);

    $relation = TableroRegionObjectivePeer::doSelectOne($cond);

    try {
      $relation->delete();
    }
    catch (PropelException $exp) {
      return false;
    }

    return true;
  }


} // TableroRegionObjectivePeer
