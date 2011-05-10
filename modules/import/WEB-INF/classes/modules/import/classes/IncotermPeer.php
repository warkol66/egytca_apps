<?php

// The parent class
require_once 'import/classes/om/BaseIncotermPeer.php';

// The object class
include_once 'import/classes/Incoterm.php';

/**
 * Class IncotermPeer
 *
 * @package Incoterm
 */
class IncotermPeer extends BaseIncotermPeer {

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
  * Crea un incoterm nuevo.
  *
  * @param string $name name del incoterm
  * @param string $description description del incoterm
  * @param int $active active del incoterm
  * @return boolean true si se creo el incoterm correctamente, false sino
	*/
	function create($name,$description) {
    $incotermObj = new Incoterm();
    $incotermObj->setname($name);
		$incotermObj->setdescription($description);
		$incotermObj->setactive('1');
		$incotermObj->save();
		return true;
	}

  /**
  * Actualiza la informacion de un incoterm.
  *
  * @param int $id id del incoterm
  * @param string $name name del incoterm
  * @param string $description description del incoterm
  * @param int $active active del incoterm
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name,$description) {
  	$incotermObj = IncotermPeer::retrieveByPK($id);
    $incotermObj->setname($name);
    $incotermObj->setdescription($description);
    $incotermObj->setactive('1');
    $incotermObj->save();
		return true;
  }

	/**
	* Elimina un incoterm a partir de los valores de la clave.
	*
  * @param int $id id del incoterm
	*	@return boolean true si se elimino correctamente el incoterm, false sino
	*/
  function delete($id) {
  	$incotermObj = IncotermPeer::retrieveByPK($id);
	$incotermObj->setactive('0');
	try {
		$incotermObj->save();
	}
	catch (PropelException $exp) {
		return false;
	}

	return true;

  }

  /**
  * Obtiene la informacion de un incoterm.
  *
  * @param int $id id del incoterm
  * @return array Informacion del incoterm
  */
  function get($id) {
		$incotermObj = IncotermPeer::retrieveByPK($id);
    return $incotermObj;
  }

  /**
  * Obtiene todos los incoterms.
	*
	*	@return array Informacion sobre todos los incoterms
  */
	function getAll() {
		$cond = new Criteria();
		$cond->add(IncotermPeer::ACTIVE, '1');
		$alls = IncotermPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los incoterms paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los incoterms
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	IncotermPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();
    $cond->add(IncotermPeer::ACTIVE, '1');     
    $pager = new PropelPager($cond,"IncotermPeer", "doSelect",$page,$perPage);
    return $pager;
   }    

	/**
	* Obtiene todos los incoterms inactivos.
	*	*	@return array Informacion sobre todos los incoterms
	*/
	function getAllInactive() {
		$cond = new Criteria();
		$cond->add(IncotermPeer::ACTIVE, '0');
		$alls = IncotermPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Activa un incoterm.
	*
	* @param int $id id del incoterm
	* @return true si fue exitoso, false sino
	*/
	function activate($id) {
		$incoterm = IncotermPeer::retrieveByPK($id);
		$incoterm->setActive(1);
		try {
			$incoterm->save();
		}
		catch(PropelException $exp) {
			return false;
		}
		return true;
	}
	

}
?>
