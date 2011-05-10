<?php


/**
 * Class SegmentationClusterConditionPeer
 *
 * @package SegmentationClusterCondition
 */
class SegmentationClusterConditionPeer extends BaseSegmentationClusterConditionPeer {

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
	* Crea un segmentation cluster condition nuevo.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se creo correctamente, false sino
	*/
	function create($params) {
		try {
			$segmentationclusterconditionObj = new SegmentationClusterCondition();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($segmentationclusterconditionObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$segmentationclusterconditionObj->$setMethod($value);
					else
						$segmentationclusterconditionObj->$setMethod(null);
				}
			}
			$segmentationclusterconditionObj->save();
			return true;
		} catch (Exception $exp) {
			return false;
		}
	}

	/**
	* Actualiza la informacion de un segmentation cluster condition.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($params) {
		try {
			$segmentationclusterconditionObj = SegmentationClusterConditionPeer::retrieveByPK($params["id"]);
			if (empty($segmentationclusterconditionObj))
				throw new Exception();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($segmentationclusterconditionObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$segmentationclusterconditionObj->$setMethod($value);
					else
						$segmentationclusterconditionObj->$setMethod(null);
				}
			}
			$segmentationclusterconditionObj->save();
			return true;
		} catch (Exception $exp) {
			return false;
		}
	}

	/**
	* Elimina un segmentation cluster condition a partir de los valores de la clave.
	*
	* @param int $id id del segmentationclustercondition
	*	@return boolean true si se elimino correctamente el segmentationclustercondition, false sino
	*/
	function delete($id) {
		$segmentationclusterconditionObj = SegmentationClusterConditionPeer::retrieveByPK($id);
		$segmentationclusterconditionObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un segmentation cluster condition.
	*
	* @param int $id id del segmentationclustercondition
	* @return array Informacion del segmentationclustercondition
	*/
	function get($id) {
		$segmentationclusterconditionObj = SegmentationClusterConditionPeer::retrieveByPK($id);
		return $segmentationclusterconditionObj;
	}

	/**
	* Obtiene todos los segmentation cluster conditions.
	*
	*	@return array Informacion sobre todos los segmentationclusterconditions
	*/
	function getAll() {
		$cond = new Criteria();
		$alls = SegmentationClusterConditionPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene todos los segmentation cluster conditions paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los segmentationclusterconditions
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	SegmentationClusterConditionPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"SegmentationClusterConditionPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

}
