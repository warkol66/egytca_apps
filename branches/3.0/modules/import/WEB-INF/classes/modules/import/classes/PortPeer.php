<?php

// The parent class
require_once 'import/classes/om/BasePortPeer.php';

// The object class
include_once 'import/classes/Port.php';

/**
 * Class PortPeer
 *
 * @package Port
 */
class PortPeer extends BasePortPeer {

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
  * Crea un port nuevo.
  *
  * @param string $code code del port
  * @param string $name name del port
  * @return boolean true si se creo el port correctamente, false sino
	*/
	function create($code,$name) {
    $portObj = new Port();
    $portObj->setcode($code);
		$portObj->setname($name);
		$portObj->setactive('1');
		$portObj->save();
		return true;
	}

  /**
  * Actualiza la informacion de un port.
  *
  * @param int $id id del port
  * @param string $code code del port
  * @param string $name name del port  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$code,$name) {
  	$portObj = PortPeer::retrieveByPK($id);
	$portObj->setcode($code);
	$portObj->setname($name);
	$portObj->setactive('1');
	$portObj->save();
	return true;
  }

	/**
	* Elimina un port a partir de los valores de la clave.
	*
  * @param int $id id del port
	*	@return boolean true si se elimino correctamente el port, false sino
	*/
  function delete($id) {
  	$portObj = PortPeer::retrieveByPK($id);
    	$portObj->setactive('0');
	try {
		$portObj->save();
	}
	catch (PropelException $exp) {
		return false;
	}
	return true;
  }

  /**
  * Obtiene la informacion de un port.
  *
  * @param int $id id del port
  * @return array Informacion del port
  */
  function get($id) {
		$portObj = PortPeer::retrieveByPK($id);
    return $portObj;
  }

  /**
  * Obtiene todos los ports.
	*
	*	@return array Informacion sobre todos los ports
  */
	function getAll() {
		$cond = new Criteria();
		$cond->add(PortPeer::ACTIVE, '1');
		$alls = PortPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los ports paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los ports
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	PortPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();
    $cond->add(PortPeer::ACTIVE, '1');
    $pager = new PropelPager($cond,"PortPeer", "doSelect",$page,$perPage);
    return $pager;
   }    

	/**
	* Obtiene todos los ports que estan inactivos.
	*
	*	@return array Informacion sobre todos los ports
	*/
	function getAllInactive() {
		$cond = new Criteria();
		$cond->add(PortPeer::ACTIVE, '0');
		$alls = PortPeer::doSelect($cond);
		return $alls;
	}
	
	/**
	 * Activa un puerto
	 * @param $id id del puerto
	 * @return true si fue exitoso, false sino
	 */
	function activate($id) {
		$port = PortPeer::retrieveByPK($id);
		$port->setActive(1);
		try {
			$port->save();
		}
		catch(PropelException $exp) {
			return false;
		}
		
		return true;
	}


}
?>
