<?php

// The object class
include_once 'tablero/TableroCommune.php';


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_commune' table.
 *
 * Comunas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroCommunePeer extends BaseTableroCommunePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Communes';

  /**
  * Crea un commune nuevo.
  *
  * @param string $name name del commune
  * @return boolean true si se creo el commune correctamente, false sino
	*/
	function create($name) {
    $communeObj = new TableroCommune();
    $communeObj->setname($name);
		$communeObj->save();
		return true;
	}

  /**
  * Actualiza la informacion de un commune.
  *
  * @param int $id id del commune
  * @param string $name name del commune
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name) {
  	$communeObj = TableroCommunePeer::retrieveByPK($id);
    $communeObj->setname($name);
    $communeObj->save();
		return true;
  }

	/**
	* Elimina un commune a partir de los valores de la clave.
	*
  * @param int $id id del commune
	*	@return boolean true si se elimino correctamente el commune, false sino
	*/
  function delete($id) {
  	$communeObj = TableroCommunePeer::retrieveByPK($id);
    $communeObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un commune.
  *
  * @param int $id id del commune
  * @return array Informacion del commune
  */
  function get($id) {
		$communeObj = TableroCommunePeer::retrieveByPK($id);
    return $communeObj;
  }

  /**
  * Obtiene todos los communes.
	*
	*	@return array Informacion sobre todos los communes
  */
	function getAll() {
		$cond = new Criteria();
		$alls = TableroCommunePeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los communes paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los communes
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	Common::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"TableroCommunePeer", "doSelect",$page,$perPage);
    return $pager;
   }    

} // TableroCommunePeer
