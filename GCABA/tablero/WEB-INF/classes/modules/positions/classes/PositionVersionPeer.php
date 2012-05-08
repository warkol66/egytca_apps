<?php



/**
 * Skeleton subclass for performing query and update operations on the 'positions_version' table.
 *
 * Versiones de organigramas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.positions.classes
 */
class PositionVersionPeer extends BasePositionVersionPeer {

	/**
	* Obtiene todos los positions paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los positions
	*/
	function getAllPaginated($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"PositionVersionPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	public function get($id){
		$positionVersion = PositionVersionPeer::retrieveByPK($id);
		return $positionVersion;
	}	 
	 
} // PositionVersionPeer
