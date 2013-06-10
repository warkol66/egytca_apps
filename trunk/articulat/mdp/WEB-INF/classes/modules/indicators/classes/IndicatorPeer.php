<?php


/**
 * Skeleton subclass for performing query and update operations on the 'indicators_indicator' table.
 *
 * Indicator
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class IndicatorPeer extends BaseIndicatorPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Indicators';

	const COLUMN        = 1;
	const LINE          = 2;
	const PIE           = 3;
	const STACKEDCOLUMN = 4;

	//nombre de los tipos de region
	protected static $indicatorTypes = array(
		IndicatorPeer::COLUMN        => 'Column',
		IndicatorPeer::LINE          => 'Line',
		IndicatorPeer::PIE           => 'Pie',
		IndicatorPeer::STACKEDCOLUMN => 'Stacked Column'
	);

	/**
	 * Devuelve los tipos de indicador
	 */
	public static function getIndicatorTypes() {
		return IndicatorPeer::$indicatorTypes;
	}

	/**
	 * Devuelve los nombres de los tipo de indicador traducidas
	 */
	public function getIndicatorTypesTranslated()
	{
		$indicatorTypes = IndicatorPeer::getIndicatorTypes();
		foreach(array_keys($indicatorTypes) as $key)
			$typesTranslated[$key] = Common::getTranslation($indicatorTypes[$key],'indicators');
		return $typesTranslated;
	}

	//opciones de filtrado
	private  $type;
	private  $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchString"=>"setSearchString",
		"category"=>"setSearchCategory",
		"type"=>"setSearchType"
	);

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	/**
	 * Especifica el tipo de indicator.
	 * @param int tipo de indicator.
	 */
	public function setSearchType($type) {
		$this->searchType = $type;
	}

	/**
	 * Especifica el tipo de indicator.
	 * @param int tipo de indicator.
	 */
	public function setSearchCategory($category) {
		$this->searchCategory = $category;
	}

	/**
	* Crea un indicator nuevo.
	*
	* @param string $name name del indicator
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo el indicator correctamente, false sino
	*/
	function create($indicatorParams)
	{
		$indicatorObj = new Indicator();
		foreach ($indicatorParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($indicatorObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$indicatorObj->$setMethod($value);
				else
					$indicatorObj->$setMethod(null);
			}
		}
		try {
			$indicatorObj->save();
			return true;
		} catch (PropelException $exp) {
			return false;
		}
	}

	/**
	* Actualiza la informacion de un indicator.
	*
	* @param int $id id del indicator
	* @param string $name name del indicator
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$indicatorParams)
	{
		$indicatorObj = IndicatorQuery::create()->findPk($id);
		foreach ($indicatorParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($indicatorObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$indicatorObj->$setMethod($value);
				else
					$indicatorObj->$setMethod(null);
			}
		}
		try {
			$indicatorObj->save();
			return true;
		} catch (PropelException $exp) {
			return false;
		}
	}

	/**
	* Elimina un indicator a partir de los valores de la clave.
	*
	* @param int $id id del indicator
	*	@return boolean true si se elimino correctamente el indicator, false sino
	*/
	function delete($id)
	{
		$indicatorObj = IndicatorQuery::create()->findPk($id);
		$indicatorObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un indicator.
	*
	* @param int $id id del indicator
	* @return array Informacion del indicator
	*/
	function get($id)
	{
		$indicatorObj = IndicatorQuery::create()->findPk($id);
		return $indicatorObj;
	}

	/**
	* Obtiene todos los indicators.
	*
	*	@return array Informacion sobre todos los indicators
	*/
	function getAll()
	{
		$indicators = IndicatorQuery::create()->find();
		return $indicators;
	}

	/**
	* Obtiene todos los indicators paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los indicators
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"IndicatorPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->addAscendingOrderByColumn(IndicatorPeer::ID);
		
		$disbursementGraphs = IndicatorCategoryRelationQuery::create()->select('Indicatorid')->where('IndicatorCategoryRelation.Categoryid < ?', 0)->find();
		$disbursementGraphs = $disbursementGraphs->toArray();
		$criteria->add(IndicatorPeer::ID,$disbursementGraphs,Criteria::NOT_IN);
		
//		$criteria->addJoin( IndicatorPeer::ID, IndicatorCategoryRelationPeer::INDICATORID,Criteria::RIGHT_JOIN);
//		$criteria->add(IndicatorCategoryRelationPeer::CATEGORYID, 0,Criteria::GREATER_EQUAL);

		if ($this->searchString)
			$criteria->add(IndicatorPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		if ($this->searchType)
			$criteria->add(IndicatorPeer::TYPE, $this->searchType);

		if ($this->searchCategory)
			$criteria->add(IndicatorCategoryRelationPeer::CATEGORYID, $this->searchCategory);
//echo $criteria->toString();die;
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
		$criteria = $this->getCriteria();
		$pager = new PropelPager($criteria,"IndicatorPeer","doSelect",$page,$perPage);
		return $pager;
	}


  /**
  * Obtiene las curvas de desembolso (idicadores)
  *
  *	@return array curvas de desembolso (idicadores)
  */
  public function getIncludeIndicatorsList($options) {

  	if ($options["limit"])
  		$limit = $options["limit"];
  	else
  		$limit = 5;

		$indicatorsByProjects = ProjectQuery::create()
				->filterBy('Indicatorid', 0 , ' > ')
				->select('Indicatorid')
				->limit($limit)
				->find();

		$indicators = IndicatorQuery::create()
				->filterBy('Id',$indicatorsByProjects,' IN ')
				->find();

    return $indicators;
  }
  
  /**
   * Devuelve un indicador de desembolsos con los datos acumulados de los proyectos
   * que cuelgan de la entidad indicada. 
   * 
   * @return $indicator Indicator, indicador con los datos de desembolso acumulados mes a mes.
   * @param $entityClassName string, nombre de la entidad.
   * @param $entityId int, id de la entidad.
   */
  public static function getDisbursementIndicator($entityClassName, $entityId) {
  	// Se crea un indicador
  	global $system;
	$numberOfDecimals = $system["config"]["system"]["parameters"]["numberOfDecimals"];
  	$indicator = new Indicator();
  	$entityName = IndicatorPeer::getEntityNameByEntity($entityClassName, $entityId);
	$indicatorParams = array(
		'name' => "Curva de desembolsos \"" . $entityName . "\"",
		'type' => 2, //linea
		'graphType' => 0,
		'decimals' => $numberOfDecimals,
		'labelX' => 'Fecha',
		'labelY' => 'Inversión',
	);
	Common::setObjectFromParams($indicator, $indicatorParams);
		
  	$projIndicatorIds = IndicatorPeer::getProjectIndicatorIdsByEntity($entityClassName, $entityId);
  	if (!empty($projIndicatorIds)) {
		$series = array();
		// Se obtienen los nombres de las series existentes.
		$serieNames = IndicatorSerieQuery::create()->filterDistinctNamesByIndicatorIds($projIndicatorIds)
												   ->find();
		foreach ($serieNames as $serieName) {
			// Se cargan las series.
			$series[$serieName] = new IndicatorSerie();
			$series[$serieName]->setName($serieName);
			$indicator->addIndicatorSerie($series[$serieName]);
		}
		
		// Se obtienen las fechas existentes.
		$dates = IndicatorXQuery::create()->filterDistinctNamesByIndicatorIds($projIndicatorIds)
										  ->find();
		// Generamos las X.
		foreach ($dates as $key => $date) {
			$x = new IndicatorX();
			$x->setName($date);
			$x->setOrder($key);
			$indicator->addIndicatorX($x);
				
			// Generamos las Y.
			foreach ($series as $serie) {
				$serieName = $serie->getName();
				$y = new IndicatorY();

				//Calculamos el valor de la Y.
				$yValue = IndicatorYQuery::create()->filterBySerieName($serieName)
												   ->filterByXName($date)
												   ->filterByIndicatorId($projIndicatorIds)
												   ->findSumValues();
				$yValue = empty($yValue) ? 0 : $yValue;
				$y->setValue($yValue);
				$serie->addIndicatorY($y);
				$x->addIndicatorY($y);
			}
		}
  	}
  	return $indicator;
  }
  
  public static function getEntityNameByEntity($entityClassName, $entityId) {
  	$indicatorName = '';
  	$peerClassName = $entityClassName . 'Peer';
  	if (class_exists($peerClassName) && method_exists($peerClassName, 'get')) {
  		$entity = call_user_func(array($peerClassName, 'get'), $entityId);
  		if (!empty($entity))
  			$indicatorName = $entity->getName();
  	}
  	return $indicatorName;
  }
  
  public static function getProjectIndicatorIdsByEntity($entityClassName, $entityId) {
  	$projIndicatorIds = array();
  	$queryMethod = 'filterBy' . $entityClassName . 'Id';
  	if (method_exists(ProjectQuery, $queryMethod)) {
  		$projIndicatorIds = ProjectQuery::create()->$queryMethod($entityId)
  												  ->select('Indicatorid')
  												  ->find();
  		$projIndicatorIds = $projIndicatorIds->toArray();
  	}
  	return $projIndicatorIds;
  }

  public static function getIncludeDisbursementIndicator($options) {
  	$indicator = IndicatorPeer::getDisbursementIndicator($options["entity"], $options["id"]);
  	return $indicator;
	}
} // IndicatorPeer
