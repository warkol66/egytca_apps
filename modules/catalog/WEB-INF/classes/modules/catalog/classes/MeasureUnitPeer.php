<?php

/**
 * Class MeasureUnitPeer
 *
 * @package MeasureUnit
 */
class MeasureUnitPeer extends BaseMeasureUnitPeer {

  /**
  * Crea un measure unit nuevo.
  *
  * @param string $name name del measureunit
  * @return boolean true si se creo el measureunit correctamente, false sino
	*/
	function create($name) {
    $measureunitObj = new MeasureUnit();
    $measureunitObj->setname($name);
		$measureunitObj->save();
		return true;
	}

  /**
  * Actualiza la informacion de un measure unit.
  *
  * @param int $id id del measureunit
  * @param string $name name del measureunit
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name) {
  	$measureunitObj = MeasureUnitPeer::retrieveByPK($id);
    $measureunitObj->setname($name);    
		$measureunitObj->save();
		return true;
  }

	/**
	* Elimina un measure unit a partir de los valores de la clave.
	*
  * @param int $id id del measureunit
	*	@return boolean true si se elimino correctamente el measureunit, false sino
	*/
  function delete($id) {
  	$measureunitObj = MeasureUnitPeer::retrieveByPK($id);
    $measureunitObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un measure unit.
  *
  * @param int $id id del measureunit
  * @return array Informacion del measureunit
  */
  function get($id) {
		$measureunitObj = MeasureUnitPeer::retrieveByPK($id);
    return $measureunitObj;
  }

  /**
  * Obtiene todos los measure units.
	*
	*	@return array Informacion sobre todos los measureunits
  */
	function getAll() {
		$cond = new Criteria();
		$alls = MeasureUnitPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene un measure unit en base a su nombre.
	*
	* @param string $name Nombre de la unidad de medida
	*	@return MeasureUnit Unidad de medida con el nombre pasado como parametro
  */
	function getByName($name) {
		$cond = new Criteria();
		$cond->add(MeasureUnitPeer::NAME, $name);
		$cond->setIgnoreCase(true);
		$alls = MeasureUnitPeer::doSelect($cond);
		return $alls[0];
  }

}
