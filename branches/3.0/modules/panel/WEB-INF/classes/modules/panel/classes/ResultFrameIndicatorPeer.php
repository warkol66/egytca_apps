<?php



/**
 * Skeleton subclass for performing query and update operations on the 'panel_resultFrameIndicator' table.
 *
 * Indicador del Marco de Resultados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class ResultFrameIndicatorPeer extends BaseResultFrameIndicatorPeer {
	/** the default item name for this class */
	const ITEM_NAME = 'ResultFrameIndicator';

	const RESULTFRAME      = 1;
	const CREDIT    	   = 2;
	const COMPONENT        = 3;
	const SUBCOMPONENT     = 4;
	const YEARLY = 1;
	const SEMIANNUALLY =2;
	const QUARTERLY = 3;
	const NUMERIC_VALUE = 1;
	const TEXT_VALUE = 2;
	
	//nombre de los tipos de cargo
	protected static $indicatorTypes = array(
		ResultFrameIndicatorPeer::RESULTFRAME   => 'Marco de Resultados',
		ResultFrameIndicatorPeer::CREDIT    	=> 'Préstamo',
		ResultFrameIndicatorPeer::COMPONENT     => 'Componente',
		ResultFrameIndicatorPeer::SUBCOMPONENT  => 'Sub Componente',
	);
	
	//relacion entre tipos de objetos y tipos de indicador
	protected static $objectTypes = array(
		ResultFrameIndicatorPeer::RESULTFRAME    => '',
		ResultFrameIndicatorPeer::CREDIT    	 => 'PolicyGuideline',
		ResultFrameIndicatorPeer::COMPONENT      => 'StrategicObjective',
		ResultFrameIndicatorPeer::SUBCOMPONENT   => 'Objective',
	);
	
	//nombre de los tipos de cargo
	protected static $valueTypes = array(
		ResultFrameIndicatorPeer::NUMERIC_VALUE   => 'Numérico',
		ResultFrameIndicatorPeer::TEXT_VALUE    	=> 'Texto'
	);

	//nombre de los tipos de cargo
	protected static $frecuencyTypes = array(
		ResultFrameIndicatorPeer::YEARLY   => 'Anual',
		ResultFrameIndicatorPeer::SEMIANNUALLY    	=> 'Semestral',
		ResultFrameIndicatorPeer::QUARTERLY     => 'Trimestral'
	);

	//opciones de filtrado
	private  $type;
	private  $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchString"=>"setSearchString",
		"type"=>"setSearchType",
	);
	
	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString){
		$this->searchString = $searchString;
	}

	/**
	 * Especifica el tipo de indicador.
	 * @param int tipo de indicador.
	 */
	public function setSearchType($type){
		$this->searchType = $type;
	}

	/**
	 * Devuelve los tipos de indicadores
	 */
	public static function getTypes(){
		$indicatorTypes = ResultFrameIndicatorPeer::$indicatorTypes;
		$activeResultFrameIndicatorsTypes = ConfigModule::get("resultFrameIndicators","activeResultFrameIndicatorsTypes");
		$indicatorTypes = array_intersect_key($indicatorTypes,$activeResultFrameIndicatorsTypes);
		return $indicatorTypes;
	}

	/**
	 * Devuelve los nombres de los tipo de indicador traducidas
	 */
	public function getTypesTranslated(){
		$indicatorTypes = ResultFrameIndicatorPeer::getTypes();

		foreach(array_keys($indicatorTypes) as $key)
			if ($key >= ConfigModule::get("resultFrameIndicators","treeRootType"))
				$indicatorTypesTranslated[$key] = Common::getTranslation($indicatorTypes[$key],'resultFrameIndicators');

		return $indicatorTypesTranslated;
	}
	
	/**
	 * Devuelve los nombres de los tipo de indicador traducidas
	 */
	public function getValueTypesTranslated(){
		$valueTypes = ResultFrameIndicatorPeer::getValueTypes();

		foreach(array_keys($valueTypes) as $key)
			$valueTypesTranslated[$key] = Common::getTranslation($indicatorTypes[$key],'panel');

		return $valueTypesTranslated;
	}

	/**
	 * Devuelve los nombres de los tipo de indicador traducidas
	 */
	public function getFrequencyTypesTranslated(){
		$frequencyTypes = ResultFrameIndicatorPeer::getFrequencyTypes();

		foreach(array_keys($valueTypes) as $key)
			$frequencyTypesTranslated[$key] = Common::getTranslation($indicatorTypes[$key],'panel');

		return $frequencyTypesTranslated;
	}

	/**
	 * Devuelve el tipo de objeto correspondiente al tipo de indicador
	 */
	public static function getObjectTypeByIndicatorType($type){
		return ResultFrameIndicatorPeer::$objectTypes[$type];
	}
	
	/**
	 * Devuelve los objetos candidatos a relacionar con la indicador
	 * según el tipo.
	 */
	public static function getObjectsByIndicatorType($type){
		$objectType = ResultFrameIndicatorPeer::getObjectTypeByIndicatorType($type);
		$objectsPeer = $objectType . 'Peer';
		$objects = call_user_func(array($objectsPeer, 'getAll'));
		return $objects;
	}
	
	/**
	* Devuelve la indicador
	* @param integer $id id de la indicador
	* @return indicator
	*/
	public function get($id){
		$indicator = ResultFrameIndicatorPeer::retrieveByPK($id);
		return $indicator;
	}
	
	/**
	* Crea una indicador nueva.
	*
	* @param $resultFrameIndicatorParams parametros de la indicador.
	* @return boolean true si se creo la indicador correctamente, false sino
	*/
	public static function create($resultFrameIndicatorParams){
		$indicator = ResultFrameIndicatorPeer::getObjectFromParams($resultFrameIndicatorParams);

		try {
			$indicator->save();
			return $indicator;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	* Obtiene un objeto ResultFrameIndicator a partir de un array de valores de sus atributos
	*
	* @param array $positionParams Valores
	* @return Position
	*/
	public static function getObjectFromParams($resultFrameIndicatorParams) {
		$indicator = new ResultFrameIndicator();
		foreach ($resultFrameIndicatorParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($indicator,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$indicator->$setMethod($value);
				else
					$indicator->$setMethod(null);
			}
		}

		$parentNode = ResultFrameIndicatorQuery::create()->findPk($resultFrameIndicatorParams[parentId]);

		if (empty($parentNode))
			$indicator->makeRoot();
		else
			$indicator->insertAsLastChildOf($parentNode);

		return $indicator;
	}
	
	/**
	* Actualiza la informacion de una indicador de marco de resultados.
	*
	* @param int $id id de la indicador
	* @param $resultFrameIndicatorParams parametros de la indicador.
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$resultFrameIndicatorParams){
		$indicator = ResultFrameIndicatorQuery::create()->findPk($id);
		foreach ($resultFrameIndicatorParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($indicator,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$indicator->$setMethod($value);
				else
					$indicator->$setMethod(null);
			}
		}

		try {
			$parentNode = $indicator->getParent();
			if ((!empty($parentNode) && $parentNode->getId() != $resultFrameIndicatorParams[parentId]) || (empty($parentNode) && $resultFrameIndicatorParams[parentId] != 0 )) {
				$newParentNode = ResultFrameIndicatorQuery::create()->findPk($resultFrameIndicatorParams[parentId]);
				$indicator->moveToLastChildOf($newParentNode);
			}
			$indicator->save();

			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	* Elimina una indicador de marco de resultados a partir de los valores de la clave.
	*
	* @param int $id id de la indicador
	* @return boolean true si se elimino correctamente la indicador, false sino
	*/
	function delete($id){
		$indicator = ResultFrameIndicatorQuery::create()->findPk($id);
		$indicator->delete();
		return true;
	}

	/**
	* Obtiene todas las indicadores.
	*
	* @return array Informacion sobre todos las indicadores
	*/
	function getAll(){
		$indicators = ResultFrameIndicatorQuery::create()->find();
		return $indicators;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de posición.
	*
	* @return array Posibles padres a partir de un tipo de posición
	*/
	function getAllPossibleParentsByType($type){
		$treeRoot = ResultFrameIndicatorQuery::create()->findRoot();
		if (!empty($treeRoot))
			$indicators = ResultFrameIndicatorQuery::create()
			->orderByBranch()
			->filterByType(array(
				 'min' => ConfigModule::get("resultFrameIndicators","treeRootType"),
				 'max' => $type-1,
			))
			->findTree();
		else
			return;

		return $indicators;
	}
	
	/**
	* Obtiene todos las posibles entidades a asociar según la entidad asociada al padre.
	*
	* @param string $type, tipo de indicador.
	* @param int $parentId, id del padre.
	* @return PropelObjectCollection $objects, posibles entidades a asociar según la entidad asociada al padre.
	*/
	function getAllPossibleObjectsByTypeAndParentId($type, $parentId){
		$objectType = ResultFrameIndicatorPeer::getObjectTypeByIndicatorType($type);
		$parent = ResultFrameIndicatorQuery::create()->findPk($parentId);
		if (!empty($parent)) {
			$parentObjecType = $parent->getObjectType();
			$parentObjectId = $parent->getObjectId();
		}
		$filteringMethod = 'filterBy' . $parentObjecType . 'Id';
		$queryClassName = $objectType . 'Query';
		if (class_exists($queryClassName) && method_exists($queryClassName, $filteringMethod)) {
			$query = new $queryClassName;
			$query->$filteringMethod($parentObjectId);
			$objects = $query->find();
		}
		return $objects;
	}
	
	public static function getRoot() {
		$root = ResultFrameIndicatorQuery::create()->findRoot();
		return $root;
	}
	
	public static function createResultFrameFromCurrentEntities() {
		$rootType = ConfigModule::get("resultFrameIndicators","treeRootType");
		
		$newNode = new ResultFrameIndicator();
		$newNode->setType($rootType);
		$newNode->setName('Marco de Resultados');
		$newNode->makeRoot();
		$newNode->save();
		
		$firstObjPeer = ResultFrameIndicatorPeer::$objectTypes[$rootType + 1] . 'Peer';
		$firstObjects = call_user_func(array($firstObjPeer, 'getAll'));
		foreach ($firstObjects as $object) {
			ResultFrameIndicatorPeer::createSubTreeFromCurrentEntities($object, $rootType + 1, $newNode->getId());
		}
	}
	
	protected static function createSubTreeFromCurrentEntities($object, $objType, $parentNodeId) {
		// Necesario para actualizar la version en memoria del nodo.
		$parentNode = ResultFrameIndicatorPeer::get($parentNodeId);
		
		$newNode = new ResultFrameIndicator();
		$newNode->setName($object->getName());
		$newNode->setType($objType);
		$newNode->setObjectId($object->getId());
		$newNode->setObjectType(ResultFrameIndicatorPeer::$objectTypes[$objType]);
		$newNode->insertAsLastChildOf($parentNode);
		$newNode->save();
		
		$childsObjName = ResultFrameIndicatorPeer::$objectTypes[$objType + 1];
		if (!empty($childsObjName)) {
			$childs = call_user_func(array($object, 'get'.$childsObjName.'s'));
			foreach ($childs as $child) {
				ResultFrameIndicatorPeer::createSubTreeFromCurrentEntities($child, $objType + 1, $newNode->getId());		
			}
		}
		return $newNode;
	}
	
	/**
	* Obtiene todos las indicadores paginadas.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todas las indicadores
	*/
	function getAllPaginated($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"ResultFrameIndicatorPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria(){
		$criteria = ResultFrameIndicatorQuery::create()->orderByBranch();
		$criteria->setIgnoreCase(true);

		if ($this->searchString)
			$criteria->add(ResultFrameIndicatorPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);
		
		if ($this->searchType)
			$criteria->add(ResultFrameIndicatorPeer::TYPE, $this->searchType, Criteria::IN);

		return $criteria;
	}
	
	/**
	* Obtiene todas las indicadores paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todas las indicadores
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"ResultFrameIndicatorPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Obtiene todas las indicadores paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todas las indicadores
	*/
	function getAllFiltered(){
		$cond = $this->getCriteria();
		$indicators = ResultFrameIndicatorPeer::doSelect($cond);
		return $indicators;
	}
	
	/**
	* Obtiene todos las posibles indicadores a partir de array de tipos de indicador.
	*
	* @param array $types Array con los tipos de indicador
	* @return array indicadores a partir de array de tipos de indicador
	*/
	function getAllByIndicatorType($types){
		$resultFrameIndicatorPeer = new ResultFrameIndicatorPeer();
		if (!is_null($types))
			$resultFrameIndicatorPeer->setSearchType($types);
		$indicators = $resultFrameIndicatorPeer->getAllFiltered();
		
		return $indicators;
	}
	
	/**
	* Obtiene todas las posibles indicadores a partir de una indicador
	*
	* @param $indicator, indicador del marco de resultados.
	* @return array indicadores a partir de una indicador
	*/
	function getAllByIndicator($indicator){
		$criteria = ResultFrameIndicatorQuery::create()->orderByBranch();

		if (!is_null($indicator)) {
			$indicatorIds = array();
			array_push($indicatorIds, $indicator->getId());
	
			if ($indicator->hasChildren()){
				$descendants = $indicator->getDescendants();
				foreach ($descendants as $descendant)
					array_push($indicatorIds, $descendant->getId());
			}
			$criteriaOnPosition = $criteria->getNewCriterion(ResultFrameIndicatorPeer::ID,$indicatorIds,Criteria::IN);
			$criteria->addAnd($criteriaOnPosition);
		}
		$indicators = $criteria->find();
		return $indicators;
	}
	
	/**
	 * Actualiza el conjunto de valores asociados al indicador con 
	 * el rango temporal correspondiente según el policyGuideline.
	 * Si el indicador ya tenía valores y el rango temporal no coincide,
	 * estos serán truncados.
	 * 
	 * @param $resultFrameValues array asociativo, valores correspondientes al indicador. year => ResultFrameValue
	 * 
	 * @return $resultFrameValues array, valores correspondientes al indicador.
	 */
	public static function updateIndicatorValues($resultFrameIndicatorId, $resultFrameValues) {	
		try {
			foreach($resultFrameValues as $resultFrameValue) {
				$resultFrameValue->save();
			}
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
		
		// Borramos los valores existentes que estén fuera del rango temporal.
		$valuesToDelete = ResultFrameValueQuery::create()->filterByResultFrameIndicatorId($resultFrameIndicatorId)
														 ->filterByYear(array_keys($resultFrameValues), Criteria::NOT_IN)
														 ->find();
		foreach($valuesToDelete as $valueToDelete) {
			$valueToDelete->delete();
		}
		
		return $resultFrameValues;
	}
	
	/**
	 * Actualiza el conjunto de valores asociados al indicador con 
	 * el rango temporal correspondiente según el policyGuideline.
	 * Si el indicador ya tenía valores y el rango temporal no coincide,
	 * estos serán truncados.
	 * 
	 * @param $resultFrameValuesParams array asociativo, valores correspondientes al indicador. year => ResultFrameValueParams
	 */
	public static function updateIndicatorValuesFromParams($resultFrameIndicatorId, $indicatorValuesParams) {
		$indicator = ResultFrameIndicatorPeer::get($resultFrameIndicatorId);
		if (!empty($indicator)) {
			$indicatorValues = $indicator->getValues();
			foreach($indicatorValues as $year => $indicatorValue) {
				Common::setObjectFromParams($indicatorValue, $indicatorValuesParams[$year]);
			}
			ResultFrameIndicatorPeer::updateIndicatorValues($indicator->getId(), $indicatorValues);
		}
	}

  /**
  * Obtiene el marco de resultado de un prestamo para incluir
  *
  *	@return array marco de resultados para incluir
  */
  public function getIncludeResultFrameIndicatorView($options) {

		$policyGuidelines = ResultFrameIndicatorPeer::getAllByIndicatorType(ResultFrameIndicatorPeer::CREDIT);	
		$results['policyGuidelines'] = $policyGuidelines;

		if ($options["id"]){

			$policyGuideline = ResultFrameIndicatorPeer::get($options["id"]);
			if (!empty($policyGuideline)) {
				$results['selectedPolicyGuideline'] = $policyGuideline;
		
				$resultFrameIndicators = ResultFrameIndicatorPeer::getAllByIndicator($policyGuideline);

				if (!empty($resultFrameIndicators))
					$results['resultFrameIndicators'] = $resultFrameIndicators;

			}
			else
				$results['selectedPolicyGuideline'] = new PolicyGuideline();
			
		}

    return $results;
  }

} // ResultFrameIndicatorPeer
