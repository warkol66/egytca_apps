<?php

// The parent class
require_once 'om/BaseRegionPeer.php';

// The object class
include_once 'Region.php';

/**
 * Class RegionPeer
 *
 * @package Region
 */
class RegionPeer extends BaseRegionPeer {

  /**
  * Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
  *
  * @return int Cantidad de filas por pagina
  */
  function getRowsPerPage() {
    global $system;
    return $system["config"]["system"]["rowsPerPage"];
  }

  /**
  * Crea un region nuevo.
  *
  * @param string $name name del region
  * @return boolean true si se creo el region correctamente, false sino
	*/
	function create($name) {
    try {
      $regionObj = new Region();
      $regionObj->setname($name);
      $regionObj->save();
      return true;
    } catch (PropelException $exp) {
      return false;
    }   
	}

  /**
  * Actualiza la informacion de un region.
  *
  * @param int $id id del region
  * @param string $name name del region
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name) {
    try {  
      $regionObj = RegionPeer::retrieveByPK($id);
      $regionObj->setname($name);
      $regionObj->save();
      return true;
    } catch (PropelException $exp) {
      return false;
    }        
  }

	/**
	* Elimina un region a partir de los valores de la clave.
	*
  * @param int $id id del region
	*	@return boolean true si se elimino correctamente el region, false sino
	*/
  function delete($id) {
  	$regionObj = RegionPeer::retrieveByPK($id);
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
		$regionObj = RegionPeer::retrieveByPK($id);
    return $regionObj;
  }
  
  /**
  * Obtiene la informacion de un region a partir de su nombre.
  *
  * @param string $name nombre 
  * @return array Region
  */
  function getByName($name) {
    $criteria = new Criteria();
    $sql = '( LOWER(lausi_region.name) = "'.strtolower($name).'" )';
    $criteria->add(RegionPeer::NAME,$sql,Criteria::CUSTOM);     
    $region = RegionPeer::doSelectOne($criteria);
    return $region;
  }   

  /**
  * Obtiene todos los regions.
	*
	*	@return array Informacion sobre todos los regions
  */
	function getAll() {
		$cond = new Criteria();
		$alls = RegionPeer::doSelect($cond);
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
      $perPage = 	RegionPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"RegionPeer", "doSelect",$page,$perPage);
    return $pager;
   }    

}
