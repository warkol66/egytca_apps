<?php

/**
 * Class UnitPeer
 *
 * @package Unit
 */
class UnitPeer extends BaseUnitPeer {

  /**
  * Crea un unit nuevo.
  *
  * @param string $name name del unit
  * @param int $unitQuantity del unit  
  * @return boolean true si se creo el unit correctamente, false sino
	*/
	function create($name,$unitQuantity) {
    $unitObj = new Unit();
    $unitObj->setname($name);
    $unitObj->setUnitQuantity($unitQuantity);
		$unitObj->save();
		return true;
	}

  /**
  * Actualiza la informacion de un unit.
  *
  * @param int $id id del unit
  * @param string $name name del unit
  * @param int $unitQuantity del unit    
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name,$unitQuantity) {
  	$unitObj = UnitPeer::retrieveByPK($id);
    $unitObj->setname($name);    
    $unitObj->setUnitQuantity($unitQuantity);
		$unitObj->save();
		return true;
  }

	/**
	* Elimina un unit a partir de los valores de la clave.
	*
  * @param int $id id del unit
	*	@return boolean true si se elimino correctamente el unit, false sino
	*/
  function delete($id) {
  	$unitObj = UnitPeer::retrieveByPK($id);
    $unitObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un unit.
  *
  * @param int $id id del unit
  * @return array Informacion del unit
  */
  function get($id) {
		$unitObj = UnitPeer::retrieveByPK($id);
    return $unitObj;
  }

  /**
  * Obtiene todos los units.
	*
	*	@return array Informacion sobre todos los units
  */
	function getAll() {
		$cond = new Criteria();
		$alls = UnitPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene un unit en base a su nombre.
	*
	* @param string $name Nombre de la unidad
	*	@return Unit Unidad con el nombre pasado como parametro
  */
	function getByName($name) {
		$cond = new Criteria();
		$cond->add(UnitPeer::NAME, $name);
		$cond->setIgnoreCase(true);
		$alls = UnitPeer::doSelect($cond);
		return $alls[0];
  }

}
