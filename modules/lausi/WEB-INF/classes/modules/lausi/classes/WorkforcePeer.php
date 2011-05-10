<?php

/**
 * Class WorkforcePeer
 *
 * @package Workforce
 */
class WorkforcePeer extends BaseWorkforcePeer {

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
  * Crea un workforce nuevo.
  *
  * @param string $name name del workforce
  * @param string $telephone telephone del workforce
  * @param int $workInHeight workInHeight del workforce
  * @return boolean true si se creo el workforce correctamente, false sino
	*/
	function create($name,$telephone,$workInHeight) {

		$workforceObj = new Workforce();
		$workforceObj->setname($name);
		$workforceObj->settelephone($telephone);
		$workforceObj->setworkInHeight($workInHeight);
		
		try {
			$workforceObj->save();
		}
		catch(PropelException $exp) {
			return false;
		}
		
		return $workforceObj;
	}

  /**
  * Actualiza la informacion de un workforce.
  *
  * @param int $id id del workforce
  * @param string $name name del workforce
  * @param string $telephone telephone del workforce
  * @param int $workInHeight workInHeight del workforce
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name,$telephone,$workInHeight) {
  	$workforceObj = WorkforcePeer::retrieveByPK($id);
    $workforceObj->setname($name);
    $workforceObj->settelephone($telephone);
    $workforceObj->setworkInHeight($workInHeight);
    $workforceObj->save();
		return true;
  }

	/**
	* Elimina un workforce a partir de los valores de la clave.
	*
  * @param int $id id del workforce
	*	@return boolean true si se elimino correctamente el workforce, false sino
	*/
  function delete($id) {
  	$workforceObj = WorkforcePeer::retrieveByPK($id);
    $workforceObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un workforce.
  *
  * @param int $id id del workforce
  * @return array Informacion del workforce
  */
  function get($id) {
		$workforceObj = WorkforcePeer::retrieveByPK($id);
    return $workforceObj;
  }

  /**
  * Obtiene todos los workforces.
	*
	*	@return array Informacion sobre todos los workforces
  */
	function getAll() {
		$cond = new Criteria();
		$alls = WorkforcePeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los workforces que no están asignados aun circuito.
	*
	*	@return array Collección de workforces asignables a un circuito
  */
	function getCircuitCandidates($circuit) {
		$assignedWorforces = $circuit->getWorkforces();
		$assignedIds = array();
		foreach ($assignedWorforces as $assignedWorforce)
			$assignedIds[] = $assignedWorforce->getId();

		$candidates = WorkforceQuery::create();
		$candidates->add(WorkforcePeer::ID, $assignedIds, Criteria::NOT_IN);
		$candidates = $candidates->find();

		return $candidates;
  }

  /**
  * Obtiene todos los workforces paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los workforces
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	WorkforcePeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"WorkforcePeer", "doSelect",$page,$perPage);
    return $pager;
   }    

}
