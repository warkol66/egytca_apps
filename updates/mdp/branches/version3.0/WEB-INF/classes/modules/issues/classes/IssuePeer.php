<?php



/**
 * Skeleton subclass for performing query and update operations on the 'issues_issue' table.
 *
 * Asuntos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.issues.classes
 */
class IssuePeer extends BaseIssuePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Issues';

	//Tipos de impacto
	const IMPACT_LOW          = 1;
	const IMPACT_MED          = 5;
	const IMPACT_HIGH         = 9;

	protected static $issueImpactTypes = array(
						IssuePeer::IMPACT_LOW          => 'Low',
						IssuePeer::IMPACT_MED          => 'Medium',
						IssuePeer::IMPACT_HIGH         => 'High'
					);

	/**
	 * Devuelve los tipos de Impacto
	 */
	public static function getIssueImpactTypes() {
		$issueImpactTypes = IssuePeer::$issueImpactTypes;
		return $issueImpactTypes;
	}

	//Estados de asuntos
	const EVOLUTION_EMERGENT            = 1;
	const EVOLUTION_GROWING             = 2;
	const EVOLUTION_STABLE              = 3;
	const EVOLUTION_PLATEAU             = 4;
	const EVOLUTION_DECLINING           = 5;
	const EVOLUTION_CLOSED              = 6;
	
	protected static $issueEvolutionStages = array(
						IssuePeer::EVOLUTION_EMERGENT      => 'Emergent',
						IssuePeer::EVOLUTION_GROWING       => 'Growing',
						IssuePeer::EVOLUTION_STABLE        => 'Stable',
						IssuePeer::EVOLUTION_PLATEAU       => 'Plateau',
						IssuePeer::EVOLUTION_DECLINING     => 'Declining',
						IssuePeer::EVOLUTION_CLOSED        => 'Closed'
					);

	/**
	 * Devuelve los tipos de Impacto
	 */
	public static function getIssueEvolutionStages() {
		$issueEvolutionStages = IssuePeer::$issueEvolutionStages;
		return $issueEvolutionStages;
	}

	//Tipos de impacto
	const VALORATION_HIGHLY_POSITIVE     = 1;
	const VALORATION_POSITIVE            = 2;
	const VALORATION_NEUTRAL             = 3;
	const VALORATION_NEGATIVE            = 4;
	const VALORATION_HIGHLY_NEGATIVE     = 5;

	protected static $issueValorationTypes = array(
						IssuePeer::VALORATION_HIGHLY_POSITIVE     => 'Higly positive',
						IssuePeer::VALORATION_POSITIVE            => 'Positive',
						IssuePeer::VALORATION_NEUTRAL             => 'Neutral',
						IssuePeer::VALORATION_NEGATIVE            => 'Negative',
						IssuePeer::VALORATION_HIGHLY_NEGATIVE     => 'Highly negative'
					);

	/**
	 * Devuelve los tipos de Impacto
	 */
	public static function getIssueValorationTypes() {
		$issueValorationTypes = IssuePeer::$issueValorationTypes;
		return $issueValorationTypes;
	}

	private $searchString;
	private $limit;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"categoryId"=>"setCategoryId",
					"impact"=>"setImpact",
					"valoration"=>"setValoration",
					"evolution"=>"setEvolution",
					"limit" => "setLimit"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}
	
 	/**
	 * Especifica una cantidad maxima de registros.
	 * @param limit cantidad maxima de registros.
	 */
	function setLimit($limit){
		$this->limit = $limit;
	}
	
 	/**
	 * Especifica una categoria de busqueda.
	 * @param categoryId categoria de busqueda
	 */
	function setCategoryId($categoryId){
		$this->categoryId = $categoryId;
	}

 	/**
	 * Especifica una valoration de busqueda.
	 * @param valoration valoration de busqueda
	 */
	function setValoration($valoration){
		$this->valoration = $valoration;
	}

 	/**
	 * Especifica una categoria de busqueda.
	 * @param impact impact de busqueda
	 */
	function setImpact($impact){
		$this->impact = $impact;
	}

 	/**
	 * Especifica una evolution de busqueda.
	 * @param evolution evolution de busqueda
	 */
	function setEvolution($evolution){
		$this->evolution = $evolution;
	}

	/**
	* Obtiene un issue.
	*
	* @param int $id id del issue
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$issue = IssueQuery::create()->findPk($id);
		return $issue;
	}

 /**
	* Crea un issue nuevo.
	*
	* @param array $params con los datos del proyecto
	* @return boolean true si se creo el issue correctamente, false sino
	*/
	function create($params,$con = null) {
		$issue = new Issue();
		$issue = Common::setObjectFromParams($issue,$params);
		try {
			$issue->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un issue.
	*
	* @param int $id id del issue
	* @param array $params datos del issue
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$issue = IssueQuery::create()->findPk($id);
		$issue = Common::setObjectFromParams($issue,$params);
		try {
			$issue->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Elimina un issue a partir de los valores de la clave.
	*
	* @param int $id id del issue
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$issue = IssuePeer::retrieveByPK($id);
		try {
			$issue->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un issue a partir del id.
	*
	* @param int $id Id del issue
	* @return boolean true
	*/
  function hardDelete($id) {
		IssuePeer::disableSoftDelete();
		$issue = IssuePeer::retrieveByPk($id);
		try {
			$issue->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Obtiene todos los issue desactivados.
	*
	*	@return array Informacion sobre los issue
	*/
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(IssuePeer::DELETED_AT, null, Criteria::ISNOTNULL);
		IssuePeer::disableSoftDelete();
		$issues = IssuePeer::doSelect($criteria);
		return $issues;
  }

	/**
	* Recupera del softdelete un issue
	*
	* @param int $id Id del issue
	* @return boolean true
	*/
  function recoverDeleted($id) {
		IssuePeer::disableSoftDelete();
		$issue = IssuePeer::retrieveByPk($id);
		try {
			$issue->unDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Retorna el criteria generado a partir de los par?metros de b?squeda
	 *
	 * @return criteria $criteria Criteria con par?metros de b?squeda
	 */
	private function getSearchCriteria(){
		$criteria = new IssueQuery();
		$criteria->setLimit($this->limit);
		$criteria->addAscendingOrderByColumn(IssuePeer::ID);

		if ($this->categoryId) {
			$categoryIds = array();
			array_push($categoryIds, $this->categoryId);

			$category = IssueCategoryPeer::get($this->categoryId);
			if ($category->hasChildren()){
				$descendants = $category->getDescendants();
				foreach ($descendants as $descendant)
					array_push($categoryIds, $descendant->getId());
			}
			$issuesOnCategory = IssueCategoryRelationQuery::create()->select('Issueid')->add(IssueCategoryRelationPeer::CATEGORYID,$categoryIds,Criteria::IN)->find()->toArray();
			$criteria->add(IssuePeer::ID,$issuesOnCategory,Criteria::IN);
		}

		if ($this->evolution)
			$criteria->add(IssuePeer::EVOLUTION,$this->evolution);

		if ($this->valoration)
			$criteria->add(IssuePeer::VALORATION,$this->valoration);

		if ($this->impact)
			$criteria->add(IssuePeer::IMPACT,$this->impact);

		if ($this->searchString){
			$criteria->setIgnoreCase(true);
			$criteria->add(IssuePeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionDescription = $criteria->getNewCriterion(IssuePeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionDescription);
		}

		return $criteria;

	}

 /**
	* Obtiene todos los issue paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los issues
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"IssuePeer", "doSelect",$page,$perPage);
		return $pager;
	}

 /**
	* Obtiene todos los issue paginados segun la condicion de busqueda ingresada.
	*
	* @return array Informacion sobre todos los issues
	*/
	function getAll()	{
		$criteria = $this->getSearchCriteria();
		$allObjects = IssuePeer::doSelect($criteria);
		return $allObjects;
	}

} // IssuePeer
