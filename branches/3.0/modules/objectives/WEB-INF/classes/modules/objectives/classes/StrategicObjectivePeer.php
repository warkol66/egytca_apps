<?php


/**
 * Skeleton subclass for performing query and update operations on the 'objectives_strategic' table.
 *
 * Strategic Objective
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.objectives.classes
 */
class StrategicObjectivePeer extends BaseStrategicObjectivePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Strategic Objectives';

	private $dependency;
	private $searchString;
	private $guideline;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"guideline"=>"setSearchGuideline",
					"dependency"=>"setSearchDependency"
				);

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	/**
	 * Especifica el Id del afiliado.
	 * @param int Id del afiliado.
	 */
	public function setAffiliateId($affiliateId) {
		$this->affiliateId = $affiliateId;
	}

	/**
	 * Especifica el Id del afiliado.
	 * @param int Id del afiliado.
	 */
	public function setSearchGuideline($guideline) {
		$this->searchGuideline = $guideline;
	}

	/**
	* Crea un objective nuevo.
	*
	* @param string $name name del objective
	* @param int $affiliateId affiliateId del objective
	* @param int $description description del objective
	* @param string $date date del objective
	* @param string $expirationDate expirationDate del objective
	* @param int $achieved achieved del objective
	* @param string $notes notes del objective
	* @return boolean true si se creo el objective correctamente, false sino
	*/
	function create($strategicObjectiveInfo,$con = null)
	{
		$objectiveObj = new StrategicObjective();

		foreach ($strategicObjectiveInfo as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($objectiveObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$objectiveObj->$setMethod($value);
				else
					$objectiveObj->$setMethod(null);
			}
		}

		try {
			$objectiveObj->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}


	/**
	* Actualiza la informacion de un objective.
	*
	* @param int $id id del objective
	* @param array $strategicObjectiveInfo informacion del objective
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$strategicObjectiveInfo) {
		$objectiveObj = StrategicObjectivePeer::retrieveByPK($id);
		foreach ($strategicObjectiveInfo as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($objectiveObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$objectiveObj->$setMethod($value);
				else
					$objectiveObj->$setMethod(null);
			}
		}
		try {
			$objectiveObj->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina un objective a partir de los valores de la clave.
	*
	* @param int $id id del objective
	*	@return boolean true si se elimino correctamente el objective, false sino
	*/
	function delete($id) {
		$objectiveObj = StrategicObjectivePeer::retrieveByPK($id);
		$objectiveObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un objective.
	*
	* @param int $id id del objective
	* @return array Informacion del objective
	*/
	function get($id) {
		$objectiveObj = StrategicObjectivePeer::retrieveByPK($id);
		return $objectiveObj;
	}

	/**
	* Obtiene la informacion de un objective a partir de su nombre.
	*
	* @param string $name Nombre del objective
	* @return array Informacion del objective
	*/
	function getByName($name,$con = null) {
		$cond = new Criteria();
		$cond->add(StrategicObjectivePeer::NAME,$name);
		$objective = StrategicObjectivePeer::doSelectOne($cond,$con);
		return $objective;
	 }

	/**
	* Obtiene todos los objectives.
	*
	*	@return array Informacion sobre todos los objectives
	*/
	function getAll($affiliateId = null) {
		$cond = new Criteria();
		if ($affiliateId != null) {
			$cond->add(StrategicObjectivePeer::AFFILIATEID,$affiliateId);
		}
		$alls = StrategicObjectivePeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene todos los objectives paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @param int $idAffiliate Id de dependencencia, opcional para limitar la busqueda
	* @return array Informacion sobre todos los objectives
	*/
	function getAllPaginated($page=1,$perPage=-1,$idAffiliate = null) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		if ($idAffiliate != null)
			$cond->add(StrategicObjectivePeer::AFFILIATEID,$idAffiliate);
		$pager = new PropelPager($cond,"StrategicObjectivePeer", "doSelect",$page,$perPage);
		return $pager;
	 }


	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);

		if ($this->searchString)
			$criteria->add(StrategicObjectivePeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		if ($this->searchGuideline)
			$criteria->add(StrategicObjectivePeer::POLICYGUIDELINEID,$this->searchGuideline);

		if ($this->affiliateId)
			$criteria->add(StrategicObjectivePeer::AFFILIATEID,$this->affiliateId);

		return $criteria;

	}

	/**
	* Obtiene todas las activities paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los activities
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"StrategicObjectivePeer", "doSelect",$page,$perPage);
		return $pager;
	 }


} // StrategicObjectivePeer
