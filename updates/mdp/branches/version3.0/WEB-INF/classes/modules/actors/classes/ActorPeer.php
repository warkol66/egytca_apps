<?php



/**
 * Skeleton subclass for performing query and update operations on the 'actors_actor' table.
 *
 * Base de Actores
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.actors.classes
 */
class ActorPeer extends BaseActorPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Actors';

	private $searchString;
	private $limit;
	private $orderByName;
	private $orderBySurname;
	private $orderByInstitution;

	private $includeDeleted;

	private $adminActId;
	private $issueId;
	private $headlineId;

	private $relatedObject;
	private $candidates;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"limit" => "setLimit",
					"orderByName"=>"setOrderByName",
					"orderBySurname"=>"setOrderBySurname",
					"orderByInstitution"=>"setOrderByInstitution",
					"includeDeleted" => "setIncludeDeleted",
					"perPage"=>"setPerPage",
					"relatedObject" => "setRelatedObject",
					"adminActId" => "setAdminActId",
					"issueId" => "setIssueId",
					"headlineId" => "setHeadlineId",
					"getCandidates" => "setCandidates"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}
	
 /**
	 * Especifica cantidad de resultados por pagina.
	 * @param perPage integer cantidad de resultados por pagina.
	 */
	function setPerPage($perPage){
		$this->perPage = $perPage;
	}

 	/**
	 * Especifica una cantidad maxima de registros.
	 * @param limit cantidad maxima de registros.
	 */
	function setLimit($limit){
		$this->limit = $limit;
	}

 /**
	 * Especifica si ordena los resultados por nombre
	 * @param orderByName tipo de orden "asc" o "desc"
	 */
	function setOrderByName($orderByName){
		$this->orderByName = $orderByName;
	}

 /**
	 * Especifica si ordena los resultados por Surname
	 * @param orderByName tipo de orden "asc" o "desc"
	 */
	function setOrderBySurname($orderBySurname){
		$this->orderBySurname = $orderBySurname;
	}

 /**
	 * Especifica si ordena los resultados por Institution
	 * @param orderByName tipo de orden "asc" o "desc"
	 */
	function setOrderByInstitution($orderByInstitution){
		$this->orderByInstitution = $orderByInstitution;
	}

	/**
	 * Especifica un acto administrativo cuyos actores no deben aparecer en la busqueda.
	 * @param int adminActId, id del acto administrativo.
	 */
	function setAdminActId($adminActId){
		$this->adminActId = $adminActId;
	}

	/**
	 * Especifica un asunto cuyos actores no deben aparecer en la busqueda.
	 * @param int issueId, id del issue.
	 */
	function setIssueId($issueId){
		$this->issueId = $issueId;
	}

	/**
	 * Especifica un objeto cuyos con actores relacionados
	 * @param object relatedObject, Objeto relacionado
	 */
	function setRelatedObject($relatedObject){
		$this->relatedObject = $relatedObject;
	}

	/**
	 * Especifica un headline cuyos actores no deben aparecer en la busqueda.
	 * @param int headlineId, id del headline.
	 */
	function setHeadlineId($headlineId){
		$this->headlineId = $headlineId;
	}

	/**
	 * Especifica un headline cuyos actores no deben aparecer en la busqueda.
	 * @param int headlineId, id del headline.
	 */
	function setCandidates($candidates){
		$this->candidates = $candidates;
	}

	/**
	 * Especifica si se incluyen los eliminados
	 * @param bool includeDeleted, indica si se incluyen los elimindos
	 */
	function setIncludeDeleted($includeDeleted){
		$this->includeDeleted = $includeDeleted;
	}

	/**
	* Obtiene un actor.
	*
	* @param int $id id del actor
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		return ActorQuery::create()->findPk($id);
	}

 /**
	* Crea un actor nuevo.
	*
	* @param array $params con los datos del proyecto
	* @return boolean true si se creo el actor correctamente, false sino
	*/
	function create($params,$con = null) {
		$actor = new Actor();
		$actor = Common::setObjectFromParams($actor,$params);
		try {
			$actor->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un actor.
	*
	* @param int $id id del actor
	* @param array $params datos del actor
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$actor = ActorQuery::create()->findPk($id);
		$actor = Common::setObjectFromParams($actor,$params);
		try {
			$actor->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Elimina un actor a partir de los valores de la clave.
	*
	* @param int $id id del actor
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$actor = ActorPeer::retrieveByPK($id);
		try {
			$actor->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un actor a partir del id.
	*
	* @param int $id Id del actor
	* @return boolean true
	*/
  function hardDelete($id) {
		ActorPeer::disableSoftDelete();
		$actor = ActorPeer::retrieveByPk($id);
		try {
			$actor->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Obtiene todos los actor desactivados.
	*
	*	@return array Informacion sobre los actor
	*/
	function getSoftDeleted() {
		ActorQuery::disableSoftDelete();
		$actors = ActorQuery::create()->filterByDeletedAt(NULL, Criteria::NOT_EQUAL)->find();
		return $actors;
  }

	/**
	* Recupera del softdelete un actor
	*
	* @param int $id Id del actor
	* @return boolean true
	*/
  function recoverDeleted($id) {
		ActorPeer::disableSoftDelete();
		$actor = ActorPeer::retrieveByPk($id);
		try {
			$actor->unDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Retorna el criteria generado a partir de los parametros de busqueda
	 *
	 * @return criteria $criteria Criteria con parametros de busqueda
	 */
	private function getSearchCriteria() {
		$criteria = ActorQuery::create();

		$criteria->setIgnoreCase(true);
		$criteria->setLimit($this->limit);

		if (isset($this->orderByName) && $this->orderByName == "asc")
			$criteria->orderByName();
		else if (isset($this->orderByName) && $this->orderByName == "desc")
			$criteria->orderByName(Criteria::DESC);
		if (isset($this->orderBySurname) && $this->orderBySurname == "asc")
			$criteria->orderBySurname();
		else if (isset($this->orderBySurname) && $this->orderBySurname == "desc")
			$criteria->orderBySurname(Criteria::DESC);
		if (isset($this->orderByInstitution) && $this->orderByInstitution == "asc")
			$criteria->orderByInstitution();
		else if (isset($this->orderByInstitution) && $this->orderByInstitution == "desc")
			$criteria->orderByInstitution(Criteria::DESC);
		else
			$criteria->orderById();
		
		if ($this->includeDeleted)
			ActorPeer::disableSoftDelete();

		if (!empty($this->relatedObject)) {
			if (empty($this->candidates))
				$criteria->filterBy($this->relatedObject);
			else
				$criteria->add(ActorPeer::ID, $this->relatedObject->getAssignedActorsArray(), Criteria::NOT_IN);
		}

		if ($this->searchString) {
			$criteria->add(ActorPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionSurname = $criteria->getNewCriterion(ActorPeer::SURNAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionSurname);
			$criterionInstitution = $criteria->getNewCriterion(ActorPeer::INSTITUTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionInstitution);
		}

//A eliminar con relatedObject
		if (!empty($this->adminActId)) {
			$actorsParticipatingIds = AdminActParticipantQuery::create()
									->filterByAdminActId($this->adminActId)
									->filterByObjectType('Actor')
									->select('Objectid')
									->find();
			$criteria->add(ActorPeer::ID, $actorsParticipatingIds,Criteria::NOT_IN);
		}

		return $criteria;

	}

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		if (!isset($this->perPage))
			$this->perPage = Common::getRowsPerPage();
		return $this->perPage;
	}

 /**
	* Obtiene todos los actor paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los actores
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = $this->getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"ActorPeer", "doSelect",$page,$perPage);
		return $pager;
	}

 /**
	* Obtiene todos los actor existentes filtrados por la condicion $criteria
	* @return PropelObjectCollection Todos los actores
	*/
	function getAll() {
    $criteria = $this->getSearchCriteria();    
		return ActorPeer::doSelect($criteria);
	}

} // ActorPeer
