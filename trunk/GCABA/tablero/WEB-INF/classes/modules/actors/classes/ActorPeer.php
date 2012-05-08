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

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"limit" => "setLimit",
					'adminActId' => 'setAdminActId'
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
	 * Especifica un acto administrativo cuyos actores no deben aparecer en la busqueda.
	 * @param int adminActId, id del acto administrativo.
	 */
	function setAdminActId($adminActId){
		$this->adminActId = $adminActId;
	}

	/**
	* Obtiene un actor.
	*
	* @param int $id id del actor
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$actor = ActorQuery::create()->findPk($id);
		return $actor;
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
		$criteria = new Criteria();
		$criteria->add(ActorPeer::DELETED_AT, null, Criteria::ISNOTNULL);
		ActorPeer::disableSoftDelete();
		$actors = ActorPeer::doSelect($criteria);
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
	 * Retorna el criteria generado a partir de los par�metros de b�squeda
	 *
	 * @return criteria $criteria Criteria con par�metros de b�squeda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->setLimit($this->limit);
		$criteria->addAscendingOrderByColumn(ActorPeer::ID);
		
		if (!empty($this->adminActId)) {
			$actorsParticipatingIds = AdminActParticipantQuery::create()
									->filterByAdminActId($this->adminActId)
									->filterByObjectType('Actor')
									->select('Objectid')
									->find();
			$criteria->add(ActorPeer::ID, $actorsParticipatingIds,Criteria::NOT_IN);
		}

		if ($this->searchString){
			$criteria->add(ActorPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionSurname = $criteria->getNewCriterion(ActorPeer::SURNAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionSurname);
			$criterionInstitution = $criteria->getNewCriterion(ActorPeer::INSTITUTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionInstitution);
		}

		return $criteria;

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
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"ActorPeer", "doSelect",$page,$perPage);
		return $pager;
	}

 /**
	* Obtiene todos los actor paginados segun la condicion de busqueda ingresada.
	*
	* @return array Informacion sobre todos los actores
	*/
	function getAll()	{
		$criteria = $this->getSearchCriteria();
		$allObjects = ActorPeer::doSelect($criteria);
		return $allObjects;
	}

} // ActorPeer
