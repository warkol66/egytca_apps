<?php



/**
 * Skeleton subclass for performing query and update operations on the 'projects_activity' table.
 *
 * Activity
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.projects.classes
 */
class ProjectActivityPeer extends BaseProjectActivityPeer {

 /** the default item name for this class */
	const ITEM_NAME = 'Activities';

	private $searchString;
	private $searchPositionId;
	private $searchRegionId;
	private $searchDelayed;
	private $searchEnded;
	private $searchWorking;
	private $searchProjectId;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"position"=>"setSearchPosition",
					"region"=>"setSearchRegion",
					"delayed"=>"setSearchDelayed",
					"ended"=>"setSearchEnded",
					"working"=>"setSearchWorking",
					"projectId"=>"setSearchProjectId"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

 /**
	 * Especifica un objetivo para la busqueda
	 * @param $objectiveId id de objetivo
	 */
	function setSearchProjectId($projectId){
		$this->searchProjectId = $projectId;
	}

 /**
	 * Indica una dependencia para la que se deberan buscar resultados.
	 * @param $dependecyId id de dependencia
	 */
	function setSearchPosition($positionId){
		$this->searchPosition = $positionId;
	}

 /**
	 * Indica una region para la cual se deberan buscar resultados.
	 * @param $regionId id de region
	 */
	function setSearchRegion($regionId){
		$this->searchRegionId = $regionId;
	}

 /**
	 * Indica que se deberan buscar aquellos proyectos que se encuentran retrasados.
	 *
	 */
	function setSearchDelayed(){
		$this->searchDelayed = true;
	}

 /**
	 * Indica que se deberan buscar aquellos proyectos que se encuentran finalizados.
	 *
	 */
	function setSearchEnded(){
		$this->searchEnded = true;
	}

 /**
	 * Indica que se deberan buscar aquellos proyectos que se encuentran en ejecucion.
	 *
	 */
	function setSearchWorking(){
		$this->searchWorking = true;
	}

 /**
	* Obtiene la informacion de un project.
	*
	* @param int $id id del project
	* @return Project Informacion del project
	*/
	function get($id){
		$obj = self::retrieveByPK($id);
			return $obj;
	}

 /**
	* Crea un activity nuevo.
	*
	* @param array $paramsProject con los datos del proyecto
	* @return boolean true si se creo el project correctamente, false sino
	*/
	function create($objParams,$con = null) {
		$newObj = new ProjectActivity();
		foreach ($objParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($newObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$newObj->$setMethod($value);
				else
					$newObj->$setMethod(null);
			}
		}
		try {
			$newObj->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
 /**
	* Actualiza la informacion de un activity.
	*
	* @param int $id id del activity
	* @param array $paramsObj con los datos del actividad
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$object = ProjectActivityPeer::retrieveByPK($id);
		if ((ConfigModule::get("projects","useLogs")) &&
			 (((ConfigModule::get("projects","useMinorChanges")) && (empty($params["minorChange"]))) ||
			 (!ConfigModule::get("projects","useMinorChanges")))) {
			$objectLog = new ProjectActivityLog();
			$objectLog = Common::morphObjectValues($object,$objectLog);
			$objectLog->setId(NULL);
			$objectLog->setActivityId($id);
			$objectLog->setUpdated(time());
			try {
				$objectLog->save();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
		}
		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($object,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$object->$setMethod($value);
				else
					$object->$setMethod(null);
			}
		}
		$object->setUpdated(time());
		$object->setLastModification(time());
		if (method_exists($object,"getChanges")) {
			$changes = $object->getChanges() + 1;
			$object->setChanges($changes);
		}
		try {
			$object->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Retorna el criteria generado a partir de lso par�metros de b�squeda
	 *
	 * @return criteria $criteria Criteria con par�metros de b�squeda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->addAscendingOrderByColumn(ProjectActivityPeer::ID);

		if ($this->searchString)
			$criteria->add(ProjectActivityPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);

		if (!empty($this->searchObjectiveId))
			$criteria->add(ProjectActivityPeer::OBJECTIVEID,$this->searchObjectiveId);

		if (!empty($this->searchProjectId))
			$criteria->add(ProjectActivityPeer::PROJECTID,$this->searchProjectId);

		if (!empty($this->searchDelayed)) {
			//no finalizado y su fecha de de finalizacion es anterior a la actual.
			$criterionFinished = $criteria->getNewCriterion(ProjectActivityPeer::GOALEXPIRATIONDATE, date('Y-m-d') . " 00:00:00", Criteria::LESS_EQUAL);
			$criterionFinished->addAnd($criteria->getNewCriterion(ProjectActivityPeer::FINISHED,0,Criteria::EQUAL));
		}
		if (!empty($this->searchEnded)) {
			if (empty($criterionFinished))
				$criterionFinished = $criteria->getNewCriterion(ProjectActivityPeer::FINISHED,1,Criteria::EQUAL);
			else
				$criterionFinished->addOr($criteria->getNewCriterion(ProjectActivityPeer::FINISHED,1,Criteria::EQUAL));
		}
		if (!empty($this->searchWorking)) {
			if (empty($criterionFinished))
				$criterionFinished = $criteria->getNewCriterion(ProjectActivityPeer::FINISHED,0,Criteria::EQUAL);
			else
				$criterionFinished->addOr($criteria->getNewCriterion(ProjectActivityPeer::FINISHED,0,Criteria::EQUAL));
		}
		if (!empty($criterionFinished))
			$criteria->addOr($criterionFinished);
			
		if (ConfigModule::get('users', 'useFilterByUserGroup')) {
			$user = Common::getAdminLogged();
			if (!empty($user) && !$user->isAdmin() && !$user->isSupervisor()) {
				$userGroupsIds = Common::getAdminGroupsIds();
				$criteriaOnGroups = $criteria->getNewCriterion(PositionPeer::USERGROUPID, $userGroupsIds, Criteria::IN);
				$criteria->addAnd($criteriaOnGroups);
				$criteria->addJoin(ProjectActivityPeer::PROJECTID, ProjectPeer::ID, Criteria::INNER_JOIN);
				$criteria->addJoin(ProjectPeer::RESPONSIBLECODE, PositionPeer::CODE, Criteria::INNER_JOIN);	
			}
		}

		return $criteria;

	}
 /**
	* Obtiene todos los projects paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los projects
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"ProjectActivityPeer", "doSelect",$page,$perPage);
		return $pager;
	}

} // ProjectActivityPeer
