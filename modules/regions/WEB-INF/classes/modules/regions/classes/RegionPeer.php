<?php

/**
 * Skeleton subclass for performing query and update operations on the 'regions_regions' table.
 *
 * Regiones
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.regions.classes
 */
class RegionPeer extends BaseRegionPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Regions';

	const CONTINENT    = 1;
	const BLOQUE       = 2;
	const COUNTRY      = 3;
	const SUBREGION    = 4;
	const STATE        = 5;
	const COUNTY       = 6;
	const DISTRICT     = 7;
	const MUNICIPALITY = 8;
	const CITY         = 9;
	const TOWN         = 10;
	const COMMUNE      = 11;
	const NEIGHBORHOOD = 12;
	const POSTAL_CODE  = 13;

	//nombre de los tipos de region
	protected static $regionTypes = array(
						RegionPeer::CONTINENT    => 'Continent',
						RegionPeer::BLOQUE       => 'Bloque',
						RegionPeer::COUNTRY      => 'Country',
						RegionPeer::SUBREGION    => 'Subregion',
						RegionPeer::STATE        => 'State',
						RegionPeer::COUNTY       => 'County',
						RegionPeer::DISTRICT     => 'District',
						RegionPeer::MUNICIPALITY => 'Municipality',
						RegionPeer::CITY         => 'City',
						RegionPeer::TOWN         => 'Town',
						RegionPeer::COMMUNE      => 'Commune',
						RegionPeer::NEIGHBORHOOD => 'Neighborhood',
						RegionPeer::POSTAL_CODE  => 'Postal code',
					);

	//opciones de filtrado
	private  $type;
	private  $postalCode;
	private  $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"postalCode"=>"setPostalCode",
					"type"=>"setSearchType"
				);

	/**
	 * Devuelve los tipos de region
	 */
	public static function getRegionTypes()	{
		$regionTypes = RegionPeer::$regionTypes;
		$activeRegionTypes = ConfigModule::get("regions","activeRegionTypes");
		$regionTypes = array_intersect_key($regionTypes,$activeRegionTypes);
		return $regionTypes;
	}

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	/**
	 * Especifica el tipo de region.
	 * @param int tipo de region.
	 */
	public function setSearchType($type) {
		$this->searchType = $type;
	}

	/**
	 * Especifica el tipo de region.
	 * @param int tipo de region.
	 */
	public function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;
	}

	/**
	 * Devuelve los nombres de los tipo de region traducidas
	 */
	public function getRegionTypesTranslated() {
		$regionTypes = RegionPeer::getRegionTypes();

		foreach(array_keys($regionTypes) as $key)
			if ($key >= ConfigModule::get("regions","treeRootType"))
				$regionTypesTranslated[$key] = Common::getTranslation($regionTypes[$key],'regions');

		return $regionTypesTranslated;
	}

	/**
	* Devuelve la region
	* @param integer $id id de la region
	* @return region
	*/
	public function get($id) {
		$region = RegionPeer::retrieveByPK($id);
		return $region;
	}

	/**
	* Crea un region nuevo.
	*
	* @param string $name name del region
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo el region correctamente, false sino
	*/
	function create($regionParams) {
		$regionObj = new Region();
		foreach ($regionParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($regionObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$regionObj->$setMethod($value);
				else
					$regionObj->$setMethod(null);
			}
		}

		$parentNode = RegionQuery::create()->findPk($regionParams[parentId]);

		if (empty($parentNode))
			$regionObj->makeRoot();
		else
			$regionObj->insertAsLastChildOf($parentNode);

		try {
			$regionObj->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un region.
	*
	* @param int $id id del region
	* @param string $name name del region
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$regionParams) {
		$regionObj = RegionQuery::create()->findPk($id);
		foreach ($regionParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($regionObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$regionObj->$setMethod($value);
				else
					$regionObj->$setMethod(null);
			}
		}

		try {
			$regionObj->save();
			$parentNode = $regionObj->getParent();
			if ($parentNode->getId() != $regionParams[parentId]) {
				$newParentNode = RegionQuery::create()->findPk($regionParams[parentId]);
				$regionObj->moveToLastChildOf($newParentNode);
			}

			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina un region a partir de los valores de la clave.
	*
	* @param int $id id del region
	*	@return boolean true si se elimino correctamente el region, false sino
	*/
	function delete($id) {
		$regionObj = RegionQuery::create()->findPk($id);
		$regionObj->delete();
		return true;
	}

	/**
	* Obtiene todos los regions.
	*
	*	@return array Informacion sobre todos los regions
	*/
	function getAll() {
		$regions = RegionQuery::create()->find();
		return $regions;
	}

	/**
	* Obtiene todos los regions.
	*
	*	@return array Informacion sobre todos los regions
	*/
	function getAllByType($type) {
		$regions = RegionQuery::create()
			->filterByType($type)
			->find();
		return $regions;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de regi�n.
	*
	*	@param int $type  Tipo de región
	*	@return array Posibles padres a partir de un tipo de regi�n
	*/
	function getAllPossibleParentsByType($type) {
		$treeRoot = RegionQuery::create()->findRoot();
		if (!empty($treeRoot))
			$regions = RegionQuery::create()
			->orderByBranch()
			->filterByType(array(
				 'min' => ConfigModule::get("regions","treeRootType"),
				 'max' => $type-1,
			))
			->findTree($treeRoot->getScope());
		else
			return;

		return $regions;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de regi�n.
	*
	*	@return array Posibles padres a partir de un tipo de regi�n
	*/
	function getAllPossibleParents() {
//$time_start = microtime(true);

// Query con condiciones
/*		$regions = RegionQuery::create()
			->setFormatter('PropelStatementFormatter') // Para ver el query
			->orderByType()
			->orderByParentid()
			->orderByName()
			->condition('cond1', 'Region.Type >= ?', RegionPeer::LOWEST_TYPE) 				// create a condition named 'cond1'
			->condition('cond2', 'Region.Type <= ?', RegionPeer::HIGHEST_TYPE)       	// create a condition named 'cond2'
			->where(array('cond1', 'cond2'), 'and')          // combine 'cond1' and 'cond2' with a logical OR
			->find();
	print_r($regions);die;
*/

//Query con filterBy
/*		$regions = RegionQuery::create()
			->orderByType()
			->orderByParentid()
			->orderByName()
			->filterByType(array(
				 'min' => RegionPeer::LOWEST_TYPE,
				 'max' => RegionPeer::HIGHEST_TYPE,
			 ))
			->find();
*/

// Query con codig diferente
/*		$query = RegionQuery::create();
		$query->orderByType();
		$query->orderByParentid();
		$query->orderByName();
		$query->filterByType(array(
				 'min' => RegionPeer::LOWEST_TYPE,
				 'max' => RegionPeer::HIGHEST_TYPE,
			 ));
		$regions = $query->find();
*/
//  Usando el Query con codign tipo Criteria
/*		$regions = RegionQuery::create();
		$regions->add(RegionPeer::TYPE, RegionPeer::LOWEST_TYPE, Criteria::GREATER_EQUAL);
		$regions->addAnd(RegionPeer::TYPE, RegionPeer::HIGHEST_TYPE, Criteria::LESS_EQUAL);
		$regions->addAscendingOrderByColumn(RegionPeer::TYPE);
		$regions->addAscendingOrderByColumn(RegionPeer::PARENTID);
		$regions->addAscendingOrderByColumn(RegionPeer::NAME);
		$regions->find();
*/

// Criteria tradicional
/*		$criteria = new Criteria();
		$criteria->add(RegionPeer::TYPE, RegionPeer::LOWEST_TYPE, Criteria::GREATER_EQUAL);
		$criteria->addAnd(RegionPeer::TYPE, RegionPeer::HIGHEST_TYPE, Criteria::LESS_EQUAL);
		$criteria->addAscendingOrderByColumn(RegionPeer::TYPE);
		$criteria->addAscendingOrderByColumn(RegionPeer::PARENTID);
		$criteria->addAscendingOrderByColumn(RegionPeer::NAME);
		$regions = RegionPeer::doSelect($criteria);
*/

		$treeRoot = RegionQuery::create()->findRoot();
		if (!empty($treeRoot))
		$regions = RegionQuery::create()
		->descendantsOf($treeRoot)
		->orderByBranch()
		->filterByType(array(
			 'min' => ConfigModule::get("regions","treeRootType"),
			 'max' => ConfigModule::get("regions","highestType"),
		))
		->find();
		else
			return;

/*
$time_end = microtime(true);
$time = $time_end - $time_start;
echo "Execution time: $time seconds\n";die;
*/
		return $regions;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de regi�n.
	*
	*	@return array Posibles padres a partir de un tipo de regi�n
	*/
	function getAllParentsByRegionType($type) {
		$treeRoot = RegionQuery::create()->findRoot();
		if (!empty($treeRoot))
			$regions = RegionQuery::create()
			->orderByBranch()
			->filterByType(array(
				 'min' => ConfigModule::get("regions","treeRootType"),
				 'max' => $type-1,
			))
			->findTree();
		return $regions;
	}

	/**
	* Obtiene todos los regions paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los regions
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"RegionPeer", "doSelect",$page,$perPage);
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
			$criteria->add(RegionPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		if ($this->searchType)
			$criteria->add(RegionPeer::TYPE, $this->searchType);

		if ($this->postalCode)
			$criteria->add(RegionPeer::POSTALCODE,$this->postalCode);

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
		$pager = new PropelPager($cond,"RegionPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

} // RegionPeer
