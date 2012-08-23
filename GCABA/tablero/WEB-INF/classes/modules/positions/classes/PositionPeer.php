<?php


/**
 * Skeleton subclass for performing query and update operations on the 'positions_position' table.
 *
 * Cargos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.positions.classes
 */
class PositionPeer extends BasePositionPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Positions';

	const PRESIDENT        = 1;
	const VICE_PRESIDENT   = 2;
	const GOVERNOR         = 3;
	const VICE_GOVERNOR    = 4;
	const COMISSIONER      = 5;
	const MAYOR            = 6;
	const VICE_MAYOR       = 7;
	const CHIEF_OF_STAFF   = 8;
	const MINISTER         = 9;
	const VICE_MINISTER    = 10;
	const SECRETARY        = 11;
	const SUB_SECRETARY    = 12;
	const GENERAL_DIRECTOR = 13;
	const DIRECTOR         = 14;
	const SUB_DIRECTOR     = 15;
	const COORDINATOR      = 16;
	const SUPERVISOR       = 17;
	
	const HIERARCHICAL	   = 'hierarchical';
	const STAFF			   = 'staff';

	//nombre de los tipos de cargo
	protected static $positionTypes = array(
			PositionPeer::PRESIDENT        => 'President',
			PositionPeer::VICE_PRESIDENT   => 'Vice President',
			PositionPeer::GOVERNOR         => 'Governor',
			PositionPeer::VICE_GOVERNOR    => 'Vice Governor',
			PositionPeer::COMISSIONER      => 'Comissioner',
			PositionPeer::MAYOR            => 'Mayor',
			PositionPeer::VICE_MAYOR       => 'Vice Mayor',
			PositionPeer::CHIEF_OF_STAFF   => 'Chief of Staff',
			PositionPeer::MINISTER         => 'Minister',
			PositionPeer::VICE_MINISTER    => 'Vice Minister',
			PositionPeer::SECRETARY        => 'Secretary',
			PositionPeer::SUB_SECRETARY    => 'Sub secretary',
			PositionPeer::GENERAL_DIRECTOR => 'General Director',
			PositionPeer::DIRECTOR         => 'Director',
			PositionPeer::SUB_DIRECTOR     => 'Sub Director',
			PositionPeer::COORDINATOR      => 'Coordinator',
			PositionPeer::SUPERVISOR       => 'Supervisor'
		);
		
	//nombre de los tipos de cargo
	protected static $positionKinds = array(
			PositionPeer::HIERARCHICAL      => 'Hierarchical',
			PositionPeer::STAFF   			=> 'Staff',
	);

	//opciones de filtrado
	private  $type;
	private  $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"type"=>"setSearchType",
					"types"=>"setSearchTypes",
					"version"=>"setSearchVersion"
				);

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString){
		$this->searchString = $searchString;
	}

	/**
	 * Especifica el tipo de position.
	 * @param int tipo de position.
	 */
	public function setSearchType($type){
		$this->searchType = $type;
	}

	/**
	 * Especifica el tipo de position.
	 * @param int tipo de position.
	 */
	public function setSearchTypes($types){
		$this->searchTypes = $types;
	}

	/**
	 * Especifica la version.
	 * @param int id de version.
	 */
	public function setSearchVersion($version){
		$this->searchVersion = $version;
	}

	/**
	 * Devuelve los tipos de cargo
	 */
	public static function getPositionTypes(){
		$positionTypes = PositionPeer::$positionTypes;
		$activePositionTypes = ConfigModule::get("positions","activePositionTypes");
		$positionTypes = array_intersect_key($positionTypes,$activePositionTypes);
		return $positionTypes;
	}
	
	/**
	 * Devuelve los tipos de cargo
	 */
	public static function getPositionKinds(){
		$positionKinds = PositionPeer::$positionKinds;
		return $positionKinds;
	}

	/**
	 * Devuelve los nombres de los tipo de region traducidas
	 */
	public function getPositionTypesTranslated(){
		$positionTypes = PositionPeer::getPositionTypes();

		foreach(array_keys($positionTypes) as $key)
			if ($key >= ConfigModule::get("positions","treeRootType"))
				$positionTypesTranslated[$key] = Common::getTranslation($positionTypes[$key],'positions');

		return $positionTypesTranslated;
	}
	
	/**
	 * Devuelve los nombres de los tipo de region traducidas
	 */
	public function getPositionKindsTranslated(){
		$positionKinds = PositionPeer::getPositionKinds();

		foreach(array_keys($positionKinds) as $key)
			$positionKindsTranslated[$key] = Common::getTranslation($positionKinds[$key],'positions');

		return $positionKindsTranslated;
	}

	/**
	* Devuelve la posicion
	* @param integer $id id de la posicion
	* @return position
	*/
	public function get($id){
		$position = PositionPeer::retrieveByPK($id);
		return $position;
	}

	public static function getLastByCode($code)	{
		$criteria = new Criteria();
		$criteria->add(PositionPeer::CODE,$code);
		$criteria->addDescendingOrderByColumn(PositionPeer::VERSIONID);
		$position = PositionPeer::doSelectOne($criteria);
		return $position;
	}

	/**
	* Crea un position nuevo.
	*
	* @param string $name name del position
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo el position correctamente, false sino
	*/
	public static function create($positionParams){
		$positionObj = PositionPeer::getObjectFromParams($positionParams);

		try {
			$code = PositionPeer::getNextCode();
			$positionObj->setCode($code);
			$positionObj->save();
			return $positionObj;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	private static function getNextCode() {
//		PositionQuery::disableSoftDelete();
		$position = PositionQuery::create()->addDescendingOrderByColumn(PositionPeer::CODE)->findOne();
//		PositionQuery::enableSoftDelete();
		if (empty($position))
			return 0;
		else
			return $position->getCode()+1;
	}

	public static function getNewerVersion() {
		$position = PositionQuery::create()->addDescendingOrderByColumn(PositionPeer::VERSIONID)->findOne();
		if (empty($position))
			return 1;
		else {
			return $position->getVersionId();
		}
	}

	/**
	* Obtiene un objeto Position a partir de un array de valores de sus atributos
	*
	* @param array $positionParams Valores
	* @return Position
	*/
	public static function getObjectFromParams($positionParams) {
		$positionObj = new Position();
		foreach ($positionParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($positionObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$positionObj->$setMethod($value);
				else
					$positionObj->$setMethod(null);
			}
		}

		$parentNode = PositionQuery::create()->findPk($positionParams[parentId]);

		if (empty($parentNode))
			$positionObj->makeRoot();
		else
			$positionObj->insertAsLastChildOf($parentNode);

		return $positionObj;
	}

	/**
	* Actualiza la informacion de un position.
	*
	* @param int $id id del position
	* @param string $name name del position
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$positionParams){
		$positionObj = PositionQuery::create()->findPk($id);
		foreach ($positionParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($positionObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$positionObj->$setMethod($value);
				else
					$positionObj->$setMethod(null);
			}
		}

		try {
			$positionObj->save();
			$parentNode = $positionObj->getParent();
			if ((!empty($parentNode) && $parentNode->getId() != $positionParams[parentId]) || (empty($parentNode) && $positionParams[parentId] != 0 )) {
				$newParentNode = PositionQuery::create()->findPk($positionParams[parentId]);
				$positionObj->moveToLastChildOf($newParentNode);
			}

			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina un position a partir de los valores de la clave.
	*
	* @param int $id id del position
	*	@return boolean true si se elimino correctamente el position, false sino
	*/
	function delete($id){
		$positionObj = PositionQuery::create()->findPk($id);
		$positionObj->delete();
		return true;
	}

	/**
	* Obtiene todos los positions.
	*
	*	@return array Informacion sobre todos los positions
	*/
	function getAll(){
		$positions = PositionQuery::create()->find();
		return $positions;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de posición.
	*
	*	@return array Posibles padres a partir de un tipo de posición
	*/
	function getAllPossibleParentsByType($type,$version=1){
		$treeRoot = PositionQuery::create()->findRoot($version);
		if (!empty($treeRoot)) {
			$positionsQuery = PositionQuery::create()
				->filterByKind(PositionPeer::HIERARCHICAL);  //solo las jerarquicas pueden ser padre
			if ($type !== PositionPeer::STAFF) {			 //las staff pueden tener cualquier position como padre
				$positionsQuery->filterByType(array(
					 'min' => ConfigModule::get("positions","treeRootType"),
					 'max' => $type-1,
				));
			}
			$positions = $positionsQuery->orderByBranch()
						   			    ->findTree($version);
		} else {
			return;
		}

		return $positions;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de posición.
	*
	*	@return array Posibles padres a partir de un tipo de posición
	*/
	public function getAllPossibleParents($version=1) {
		$treeRoot = PositionQuery::create()->findRoot($version);
		if (!empty($treeRoot)) {
			$positions = PositionQuery::create()
			->filterByKind(PositionPeer::HIERARCHICAL)
			->orderByBranch()
			->find();
		} else
			return;

		return $positions;
	}

	public static function getRoot($version=1) {
		$root = PositionQuery::create()->findRoot($version);

		return $root;
	}
	
	public static function hasMultipleRoots($version=1) {
		$count = PositionQuery::create()
			->addUsingAlias(PositionPeer::LEFT_COL, 1, Criteria::EQUAL)
			->inTree($version)
			->count();
		
		return $count > 1;
	}

	protected static function getNewVersionNode($node) {
		$newNode = new Position();
		$newNode->setVersionId($node->getVersionId()+1);
		$newNode->setCode($node->getCode());
		$newNode->setInternalCode($node->getInternalCode());
		$newNode->setName($node->getName());
		$newNode->setOwnerName($node->getOwnerName());
		$newNode->setOwnerNameFemale($node->getOwnerNameFemale());
		$newNode->setType($node->getType());
		$newNode->setAddress($node->getAddress());
		$newNode->setTelephone($node->getTelephone());
		$newNode->setEmail($node->getEmail());
		$newNode->setUserGroupId($node->getUserGroupId());
		return $newNode;
	}

	public static function createNewVersion() {
		$version = PositionPeer::getNewerVersion();
		
		$root = PositionPeer::getRoot($version);

		$newRoot = PositionPeer::getNewVersionNode($root);
		$newRoot->makeRoot();
		$newRoot->save();

		PositionPeer::generateNewVersions($root,$newRoot);

	}

	protected static function generateNewVersions($parentNode,$newParentNode) {
		foreach ($parentNode->getChildren() as $node) {
			$newNode = PositionPeer::getNewVersionNode($node);
			$newNode->insertAsLastChildOf($newParentNode);
			$newNode->save();
			PositionPeer::generateNewVersions($node,$newNode);
		}
	}

	/**
	* Obtiene un arbol a partir de una version.
	*
	*	@return array Arbol
	*/
	public static function getTree($version=1) {
		$positions = PositionQuery::create()->orderByBranch()->findTree($version);

		return $positions;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de posición.
	*
	*	@return array Posibles padres a partir de un tipo de posición
	*/
	function getAllParentsByPositionType($type,$version = 1){
		$treeRoot = PositionQuery::create()->findRoot($version);
		if (!empty($treeRoot))
			$positions = PositionQuery::create()
			->orderByBranch()
			->filterByType(array(
				 'min' => ConfigModule::get("positions","treeRootType"),
				 'max' => $type-1,
			))
			->findTree();
		return $positions;
	}

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
		$pager = new PropelPager($cond,"PositionPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria(){
		$criteria = PositionQuery::create()->orderByBranch();
		$criteria->setIgnoreCase(true);

		if ($this->searchString)
			$criteria->add(PositionPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);
		
		if ($this->searchType)
			$criteria->add(PositionPeer::TYPE, $this->searchType);
			
		if ($this->searchTypes)
			$criteria->add(PositionPeer::TYPE, $this->searchTypes, Criteria::IN);

		if ($this->searchVersion)
			$criteria->add(PositionPeer::VERSIONID, $this->searchVersion);
		
		if (ConfigModule::get('users', 'useFilterByUserGroup')) {
			$user = Common::getAdminLogged();
			if (!empty($user) && !$user->isAdmin() && !$user->isSupervisor()) {
				$userGroupsIds = Common::getAdminGroupsIds();
				$criteria->add(PositionPeer::USERGROUPID, $userGroupsIds, Criteria::IN);
			}
		}

		return $criteria;

	}

	/**
	* Obtiene todas las activities paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los activities
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"PositionPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Obtiene todas las activities paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los activities
	*/
	function getAllFiltered(){
		$cond = $this->getCriteria();
		$positions = PositionPeer::doSelect($cond);
		return $positions;
	 }

	public static function getVersions() {
		$criteria = new Criteria();
		$criteria->clearSelectColumns();
		$criteria->addSelectColumn(PositionPeer::VERSIONID);
		$criteria->addAscendingOrderByColumn(PositionPeer::VERSIONID);
		$criteria->setDistinct();

		$versions = array();

		$stmt = PositionPeer::doSelectStmt($criteria);
		while($row = $stmt->fetch(PDO::FETCH_NUM)){
			$versions[] = $row[0];
		}

		return $versions;
	}



	/**
	* Obtiene todos los posibles responsables a partir de array de tipos de posición.
	*
	* @param array $types Array con los tipos de posicion
	* @param int $version Version del organigrama
	*	@return array Posibles responsables a partir de array de tipos de posición
	*/
	function getAllResponsiblesByPositionType($type,$version){
		$positionPeer = new PositionPeer();
		if (!is_null($type))
			$positionPeer->setSearchType($types);
		$positionPeer->setSearchVersion($version);
		$positions = $positionPeer->getAllFiltered();
		
		return $positions;
	}

	/**
	* Obtiene todos los posibles responsables a partir de array de tipos de posición.
	*
	* @param array $types Array con los tipos de posicion
	* @param int $version Version del organigrama
	*	@return array Posibles responsables a partir de array de tipos de posición
	*/
	function getAllResponsiblesByPositionTypes($types,$version){
		
		$positionPeer = new PositionPeer();
		if (!is_null($types))
			$positionPeer->setSearchTypes($types);
		$positionPeer->setSearchVersion($version);
		$positions = $positionPeer->getAllFiltered();
		
		return $positions;
	}

	/**
	* Obtiene la versión mas reciente de organigrama
	*
	*	@return int Numero de versión mas reciente
	*/
	public static function getLatestVersion()	{
		$position = PositionQuery::create()->addDescendingOrderByColumn(PositionPeer::VERSIONID)->findOne();
		if (empty($position))
			return 0;
		else
			return $position->getVersionId();
	}

	/**
	* Obtiene todos los posibles responsables a partir de una posición
	*
	* @param array $types Array con los tipos de posicion
	* @param int $version Version del organigrama
	*	@return array Posibles responsables a partir de array de tipos de posición
	*/
	function getAllResponsiblesByPosition($position,$version = 1){
		$criteria = PositionQuery::create()->orderByBranch()->inTree($version);

		if (!is_null($position)) {
			$positionIds = array();
			array_push($positionIds, $position->getId());
	
			if ($position->hasChildren()){
				$descendants = $position->getDescendants();
				foreach ($descendants as $descendant)
					array_push($positionIds, $descendant->getId());
			}
			$criteriaOnPosition = $criteria->getNewCriterion(PositionPeer::ID,$positionIds,Criteria::IN);
			$criteria->addAnd($criteriaOnPosition);
		}
		$positions = $criteria->find();
		return $positions;
	}


	/**
	* @deprecated obtener la posicion y usar $position->getAllObjectives() en lugar de esto.
	* Obtiene todos los objetivos a partir de una posicion
	*
	* @param array $types Array con los tipos de posicion
	* @param int $version Version del organigrama
	*	@return array Posibles responsables a partir de array de tipos de posición
	*/
	function getObjectives($positionId,$version = 1){
		$position = PositionQuery::create()->filterByVersionid($version)->findOneById($positionId);

		$criteria = new Criteria();

		$criteryOnPosition = $criteria->getNewCriterion(PositionPeer::VERSIONID,$version);
		$criteria->addAnd($criteryOnPosition);

		$positionCodes = array();
		array_push($positionCodes, $position->getCode());
		if ($position->hasChildren()){
			$descendants = $position->getDescendants();
			foreach ($descendants as $descendant)
				array_push($positionCodes, $descendant->getCode());
		}
		$criteriaOnResponsible = $criteria->getNewCriterion(ObjectivePeer::RESPONSIBLECODE,$positionCodes,Criteria::IN);
		$criteria->addAnd($criteriaOnResponsible);

		$criteria->addJoin(ObjectivePeer::RESPONSIBLECODE,PositionPeer::CODE);

		$objectives = ObjectivePeer::doSelect($criteria);
		
		return $objectives;
	}
	
	/**
	* @deprecated obtener la posicion y usar $position->getAllProjects() en lugar de esto.
	* Obtiene todos los proyectos a partir de una position
	*
	* @param int $positionId id de la position
	* @param int $version Version del organigrama
	* @return PropelCollection proyectos asociados a la position o sus descendientes
	*/
	public static function getProjects($positionId,$version = 1){
		$position = PositionQuery::create()->filterByVersionid($version)->findOneById($positionId);

		$criteria = new Criteria();

		$positionCodes = array();
		$positionCodes[] = $position->getCode();
		if ($position->hasChildren()){
			$descendants = $position->getDescendants();
			foreach ($descendants as $descendant)
				$positionCodes[] = $descendant->getCode();
		}
		$projects = ProjectQuery::create()->findByResponsibleCode($positionCodes);
		
		return $projects;
	}


	function getIncludeHome() {

		return BaseQuery::create('Position')//->filterByType(9)
																			//->_or()
																				->filterByPlanning(1)
																			->find();
	}	
} // PositionPeer
