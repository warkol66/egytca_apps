<?php



/**
 * Skeleton subclass for performing query and update operations on the 'medias_media' table.
 *
 * Archivo de medios
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.medias.classes
 */
class MediaPeer extends BaseMediaPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Medias';

	private $searchString;
	private $perPage;
	private $limit;
	private $includeDeleted;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"perPage"=>"setPerPage",
					"limit" => "setLimit",
					'includeDeleted' => 'setIncludeDeleted'
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
		return MediaQuery::create()->findPk($id);
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
		$criteria->addAscendingOrderByColumn(MediaPeer::ID);
		
		if ($this->includeDeleted)
			MediaPeer::disableSoftDelete();

		if (!empty($this->adminActId)) {
			$actorsParticipatingIds = AdminActParticipantQuery::create()
									->filterByAdminActId($this->adminActId)
									->filterByObjectType('Actor')
									->select('Objectid')
									->find();
			$criteria->add(MediaPeer::ID, $actorsParticipatingIds,Criteria::NOT_IN);
		}

		if (!empty($this->issueId)) {
			$issue = IssueQuery::create()->findPk($this->issueId);
			$issueActorsIds = $issue->getAssignedActorsArray();
			if (!empty($this->candidates))
				$criteria->add(MediaPeer::ID, $issueActorsIds,Criteria::NOT_IN);
			else
				$criteria->filterByIssueId($this->issueId);
		}

		if (!empty($this->headlineId)) {
			$headline = HeadlineQuery::create()->findPk($this->headlineId);
			$headlineActorsIds = $headline->getAssignedActorsArray();
			if (!empty($this->candidates))
				$criteria->add(MediaPeer::ID, $headlineActorsIds,Criteria::NOT_IN);
			else
				$criteria->filterByHeadlineId($this->headlineId);
		}

		if ($this->searchString) {
			$criteria->add(MediaPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionSurname = $criteria->getNewCriterion(MediaPeer::SURNAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionSurname);
			$criterionInstitution = $criteria->getNewCriterion(MediaPeer::INSTITUTION,"%" . $this->searchString . "%",Criteria::LIKE);
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
		$pager = new PropelPager($criteria,"MediaPeer", "doSelect",$page,$perPage);
		return $pager;
	}

 /**
	* Obtiene todos los actor paginados segun la condicion de busqueda ingresada.
	*
	* @return array Informacion sobre todos los actores
	*/
	function getAll()	{
		return ActorQuery::create()->find();
	}

} // MediaPeer
