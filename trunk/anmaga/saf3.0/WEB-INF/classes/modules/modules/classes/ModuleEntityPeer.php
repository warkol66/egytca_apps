<?php


/**
 * Skeleton subclass for performing query and update operations on the 'modules_entity' table.
 *
 * Entidades de modulos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.modules.classes
 */
class ModuleEntityPeer extends BaseModuleEntityPeer {

	private $searchString;
	private $limit;
	private $searchModule;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"limit" => "setLimit",
					"searchModule"=>"setSearchModule"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

 /**
	 * Especifica un objetivo para la busqueda
	 * @param $objectiveId id de objetivo
	 */
	function setSearchModule($moduleName){
		$this->searchModule = $moduleName;
	}
	
 	/**
	 * Especifica una cantidad maxima de registros.
	 * @param limit cantidad maxima de registros.
	 */
	function setLimit($limit){
		$this->limit = $limit;
	}

	/**
	* Devuelve el entity
	* @param integer $id id de la entidad
	* @return entidad
	*/
	public function get($id){
		$entity = ModuleEntityPeer::retrieveByPk($id);
		return $entity;
	}

 /**
	* Crea un entity nuevo.
	*
	* @param array $paramsEntity con los datos de la entidad
	* @return boolean true si se creo el entity correctamente, false sino
	*/
	function create($paramsEntity,$con = null){
		$entityObj = new ModuleEntity();
		foreach ($paramsEntity as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($entityObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$entityObj->$setMethod($value);
				else
					$entityObj->$setMethod(null);
			}
		}
		try {
			$entityObj->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Actualiza la informacion de un entity.
	*
	* @param int $id id del entity
	* @param array $paramsEntity con los datos de la entidad
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$paramsEntity){
		$entityObj = ModuleEntityPeer::get($id);
		foreach ($paramsEntity as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($entityObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$entityObj->$setMethod($value);
				else
					$entityObj->$setMethod(null);
			}
		}
		try {
			$entityObj->save();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
		}
	}

 /**
	 * Retorna el criteria generado a partir de los par�metros de b�squeda
	 *
	 * @return criteria $criteria Criteria con par�metros de b�squeda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->setLimit($this->limit);

		if ($this->searchString) {
			$criterionString = $criteria->getNewCriterion(ModuleEntityPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionString->addOr($criteria->getNewCriterion(ModuleEntityPeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE));
			$criterionString->addOr($criteria->getNewCriterion(ModuleEntityPeer::PHPNAME,"%" . $this->searchString . "%",Criteria::LIKE));
			$criteria->addAnd($criterionString);		
		}
		if (!empty($this->searchModule))
			$criteria->add(ModuleEntityPeer::MODULENAME, $this->searchModule);

		return $criteria;
	}

	/**
	* Obtiene todas las entidades.
	*
	*	@return array Todos los objetos entidades
	*/
	function getAll(){
		$criteria = ModuleEntityPeer::getSearchCriteria();
		$allObjects = ModuleEntityPeer::doSelect($criteria);
		return $allObjects;
	}

	/**
	* Obtiene todos los modulos
	*
	*	@return array Todos los modulos posibles
	*/
	function getAllModules(){
		$criteria = new Criteria();
		$criteria->clearSelectColumns();
		$criteria->addSelectColumn(ModuleEntityPeer::MODULENAME);
		$criteria->setDistinct();
		$stmt = ModuleEntityPeer::doSelectStmt($criteria);
		$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $modules;
	}

	/**
	* Obtiene todos los regions paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los regions
	*/
	function getAllPaginated($page=1, $perPage=-1){
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria, "ModuleEntityPeer", "doSelect", $page, $perPage);
		return $pager;
	}


} // ModuleEntityPeer
