<?php


/**
 * Skeleton subclass for performing query and update operations on the 'objectives_policyGuideline' table.
 *
 * Policy Guidelines
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.objectives.classes
 */
class PolicyGuidelinePeer extends BasePolicyGuidelinePeer {


	/** the default item name for this class */
	const ITEM_NAME = 'Policy Guidelines';

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
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
	* Crea un objective nuevo.
	*
	* @param array $policyGuidelineParams array con info del eje de gestion
	* @return boolean true si se creo el objective correctamente, false sino
	*/
	function create($policyGuidelineParams,$con = null)
	{
		$policyObj = new PolicyGuideline();

		foreach ($policyGuidelineParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($policyObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$policyObj->$setMethod($value);
				else
					$policyObj->$setMethod(null);
			}
		}
		try {
			$policyObj->save($con);
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
	* @param string $name name del objective
	* @param string $description description del objective
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$policyGuidelineParams) {
		$policyObj = PolicyGuidelinePeer::get($id);
		
		foreach ($policyGuidelineParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($policyObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$policyObj->$setMethod($value);
				else
					$policyObj->$setMethod(null);
			}
		}
		try {
			$policyObj->save();
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
		$policyObj = PolicyGuidelinePeer::retrieveByPK($id);
		$policyObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un objective.
	*
	* @param int $id id del objective
	* @return array Informacion del objective
	*/
	function get($id) {
		$policyObj = PolicyGuidelinePeer::retrieveByPK($id);
		return $policyObj;
	}

	/**
	* Obtiene la informacion de un objective a partir de su nombre.
	*
	* @param string $name Nombre del objective
	* @return array Informacion del objective
	*/
	function getByName($name,$con = null) {
		$cond = new Criteria();
		$cond->add(PolicyGuidelinePeer::NAME,$name);
		$objective = PolicyGuidelinePeer::doSelectOne($cond,$con);
		return $objective;
	 }

	/**
	* Obtiene todos los objectives.
	*
	*	@return array Informacion sobre todos los objectives
	*/
	function getAll() {
		$cond = new Criteria();
		$alls = PolicyGuidelinePeer::doSelect($cond);
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
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"PolicyGuidelinePeer", "doSelect",$page,$perPage);
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
			$criteria->add(PolicyGuidelinePeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

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
		$pager = new PropelPager($cond,"PolicyGuidelinePeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	function getIncludePolicyGuidelinesHome() {
		$objectivePeer = new PolicyGuidelinePeer();
		$objectives = $objectivePeer->getAll();
		return $objectives;
	}
	
} // PolicyGuidelinePeer
