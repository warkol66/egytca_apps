<?php

/**
 * Class SegmentationClusterPeer
 *
 * @package SegmentationCluster
 */
class SegmentationClusterPeer extends BaseSegmentationClusterPeer {


	private $fields = array(
							RegistrationUserInfoPeer::GROUP => 'Grupo de Usuario',
							RegistrationUserInfoPeer::COUNTRY => 'País',
							RegistrationUserInfoPeer::OCCUPATION => 'Ocupación'
		);


	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		global $system;
		return $system["config"]["system"]["rowsPerPage"];
	}

	function getFields() {
		return $this->fields;
	}

	function getFieldsAndValues() {
		$fields = $this->fields;
	$fieldsAndValues = array();
	foreach ($fields as $fieldName => $field) {
		$fieldAndValues = array();
		$fieldAndValues["title"] = $field;
		$fieldAndValues["values"] = $this->getFieldValues($fieldName);
		$fieldAndValues["hasKey"] = $this->fieldHasKey($fieldName);
		$fieldsAndValues[$fieldName] = $fieldAndValues;
	}
	return $fieldsAndValues;
	}

	function getFieldValues($field) {
		$registrationUserInfoPeer = new RegistrationUserInfoPeer();
		switch ($field) {
			case RegistrationUserInfoPeer::GROUP: return $registrationUserInfoPeer->getGroups();
			case RegistrationUserInfoPeer::COUNTRY: return $registrationUserInfoPeer->getCountries();
		default: return "";
		}
	}

	function fieldHasKey($field) {
		switch ($field) {
			case RegistrationUserInfoPeer::GROUP: return true;
			case RegistrationUserInfoPeer::COUNTRY: return false;
		default: return false;
		}
	}

	/**
	* Crea un segmentation cluster nuevo.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se creo correctamente, false sino
	*/
	function create($params) {
		try {
			$segmentationclusterObj = new SegmentationCluster();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($segmentationclusterObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$segmentationclusterObj->$setMethod($value);
					else
						$segmentationclusterObj->$setMethod(null);
				}
			}
			$segmentationclusterObj->save();

		require_once("SegmentationClusterConditionPeer.php");

		foreach ($params["fields"] as $fieldName => $fieldValues) {
			for ($i=0;$i<count($fieldValues);$i++) {
				if (!empty($fieldValues[$i])) {
					$condition = array();
				$condition["segmentationClusterId"] = $segmentationclusterObj->getId();
				$condition["field"] = $fieldName;
				$condition["condition"] = $params["conditions"][$fieldName][$i];
				$condition["value"] = $fieldValues[$i];
					SegmentationClusterConditionPeer::create($condition);
				}
			}
		}

			return true;
		} catch (Exception $exp) {
			return false;
		}
	}

	/**
	* Actualiza la informacion de un segmentation cluster.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($params) {
		try {
			$segmentationclusterObj = SegmentationClusterPeer::retrieveByPK($params["id"]);
			if (empty($segmentationclusterObj))
				throw new Exception();
			foreach ($params as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($segmentationclusterObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$segmentationclusterObj->$setMethod($value);
					else
						$segmentationclusterObj->$setMethod(null);
				}
			}
			$segmentationclusterObj->save();

		require_once("SegmentationClusterConditionPeer.php");

		//borro primero los que estaban de antes
		$criteria = new Criteria();
		$criteria->add(SegmentationClusterConditionPeer::SEGMENTATIONCLUSTERID,$segmentationclusterObj->getId());
		SegmentationClusterConditionPeer::doDelete($criteria);

		foreach ($params["fields"] as $fieldName => $fieldValues) {
			for ($i=0;$i<count($fieldValues);$i++) {
				if (!empty($fieldValues[$i])) {
					$condition = array();
				$condition["segmentationClusterId"] = $segmentationclusterObj->getId();
				$condition["field"] = $fieldName;
				$condition["condition"] = $params["conditions"][$fieldName][$i];
				$condition["value"] = $fieldValues[$i];
					SegmentationClusterConditionPeer::create($condition);
				}
			}
		}

			return true;
		} catch (Exception $exp) {
			return false;
		}
	}

	/**
	* Elimina un segmentation cluster a partir de los valores de la clave.
	*
	* @param int $id id del segmentationcluster
	*	@return boolean true si se elimino correctamente el segmentationcluster, false sino
	*/
	function delete($id) {
		require_once("SegmentationClusterConditionPeer.php");
		$segmentationclusterObj = SegmentationClusterPeer::retrieveByPK($id);
		$segmentationclusterObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un segmentation cluster.
	*
	* @param int $id id del segmentationcluster
	* @return array Informacion del segmentationcluster
	*/
	function get($id) {
		$segmentationclusterObj = SegmentationClusterPeer::retrieveByPK($id);
		return $segmentationclusterObj;
	}

	/**
	* Obtiene todos los segmentation clusters.
	*
	*	@return array Informacion sobre todos los segmentationclusters
	*/
	function getAll() {
		$cond = new Criteria();
		$alls = SegmentationClusterPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene todos los segmentation clusters paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los segmentationclusters
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	SegmentationClusterPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"SegmentationClusterPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

}
