<?php


// The object class
include_once ('tablero/classes/TableroRegion.php');

/**
 * Skeleton subclass for performing query and update operations on the 'tablero_region' table.
 *
 * Barrios
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroRegionPeer extends BaseTableroRegionPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Regions';

  /**
  * Crea un region nuevo.
  *
  * @param string $name name del region
  * @param Connection $con [optional] Conexion a la db
  * @return boolean true si se creo el region correctamente, false sino
  */
  function create($name,$con = null) {
    $regionObj = new TableroRegion();
    $regionObj->setname($name);
    $regionObj->save($con);
    return true;
  }

  /**
  * Actualiza la informacion de un region.
  *
  * @param int $id id del region
  * @param string $name name del region
  * @return boolean true si se actualizo la informacion correctamente, false sino
  */
  function update($id,$name) {
    $regionObj = TableroRegionPeer::retrieveByPK($id);
    $regionObj->setname($name);
    $regionObj->save();
    return true;
  }

  /**
  * Elimina un region a partir de los valores de la clave.
  *
  * @param int $id id del region
  *	@return boolean true si se elimino correctamente el region, false sino
  */
  function delete($id) {
    $regionObj = TableroRegionPeer::retrieveByPK($id);
    $regionObj->delete();
    return true;
  }

  /**
  * Obtiene la informacion de un region.
  *
  * @param int $id id del region
  * @return array Informacion del region
  */
  function get($id) {
    $regionObj = TableroRegionPeer::retrieveByPK($id);
    return $regionObj;
  }

  /**
  * Obtiene todos los regions.
  *
  *	@return array Informacion sobre todos los regions
  */
  function getAll() {
    $cond = new Criteria();
    $alls = TableroRegionPeer::doSelect($cond);
    return $alls;
  }

  /**
  * Obtiene todos los regions paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los regions
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	Common::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"TableroRegionPeer", "doSelect",$page,$perPage);
    return $pager;
   }    

} // TableroRegionPeer
