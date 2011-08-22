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
	private $adminActId;
	private $issueId;
	private $headlineId;
	private $candidates;
	private $includeDeleted;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"perPage"=>"setPerPage",
					"limit" => "setLimit",
					'adminActId' => 'setAdminActId',
					'issueId' => 'setIssueId',
					'headlineId' => 'setHeadlineId',
					'includeDeleted' => 'setIncludeDeleted',
					'getCandidates' => 'setCandidates'
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
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->setLimit($this->limit);
		$criteria->addAscendingOrderByColumn(ActorPeer::ID);
		
		if ($this->includeDeleted)
			ActorPeer::disableSoftDelete();

		if (!empty($this->adminActId)) {
			$actorsParticipatingIds = AdminActParticipantQuery::create()
									->filterByAdminActId($this->adminActId)
									->filterByObjectType('Actor')
									->select('Objectid')
									->find();
			$criteria->add(ActorPeer::ID, $actorsParticipatingIds,Criteria::NOT_IN);
		}

		if (!empty($this->issueId)) {
			$issue = IssueQuery::create()->findPk($this->issueId);
			$issueActorsIds = $issue->getAssignedActorsArray();
			if (!empty($this->candidates))
				$criteria->add(ActorPeer::ID, $issueActorsIds,Criteria::NOT_IN);
			else
				$criteria->filterByIssueId($this->issueId);
		}

		if (!empty($this->headlineId)) {
			$headline = HeadlineQuery::create()->findPk($this->headlineId);
			$headlineActorsIds = $headline->getAssignedActorsArray();
			if (!empty($this->candidates))
				$criteria->add(ActorPeer::ID, $headlineActorsIds,Criteria::NOT_IN);
			else
				$criteria->filterByHeadlineId($this->headlineId);
		}

		if ($this->searchString) {
			$criteria->add(ActorPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionSurname = $criteria->getNewCriterion(ActorPeer::SURNAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionSurname);
			$criterionInstitution = $criteria->getNewCriterion(ActorPeer::INSTITUTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionInstitution);
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
	* Obtiene todos los actor existentes filtrados por la condicion $this->getSearchCriteria()
	* @return PropelObjectCollection Todos los actores
	*/
	function getAll()	{
		return ActorPeer::doSelect($this->getSearchCriteria());
	}

} // ActorPeer
