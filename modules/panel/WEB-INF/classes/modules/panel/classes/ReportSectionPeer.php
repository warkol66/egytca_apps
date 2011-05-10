<?php



/**
 * Skeleton subclass for performing query and update operations on the 'panel_reportSection' table.
 *
 * Seccion de reporte al BM
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class ReportSectionPeer extends BaseReportSectionPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'ReportSections';

	const REPORT     	 = 1;
	const SUBREPORT    	 = 2;
	const SECTION        = 3;
	const SUBSECTION     = 4;
	const SUBSUBSECTION  = 5;
	
	//nombre de los tipos de cargo
	protected static $sectionTypes = array(
		ReportSectionPeer::REPORT       => 'Report',
		ReportSectionPeer::SUBREPORT    => 'Sub Report',
		ReportSectionPeer::SECTION      => 'Section',
		ReportSectionPeer::SUBSECTION   => 'Sub Section',
		ReportSectionPeer::SUBSUBSECTION   => 'Sub sub Section'
	);
	
	//relacion entre tipos de objetos y tipos de seccion
	protected static $objectTypes = array(
		ReportSectionPeer::REPORT       => '',
		ReportSectionPeer::SUBREPORT    => 'PolicyGuideline',
		ReportSectionPeer::SECTION    => 'StrategicObjective',
		ReportSectionPeer::SUBSECTION      => 'Objective',
		ReportSectionPeer::SUBSUBSECTION   => 'Project'
	);
	
	//opciones de filtrado
	private  $type;
	private  $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchString"=>"setSearchString",
		"type"=>"setSearchType",
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
	 * Especifica el tipo de sección.
	 * @param int tipo de sección.
	 */
	public function setSearchType($type){
		$this->searchType = $type;
	}

	/**
	 * Especifica la version.
	 * @param int id de version.
	 */
	public function setSearchVersion($version){
		$this->searchVersion = $version;
	}

	/**
	 * Devuelve los tipos de secciones
	 */
	public static function getTypes(){
		$sectionTypes = ReportSectionPeer::$sectionTypes;
		$activeReportSectionsTypes = ConfigModule::get("reportSections","activeReportSectionsTypes");
		$sectionTypes = array_intersect_key($sectionTypes,$activeReportSectionsTypes);
		return $sectionTypes;
	}

	/**
	 * Devuelve los nombres de los tipo de sección traducidas
	 */
	public function getTypesTranslated(){
		$sectionTypes = ReportSectionPeer::getTypes();

		foreach(array_keys($sectionTypes) as $key)
			if ($key >= ConfigModule::get("reportSections","treeRootType"))
				$sectionTypesTranslated[$key] = Common::getTranslation($sectionTypes[$key],'reportSections');

		return $sectionTypesTranslated;
	}
	
	/**
	 * Devuelve el tipo de objeto correspondiente al tipo de seccion
	 */
	public static function getObjectTypeBySectionType($type){
		return ReportSectionPeer::$objectTypes[$type];
	}
	
	/**
	 * Devuelve los objetos candidatos a relacionar con la seccion
	 * según el tipo.
	 */
	public static function getObjectsBySectionType($type){
		$objectType = ReportSectionPeer::getObjectTypeBySectionType($type);
		$objectsPeer = $objectType . 'Peer';
		$objects = call_user_func(array($objectsPeer, 'getAll'));
		return $objects;
	}
	
	/**
	* Devuelve la sección
	* @param integer $id id de la sección
	* @return section
	*/
	public function get($id){
		$section = ReportSectionPeer::retrieveByPK($id);
		return $section;
	}

	public static function getLastByCode($code)	{
		$criteria = new Criteria();
		$criteria->add(ReportSectionPeer::CODE,$code);
		$criteria->addDescendingOrderByColumn(ReportSectionPeer::VERSIONID);
		$section = ReportSectionPeer::doSelectOne($criteria);
		return $section;
	}
	
	/**
	* Crea una sección nueva.
	*
	* @param $reportSectionParams parametros de la sección.
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo la sección correctamente, false sino
	*/
	public static function create($reportSectionParams){
		$section = ReportSectionPeer::getObjectFromParams($reportSectionParams);

		try {
			$code = ReportSectionPeer::getNextCode();
			$section->setCode($code);
			$section->save();
			return $section;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	private static function getNextCode() {
		ReportSectionQuery::disableSoftDelete();
		$section = ReportSectionQuery::create()->addDescendingOrderByColumn(ReportSectionPeer::CODE)->findOne();
		ReportSectionQuery::enableSoftDelete();
		if (empty($section))
			return 0;
		else
			return $section->getCode()+1;
	}

	private static function getPreviousVersion() {
		$versions = ReportVersionQuery::create()->orderById(Criteria::DESC)->find();
		$version = $versions[1];
		if (empty($version))
			return 0;
		else
			return $version->getId();
	}
	
	private static function getNewerVersion() {
		$version = ReportVersionQuery::create()->orderById(Criteria::DESC)->findOne();
		if (empty($version))
			return 0;
		else
			return $version->getId();
	}
	
	/**
	* Obtiene un objeto ReportSection a partir de un array de valores de sus atributos
	*
	* @param array $positionParams Valores
	* @return Position
	*/
	public static function getObjectFromParams($reportSectionParams) {
		$section = new ReportSection();
		foreach ($reportSectionParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($section,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$section->$setMethod($value);
				else
					$section->$setMethod(null);
			}
		}

		$parentNode = ReportSectionQuery::create()->findPk($reportSectionParams[parentId]);

		if (empty($parentNode))
			$section->makeRoot();
		else
			$section->insertAsLastChildOf($parentNode);

		return $section;
	}
	
	/**
	* Actualiza la informacion de una sección de reporte.
	*
	* @param int $id id de la sección
	* @param $reportSectionParams parametros de la sección.
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$reportSectionParams){
		$section = ReportSectionQuery::create()->findPk($id);
		foreach ($reportSectionParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($section,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$section->$setMethod($value);
				else
					$section->$setMethod(null);
			}
		}

		try {
			$section->save();
			$parentNode = $section->getParent();
			if ((!empty($parentNode) && $parentNode->getId() != $reportSectionParams[parentId]) || (empty($parentNode) && $reportSectionParams[parentId] != 0 )) {
				$newParentNode = ReportSectionQuery::create()->findPk($reportSectionParams[parentId]);
				$section->moveToLastChildOf($newParentNode);
			}

			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	* Elimina una sección de reporte a partir de los valores de la clave.
	*
	* @param int $id id de la sección
	* @return boolean true si se elimino correctamente la sección, false sino
	*/
	function delete($id){
		$section = ReportSectionQuery::create()->findPk($id);
		$section->delete();
		return true;
	}

	/**
	* Obtiene todas las secciones.
	*
	* @return array Informacion sobre todos las secciones
	*/
	function getAll(){
		$sections = ReportSectionQuery::create()->find();
		return $sections;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de posición.
	*
	*	@return array Posibles padres a partir de un tipo de posición
	*/
	function getAllPossibleParentsByType($type,$version=1){
		$treeRoot = ReportSectionQuery::create()->findRoot($version);
		if (!empty($treeRoot))
			$sections = ReportSectionQuery::create()
			->orderByBranch()
			->filterByType(array(
				 'min' => ConfigModule::get("reportSections","treeRootType"),
				 'max' => $type-1,
			))
			->findTree($version);
		else
			return;

		return $sections;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de sección.
	*
	* @return array Posibles padres a partir de un tipo de sección
	*/
	public function getAllPossibleParents($version=1) {
		$treeRoot = ReportSectionQuery::create()->findRoot($version);
		if (!empty($treeRoot)) {
			$sections = ReportSectionQuery::create()
			->orderByBranch()
			->find();
		} else
			return;

		return $sections;
	}
	
	public static function getRoot($version=1) {
		$root = ReportSectionQuery::create()->findRoot($version);
		return $root;
	}
	
	protected static function getNewVersionNode($node) {
		$newNode = new ReportSection();
		$newNode->setVersionId(ReportSectionPeer::getNewerVersion());
		$newNode->setCode($node->getCode());
		$newNode->setContent($node->getContent());
		$newNode->setName($node->getName());
		$newNode->setType($node->getType());
		$newNode->setObjectId($node->getObjectId());
		$newNode->setObjectType($node->getObjectType());
		$documents = $node->getDocuments();
		foreach ($documents as $document) {
			$newNode->addDocument($document);
		}
		return $newNode;
	}
	
	public static function createNewVersion() {
		$previousVersion = ReportSectionPeer::getPreviousVersion();
		
		$root = ReportSectionPeer::getRoot($previousVersion);

		$newRoot = ReportSectionPeer::getNewVersionNode($root);
		$newRoot->makeRoot();
		$newRoot->save();

		ReportSectionPeer::generateNewVersions($root,$newRoot);

	}

	protected static function generateNewVersions($parentNode,$newParentNode) {
		foreach ($parentNode->getChildren() as $node) {
			$newNode = ReportSectionPeer::getNewVersionNode($node);
			$newNode->insertAsLastChildOf($newParentNode);
			$newNode->save();
			ReportSectionPeer::generateNewVersions($node,$newNode);
		}
	}
	
	public static function createVersionFromCurrentEntities() {
		$rootType = ConfigModule::get("reportSections","treeRootType");
		$versionId = ReportSectionPeer::getNewerVersion();
		
		$newNode = new ReportSection();
		$newNode->setCode(ReportSectionPeer::getNextCode());
		$newNode->setVersionId($versionId);
		$newNode->setType($rootType);
		$newNode->makeRoot();
		$newNode->save();
		
		$firstObjPeer = ReportSectionPeer::$objectTypes[$rootType + 1] . 'Peer';
		$firstObjects = call_user_func(array($firstObjPeer, 'getAll'));
		foreach ($firstObjects as $object) {
			ReportSectionPeer::createSubTreeFromCurrentEntities($object, $rootType + 1, $versionId, $newNode->getId());
		}
	}
	
	protected static function createSubTreeFromCurrentEntities($object, $objType, $versionId, $parentNodeId) {
		// Necesario para actualizar la version en memoria del nodo.
		$parentNode = ReportSectionPeer::get($parentNodeId);
		
		$newNode = new ReportSection();
		$newNode->setCode(ReportSectionPeer::getNextCode());
		$newNode->setVersionId($versionId);
		$newNode->setName($object->getName());
		$newNode->setType($objType);
		$newNode->setObjectId($object->getId());
		$newNode->setObjectType(ReportSectionPeer::$objectTypes[$objType]);
		$newNode->insertAsLastChildOf($parentNode);
		$newNode->save();
		
		$childsObjName = ReportSectionPeer::$objectTypes[$objType + 1];
		if (!empty($childsObjName)) {
			$childs = call_user_func(array($object, 'get'.$childsObjName.'s'));
			foreach ($childs as $child) {
				ReportSectionPeer::createSubTreeFromCurrentEntities($child, $objType + 1, $versionId, $newNode->getId());		
			}
		}
		return $newNode;
	}
	
	/**
	* Obtiene un arbol a partir de una version.
	*
	*	@return array Arbol
	*/
	public static function getTree($version=1) {
		$sections = ReportSectionQuery::create()->orderByBranch()->findTree($version);
		return $sections;
	}

	/**
	* Obtiene todos los posibles padres a partir de un tipo de sección.
	*
	* @return array Posibles padres a partir de un tipo de sección.
	*/
	function getAllParentsByType($type,$version = 1){
		$treeRoot = ReportSectionQuery::create()->findRoot($version);
		if (!empty($treeRoot))
			$sections = ReportSectionQuery::create()
			->orderByBranch()
			->filterByType(array(
				 'min' => ConfigModule::get("reportSections","treeRootType"),
				 'max' => $type-1,
			))
			->findTree();
		return $sections;
	}
	
	/**
	* Obtiene todos las secciones paginadas.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todas las secciones
	*/
	function getAllPaginated($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"ReportSectionPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria(){
		$criteria = ReportSectionQuery::create()->orderByBranch();
		$criteria->setIgnoreCase(true);

		if ($this->searchString)
			$criteria->add(ReportSectionPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);
		
		if ($this->searchType)
			$criteria->add(ReportSectionPeer::TYPE, $this->searchType, Criteria::IN);
			
		if ($this->searchVersion)
			$criteria->add(ReportSectionPeer::VERSIONID, $this->searchVersion);

		return $criteria;
	}
	
	/**
	* Obtiene todas las secciones paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todas las secciones
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"ReportSectionPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Obtiene todas las secciones paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todas las secciones
	*/
	function getAllFiltered(){
		$cond = $this->getCriteria();
		$sections = ReportSectionPeer::doSelect($cond);
		return $sections;
	}
	
	public static function getVersions() {
		$criteria = new Criteria();
		$criteria->clearSelectColumns();
		$criteria->addSelectColumn(ReportSectionPeer::VERSIONID);
		$criteria->addAscendingOrderByColumn(ReportSectionPeer::VERSIONID);
		$criteria->setDistinct();

		$versions = array();

		$stmt = ReportSectionPeer::doSelectStmt($criteria);
		while($row = $stmt->fetch(PDO::FETCH_NUM)){
			$versions[] = $row[0];
		}

		return $versions;
	}
	
	/**
	* Obtiene todos las posibles secciones a partir de array de tipos de sección.
	*
	* @param array $types Array con los tipos de sección
	* @param int $version Version del organigrama
	* @return array secciones a partir de array de tipos de sección
	*/
	function getAllBySectionType($types,$version){
		$reportSectionPeer = new ReportSectionPeer();
		if (!is_null($types))
			$reportSectionPeer->setSearchType($types);
		$reportSectionPeer->setSearchVersion($version);
		$sections = $reportSectionPeer->getAllFiltered();
		
		return $sections;
	}

	/**
	* Obtiene la versión mas reciente.
	*
	* @return int Numero de versión mas reciente.
	*/
	public static function getLatestVersion()	{
		return ReportSectionPeer::getNewerVersion();
	}
	
	/**
	* Obtiene todas las posibles secciones a partir de una sección
	*
	* @param $section, sección del reporte.
	* @param int $version Version del organigrama
	* @return array secciones a partir de una sección
	*/
	function getAllBySection($section, $version = 1){
		$criteria = ReportSectionQuery::create()->orderByBranch()->inTree($version);

		if (!is_null($section)) {
			$sectionIds = array();
			array_push($sectionIds, $section->getId());
	
			if ($section->hasChildren()){
				$descendants = $section->getDescendants();
				foreach ($descendants as $descendant)
					array_push($sectionIds, $descendant->getId());
			}
			$criteriaOnPosition = $criteria->getNewCriterion(ReportSectionPeer::ID,$sectionIds,Criteria::IN);
			$criteria->addAnd($criteriaOnPosition);
		}
		$sections = $criteria->find();
		return $sections;
	}
} // ReportSectionPeer
