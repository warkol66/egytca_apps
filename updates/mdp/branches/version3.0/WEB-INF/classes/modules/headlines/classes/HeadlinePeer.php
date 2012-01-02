<?php



/**
 * Skeleton subclass for performing query and update operations on the 'headlines_headline' table.
 *
 * Headline
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class HeadlinePeer extends BaseHeadlinePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Headlines';
	
	const SPOKESMAN   = 1;
	const MENTION     = 2;
	const JOURNALIST  = 3;

	protected static $headlineRoles = array(
						HeadlinePeer::SPOKESMAN        => 'Vocero',
						HeadlinePeer::MENTION          => 'Mencionado',
						HeadlinePeer::JOURNALIST       => 'Periodista'
					);

	/**
	 * Devuelve los tipos de rol
	 */
	public static function getHeadlineRoles() {
		$headlineRoles = HeadlinePeer::$headlineRoles;
		return $headlineRoles;
	}

	/**
	* Obtiene el nombre traducido del tipo de rol.
	*
	* @return array tipos de rol traducido
	*/
	function getHeadlineRolesTranslated() {
		$roles = $this->getHeadlineRoles();
		foreach ($roles as $role)
			$role[1] = Common::getTranslatedArray($role[1],'headlines');
		return $roles;
	}

	private $searchString;
	private $limit;
	private $adminActId;
	private $issueId;
	private $actorId;
	private $headlineId;
	private $candidates;

				//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"perPage"=>"setPerPage",
					"limit" => "setLimit",
					'adminActId' => 'setAdminActId',
					'issueId' => 'setIssueId',
					'actorId' => 'setActorId',
					'getCandidates' => 'setCandidates',
					'headlineId' => 'setHeadlineId'
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
	 * Especifica un acto administrativo cuyos headlines no deben aparecer en la busqueda.
	 * @param int adminActId, id del acto administrativo.
	 */
	function setAdminActId($adminActId){
		$this->adminActId = $adminActId;
	}

	/**
	 * Especifica un asunto cuyos headlines no deben aparecer en la busqueda.
	 * @param int issueId, id del issue.
	 */
	function setIssueId($issueId){
		$this->issueId = $issueId;
	}

				/**
	 * Especifica un actor cuyos headlines no deben aparecer en la busqueda.
	 * @param int actorId, id del actor.
	 */
	function setActorId($actorId){
		$this->actorId = $actorId;
	}

				/**
	 * Especifica un headline cuyos headlines no deben aparecer en la busqueda.
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
	* Obtiene un headline.
	*
	* @param int $id id del headline
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		return HeadlineQuery::create()->findPk($id);
	}

	/**
	* Crea un headline nuevo.
	*
	* @param array $params con los datos del proyecto
	* @return boolean true si se creo el headline correctamente, false sino
	*/
	function create($params,$con = null) {
		$headline = new Headline();
		$headline = Common::setObjectFromParams($headline,$params);
		try {
			$headline->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un headline.
	*
	* @param int $id id del headline
	* @param array $params datos del headline
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$headline = HeadlineQuery::create()->findPk($id);
		$headline = Common::setObjectFromParams($headline,$params);
		try {
			$headline->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina un headline a partir de los valores de la clave.
	*
	* @param int $id id del headline
	* @return boolean true si se elimino correctamente el headline, false sino
	*/
	function delete($id){
		$headline = HeadlinePeer::retrieveByPK($id);
		try {
			$headline->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un headline a partir del id.
	*
	* @param int $id Id del headline
	* @return boolean true
	*/
	function hardDelete($id) {
		HeadlinePeer::disableSoftDelete();
		$headline = HeadlinePeer::retrieveByPk($id);
		try {
			$headline->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Obtiene todos los headline desactivados.
	*
	* @return array Informacion sobre los headline
	*/
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(HeadlinePeer::DELETED_AT, null, Criteria::ISNOTNULL);
		HeadlinePeer::disableSoftDelete();
		$headlines = HeadlinePeer::doSelect($criteria);
		return $headlines;
				}

	/**
	* Recupera del softdelete un headline
	*
	* @param int $id Id del headline
	* @return boolean true
	*/
	function recoverDeleted($id) {
		HeadlinePeer::disableSoftDelete();
		$headline = HeadlinePeer::retrieveByPk($id);
		try {
			$headline->unDelete();
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
		$criteria->addDescendingOrderByColumn(HeadlinePeer::ID);

		if (!empty($this->adminActId)) {
			$headlinesParticipatingIds = AdminActParticipantQuery::create()
									->filterByAdminActId($this->adminActId)
									->filterByObjectType('Headline')
									->select('Objectid')
									->find();
			$criteria->add(HeadlinePeer::ID, $headlinesParticipatingIds,Criteria::NOT_IN);
		}

		if (!empty($this->issueId)) {
			$issue = IssueQuery::create()->findPk($this->issueId);
			$issueHeadlinesIds = $issue->getAssignedHeadlinesArray();
			if (!empty($this->candidates))
				$criteria->add(HeadlinePeer::ID, $issueHeadlinesIds,Criteria::NOT_IN);
			else
				$criteria->filterByIssueId($this->issueId);
		}

		if (!empty($this->headlineId)) {
			$headline = HeadlineQuery::create()->findPk($this->headlineId);
			$headlineHeadlinesIds = $headline->getAssignedHeadlinesArray();
			if (!empty($this->candidates))
				$criteria->add(HeadlinePeer::ID, $headlineHeadlinesIds,Criteria::NOT_IN);
			else
				$criteria->filterByHeadlineId($this->headlineId);
		}

		if ($this->searchString) {
			$criteria->add(HeadlinePeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionContent = $criteria->getNewCriterion(HeadlinePeer::CONTENT,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionContent);
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
	* Obtiene todos los headline paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los headlines
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = $this->getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"HeadlinePeer", "doSelect",$page,$perPage);
		return $pager;
	}

	/**
	* Obtiene todos los headline existentes filtrados por la condicion $this->getSearchCriteria()
	* @return PropelObjectCollection Todos los headlines
	*/
	function getAll()	{
    $criteria = $this->getSearchCriteria();    
		return HeadlinePeer::doSelect($criteria);
	}

} // HeadlinePeer
