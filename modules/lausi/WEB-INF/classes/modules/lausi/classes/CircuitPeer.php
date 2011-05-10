<?php

/**
 * Class CircuitPeer
 *
 * @package Circuit
 */
class CircuitPeer extends BaseCircuitPeer {

	/**
	 * Elimina un circuit a partir de los valores de la clave.
	 *
	 * @param int $id id del circuit
	 * @return boolean true si se elimino correctamente el circuit, false sino
	 */
	function delete($id) {
		return CircuitPeer::create()->filterByPrimaryKey($id)->delete();
  	}

	/**
	 * Obtiene la informacion de un circuit.
	 *
	 * @param int $id id del circuit
	 * @return array Informacion del circuit
	 */
	function get($id) {
		return CircuitQuery::create()->findPk($id);
	}
  
	/**
	 * Obtiene la informacion de un circuit a partir de su nombre.
	 *
	 * @param string $name nombre del circuit  
	 * @return array Informacion del circuit
	 */
	function getByName($name) {
		return CircuitQuery::create()->filterByName($name)->find();
	}  

	/**
	 * Obtiene todos los circuits.
	 *
	 *	@return array Informacion sobre todos los circuits
	 */
	function getAll() {
		return CircuitQuery::create()->find();
	}
  
	/**
	 * Obtiene todos los circuits paginados.
	 *
	 * @param int $page [optional] Numero de pagina actual
	 * @param int $perPage [optional] Cantidad de filas por pagina
	 * @return array Informacion sobre todos los circuits
	 */
	function getAllPaginated($page=1,$perPage=-1) {  
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new CircuitQuery();     
		$pager = new PropelPager($cond,"CircuitPeer", "doSelect",$page,$perPage);
		return $pager;
	}    
}
