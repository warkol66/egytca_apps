<?php

/**
 * Skeleton subclass for performing query and update operations on the 'projects_project' table.
 *
 * Project
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.projects.classes
 */
class ProjectPeer extends BaseProjectPeer {

 /** the default item name for this class */
	const ITEM_NAME = 'Projects';

	// mapeo de prioridades
	const CRITICAL    = 1;
	const HIGH        = 2;
	const MEDIUM_HIGH = 3;
	const MEDIUM      = 4;

	//nombre de los tipos de prioridad
	protected static $priorityTypes = array(
						ProjectPeer::CRITICAL      => 'Crítica',
						ProjectPeer::HIGH          => 'Alta',
						ProjectPeer::MEDIUM_HIGH   => 'Media alta',
						ProjectPeer::MEDIUM        => 'Media'
					);

	/**
	 * Devuelve los tipos de prioridad
	 */
	public static function getPriorityTypes() {
		$priorityTypes = ProjectPeer::$priorityTypes;
		return $priorityTypes;
	}

	private $searchString;
	private $searchDependecyId;
	private $searchCommuneId;
	private $searchRegionId;
	private $searchDelayed;
	private $searchEnded;
	private $searchWorking;
	private $searchObjectiveId;
	private $searchVisibility;
	private $searchPriority;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"dependency"=>"setSearchDependency",
					"commune"=>"setSearchCommune",
					"region"=>"setSearchRegion",
					"delayed"=>"setSearchDelayed",
					"ended"=>"setSearchEnded",
					"working"=>"setSearchWorking",
					"objective"=>"setSearchObjective",
					"visibility"=>"setSearchVisibility",
					"priority"=>"setSearchPriority"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

 /**
	 * Especifica un objetivo para la busqueda
	 * @param $objectiveId id de objetivo
	 */
	function setSearchObjective($objectiveId) {
		$this->searchObjectiveId = $objectiveId;
	}

 /**
	 * Indica una dependencia para la que se deberan buscar resultados.
	 * @param $dependecyId id de dependencia
	 */
	function setSearchDependency($dependecyId) {
		$this->searchDependecyId = $dependecyId;
	}

 /**
	 * Indica una comuna para la que se deberan buscar resultados.
	 *
	 * @param $communeId id de la comuna
	 *
	 */
	function setSearchCommune($communeId) {
		$this->searchCommuneId = $communeId;
	}

 /**
	 * Indica una region para la cual se deberan buscar resultados.
	 * @param $regionId id de region
	 */
	function setSearchRegion($regionId) {
		$this->searchRegionId = $regionId;
	}

 /**
	 * Indica una region para la cual se deberan buscar resultados.
	 * @param $regionId id de region
	 */
	function setSearchVisibility($visibility) {
		$this->searchVisibility = $visibility;
	}

 /**
	 * Indica una region para la cual se deberan buscar resultados.
	 * @param $regionId id de region
	 */
	function setSearchPriority($priority) {
		$this->searchPriority = $priority;
	}

 /**
	 * Indica que se deberan buscar aquellos proyectos que se encuentran retrasados.
	 */
	function setSearchDelayed() {
		$this->searchDelayed = true;
	}

 /**
	 * Indica que se deberan buscar aquellos proyectos que se encuentran finalizados.
	 */
	function setSearchEnded() {
		$this->searchEnded = true;
	}

 /**
	 * Indica que se deberan buscar aquellos proyectos que se encuentran en ejecucion.
	 */
	function setSearchWorking() {
		$this->searchWorking = true;
	}

 /**
	* Crea un project nuevo.
	*
	* @param array $paramsProject con los datos del proyecto
	* @return boolean true si se creo el project correctamente, false sino
	*/
	function create($paramsProject,$con = null) {
		$projectObj = new Project();
		foreach ($paramsProject as $key => $value) {
			$setMethod = "set".$key;
			if (method_exists($projectObj,$setMethod)) {
				if (!empty($value) || $value == "0")
					$projectObj->$setMethod($value);
				else
					$projectObj->$setMethod(null);
			}
		}
		try {
			$projectObj->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Crea un proyecto nuevo.
	*
	* @param array $projectParams datos del project
	* @return boolean true si se creo el project correctamente, false sino
	*/
	function createMigration($projectParams,$con = null) {
		$projectObj = new Project();
		foreach ($projectParams as $key => $value) {
			$setMethod = "set".$key;
			if (method_exists($projectObj,$setMethod)) {
				if (!empty($value) || $value == "0")
					$projectObj->$setMethod($value);
				else
					$projectObj->$setMethod(null);
			}
		}

		try {
			$projectObj->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Actualiza la informacion de un project.
	*
	* @param int $id id del project
	* @param array $paramsProject con los datos del proyecto
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$object = ProjectPeer::retrieveByPK($id);
		if ((ConfigModule::get("projects","useLogs")) &&
			 (((ConfigModule::get("projects","useMinorChanges")) && (empty($params["minorChange"]))) ||
			 (!ConfigModule::get("projects","useMinorChanges")))) {
			$objectLog = new ProjectLog();
			$objectLog = Common::morphObjectValues($object,$objectLog);
			$objectLog->setId(NULL);
			$objectLog->setProjectId($id);
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
			if (method_exists($object,$setMethod)) {
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
	* Elimina un project a partir de los valores de la clave.
	*
	* @param int $id id del project
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id) {
		$projectObj = ProjectPeer::retrieveByPK($id);
		$projectObj->delete();
		return true;
	}

 /**
	* Actualiza el orden de un proyecto de un objetivo
	*
	* @param int $projectId ID del proyecto
	* @param int $order nueva posicion del proyecto en el ordenamiento
	* @return boolean true si pudo actualizar sino false
	*/
	function updateOrder($projectId, $order) {
		try {
			$project = ProjectPeer::retrieveByPK($projectId);
			$project->setOrder($order);
			$project->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Actualiza los pesos de los proyectos para su objetivo.
	 *
	 * @param int $projectId ID del proyecto para actualizar.
	 * @param float $weight peso del proyecto para el objetivo.
	 * @return boolean true si pudo actualizar sino false
	 */
	function updateWeight($projectId, $weight) {
		try {
			$project = ProjectPeer::retrieveByPK($projectId);
				$project->setWeight($weight);
				$project->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Obtiene la informacion de un project.
	*
	* @param int $id id del project
	* @return Project Informacion del project
	*/
	function get($id) {
		$projectObj = ProjectPeer::retrieveByPK($id);
			return $projectObj;
	}

 /**
	* Obtiene la informacion de un project a partir de su nombre.
	*
	* @param string $name Nombre del project
	* @return Project Informacion del project
	*/
	function getByName($name,$con = null) {
		$cond = new Criteria();
		$cond->add(ProjectPeer::NAME,$name);
		$project = ProjectPeer::doSelectOne($cond,$con);
		return $project;
	}

 /**
	* Obtiene todos los projects.
	*
	*	@return array Informacion sobre todos los projects
	*/
	function getAll($affiliateId = null) {
		$cond = new Criteria();

		if ($affiliateId != null)  {
			$cond->add(ObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(ObjectivePeer::ID,ProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
		}

		$alls = ProjectPeer::doSelect($cond);
		return $alls;
	}

 /**
	* Obtiene todos los projects paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @param int $affiliateId [optional] Id de Afiliado
	*	@return array Informacion sobre todos los projects
	*/
	function getAllPaginated($page=1,$perPage=-1,$affiliateId = null) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();

		if (empty($page))
			$page = 1;

		$cond = new Criteria();

		if ($affiliateId != null)  {
			$cond->add(ObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(ObjectivePeer::ID,ProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
		}

		$pager = new PropelPager($cond,"ProjectPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

 /**
	* Obtiene todos los projects de un cierto objetivo.
	*
	*	@return array Informacion sobre todos los projects
	*/
	function getAllByObjective($objectiveId,$affiliateId = null) {
		$cond = new Criteria();

		if ($affiliateId != null)  {
			$cond->add(ObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(ObjectivePeer::ID,ProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
		}

		$cond->add(ProjectPeer::OBJECTIVEID,$objectiveId);

		$alls = ProjectPeer::doSelect($cond);
		return $alls;
	}

 /**
	 * Retorna los proyectos del objetivo con su correspondiente peso y orden
	 * @param int $objectiveId Id del objetivo
	 * @return array Informacion de los proyectos para el objetivo dado
	 */
	function getAllByObjectiveHydrated($objectiveId,$method) {
		if ($method == "weight") {
		$projects = ProjectQuery::create()
			->filterByObjectiveId($objectiveId)
			->orderById()
			->find();
		}
		if ($method == "order") {
		$projects = ProjectQuery::create()
			->filterByObjectiveId($objectiveId)
			->orderByOrder()
			->find();
		}
		return $projects;
	 }


 /**
	 * Retorna el criteria generado a partir de lso parï¿½metros de bï¿½squeda
	 *
	 * @return criteria $criteria Criteria con parï¿½metros de bï¿½squeda
	 */
	private function getSearchCriteria() {
		$criteria = new ProjectQuery();
		$criteria->setIgnoreCase(true);
		$criteria->addAscendingOrderByColumn(ProjectPeer::OBJECTIVEID);
		$criteria->addAscendingOrderByColumn(ProjectPeer::PLANNEDSTART);
		$criteria->addAscendingOrderByColumn(ProjectPeer::ID);

		if ($this->searchString)
			$criteria->add(ProjectPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);

		if (!empty($this->searchDependecyId)) {
			$criteria->add(ObjectivePeer::AFFILIATEID,$this->searchDependecyId);
			$criteria->addJoin(ObjectivePeer::ID,ProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
		}

		if (!empty($this->searchVisibility))
			$criteria->add(ProjectPeer::VISIBILITY,$this->searchVisibility,CRITERIA::GREATER_EQUAL);

		if (!empty($this->searchPriority)) {
			$criteria->add(ProjectPeer::PRIORITY,$this->searchPriority,CRITERIA::LESS_EQUAL);
			$criteriaOnPriority = $criteria->getNewCriterion(ProjectPeer::PRIORITY, 0, Criteria::GREATER_THAN);
			$criteria->addAnd($criteriaOnPriority);
		}

		if (!empty($this->searchObjectiveId))
			$criteria->add(ProjectPeer::OBJECTIVEID,$this->searchObjectiveId);

		if (ConfigModule::get('users', 'useFilterByUserGroup')) {
			$user = Common::getAdminLogged();
			if (!empty($user) && !$user->isAdmin() && !$user->isSupervisor()) {
				$userGroupsIds = Common::getAdminGroupsIds();
				$criteriaOnGroups = $criteria->getNewCriterion(PositionPeer::USERGROUPID, $userGroupsIds, Criteria::IN);
				$criteria->addAnd($criteriaOnGroups);
				$criteria->addJoin(ProjectPeer::RESPONSIBLECODE, PositionPeer::CODE, Criteria::INNER_JOIN);
			}
		}

		//Busqueda sobre region
		if (!empty($this->searchRegionId)) {
			$regionIds = array();
			array_push($regionIds, $this->searchRegionId);

			$region = RegionPeer::get($this->searchRegionId);
			if ($region->hasChildren()){
				$descendants = $region->getDescendants();
				foreach ($descendants as $descendant)
					array_push($regionIds, $descendant->getId());
			}
			$criteriaOnRegion = $criteria->getNewCriterion(ProjectRegionPeer::REGIONID,$regionIds,Criteria::IN);
			$criteria->addAnd($criteriaOnRegion);
			$criteria->addJoin(ProjectPeer::ID,ProjectRegionPeer::PROJECTID, Criteria::INNER_JOIN);
		}

		if (!empty($this->searchDelayed)) {
			//no finalizado y su fecha de de finalizacion es anterior a la actual.
			$criterionFinished = $criteria->getNewCriterion(ProjectPeer::PLANNEDEND, date('Y-m-d') . " 00:00:00", Criteria::LESS_EQUAL);
			$criterionFinished->addAnd($criteria->getNewCriterion(ProjectPeer::FINISHED,0,Criteria::EQUAL));
		}

		if (!empty($this->searchEnded)) {
			//buscamos finalizados
			if (empty($criterionFinished))
				$criterionFinished = $criteria->getNewCriterion(ProjectPeer::FINISHED,1,Criteria::EQUAL);
			else
				$criterionFinished->addAnd($criteria->getNewCriterion(ProjectPeer::FINISHED,1,Criteria::EQUAL));
		}

		if (!empty($this->searchWorking)) {
			//buscamos no finalizados
			if (empty($criterionFinished))
				$criterionFinished = $criteria->getNewCriterion(ProjectPeer::FINISHED,0,Criteria::EQUAL);
			else
				$criterionFinished->addAnd($criteria->getNewCriterion(ProjectPeer::FINISHED,0,Criteria::EQUAL));
		}

		if (!empty($criterionFinished))
			$criteria->addAnd($criterionFinished);

		return $criteria;

	}

 /**
	* Obtiene todos los projects paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los projects
	*/
	function getSearchPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getSearchCriteria();
		$pager = new PropelPager($cond,"ProjectPeer", "doSelect",$page,$perPage);
		return $pager;
	}

	/**
	* Obtiene todas las activities con las opciones de filtro asignadas al peer.
	*
	*/
	function getAllFiltered() {
		$cond = $this->getSearchCriteria();
		return ProjectPeer::doSelect($cond);
	}


 /**
	* Obtiene todos los projects según las dependencias a graficar.
	*
	* @param array $depdendencyObjs Un array con las dependencias de lso que se buscaran lso proyectos
	* @return array Informacion sobre todos los projects
	*/
	function getProjectsToMap($depdendencyObjs) {
		$criteria = new Criteria();
		$criteria->addJoin(ProjectPeer::OBJECTIVEID, ObjectivePeer::ID, Criteria::INNER_JOIN);
		$criteria->add(ProjectPeer::CONSTRUCTION, 1);
		$criteria->add(ProjectPeer::LATITUDE, null,Criteria::ISNOTNULL);
		$criteria->add(ProjectPeer::LONGITUDE, null,Criteria::ISNOTNULL);

		foreach ($depdendencyObjs as $depdendency) {

			if (empty($criterion))
				$criterion = $criteria->getNewCriterion(ObjectivePeer::AFFILIATEID, $depdendency->getId(), Criteria::NOT_EQUAL);
			else
				$criterion->addOr($criteria->getNewCriterion(ObjectivePeer::AFFILIATEID, $depdendency->getId(), Criteria::NOT_EQUAL));

		}
		if (!empty($criterion))
			$criteria->addOr($criterion);

		$projects = ProjectPeer::doSelect($criteria);
		return $projects;

	}

 /**
	* Obtiene todos los regions posibles a elegir
	*
	* @param int $id Id del proyecto
	* @return array regiones disponibles para ser agregadas al proyecto
	*/
	function getRegionCandidates($id) {
		$project = ProjectPeer::get($id);
		if (!empty($project))
			$objectiveId = $project->getObjectiveId();
		else
			return NULL;
		$objectiveCriteria = new Criteria();
		$objectiveCriteria->add(ObjectiveRegionPeer::OBJECTIVEID, $objectiveId);
			$regionObjectives = ObjectiveRegionPeer::doSelect($objectiveCriteria);


			if (!empty($regionObjectives)) {//El objetivo tiene region asociada, solo permito iguales o descendientes

			$criteria = new Criteria();

			foreach ($regionObjectives as $regionObjective) {
				$region = RegionPeer::get($regionObjective->getRegionId());
					if (empty($criterionRegion))
						$criterionRegion = $criteria->getNewCriterion(RegionPeer::ID,$region->getId());
					else
						$criterionRegion->addOr($criteria->getNewCriterion(RegionPeer::ID,$region->getId()));
				$descendants = $region->getDescendants();
				foreach ($descendants as $descendant){
					if (empty($criterionRegion))
						$criterionRegion = $criteria->getNewCriterion(RegionPeer::ID,$descendant->getId());
					else
						$criterionRegion->addOr($criteria->getNewCriterion(RegionPeer::ID,$descendant->getId()));
				}
				if (!empty($criterionRegion)){
					$criteria->addAnd($criterionRegion);
				}
			}
			$not_in_query = RegionPeer::ID . ' NOT IN (SELECT ' . ProjectRegionPeer::REGIONID . '
											FROM ' . ProjectRegionPeer::TABLE_NAME . '
											WHERE ' . ProjectRegionPeer::PROJECTID . ' = ' . $id . ')';
			$criteria->addAnd(RegionPeer::ID, $not_in_query, Criteria::CUSTOM);
			$regions = RegionPeer::doSelect($criteria);

			} else { //El objetivo no tiene region asociada

			$criteria = new Criteria();
			$not_in_query = RegionPeer::ID . ' NOT IN (SELECT ' . ProjectRegionPeer::REGIONID . '
											FROM ' . ProjectRegionPeer::TABLE_NAME . '
											WHERE ' . ProjectRegionPeer::PROJECTID . ' = ' . $id . ')';
			$criteria->add(RegionPeer::ID, $not_in_query, Criteria::CUSTOM);
			$regions = RegionPeer::doSelect($criteria);
			}

		return $regions;
	}

	/**
	 * Devuelve la criteria para filtrar por fecha de inicio planificada a fin de armar una agenda de actividades.
	 */
	public static function getScheduleCriteriaForPlannedStart() {
		$max = new DateTime('today');
		$min = new DateTime('today');
		$panelConfig = Common::getConfiguration('Panel');
		$schedulePeriodType = $panelConfig['schedule']['timePeriod']['type']['value'];
		$schedulePeriodCount = $panelConfig['schedule']['timePeriod']['count'];

		if ($schedulePeriodType == 'DAYS_COUNT') {
			$max->modify("+$schedulePeriodCount days");
		} else if ($schedulePeriodType == 'MONTHS_COUNT') {
			$min->modify('- '. (date('d') - 1) . ' days + 1 month');
			$max->modify('- '. (date('d') - 1) . ' days + 1 month');
			$max->modify("+$schedulePeriodCount months");
		}
		return ProjectQuery::create()->filterByPlannedStart(array('min' => $min, 'max' => $max));
	}

	/**
	 * Devuelve la criteria para filtrar por fecha de finalización planificada a fin de armar una agenda de actividades.
	 */
	public static function getScheduleCriteriaForPlannedEnd() {
		$max = new DateTime('today');
		$min = new DateTime('today');
		$panelConfig = Common::getConfiguration('Panel');
		$schedulePeriodType = $panelConfig['schedule']['timePeriod']['type']['value'];
		$schedulePeriodCount = $panelConfig['schedule']['timePeriod']['count'];

		if ($schedulePeriodType == 'DAYS_COUNT') {
			$max->modify("+$schedulePeriodCount days");
		}
		else if ($schedulePeriodType == 'MONTHS_COUNT') {
			$min->modify('- '. (date('d') - 1) . ' days + 1 month');
			$max->modify('- '. (date('d') - 1) . ' days + 1 month');
			$max->modify("+$schedulePeriodCount months");
		}
		return ProjectQuery::create()->filterByPlannedEnd(array('min' => $min, 'max' => $max));
	}

	/**
	 * Devuelve la criteria para filtrar por fecha de finalización planificada a fin de armar un reporte de alertas de actividades.
	 */
	public static function getAlertCriteriaForPlannedEnd() {
		$max = new DateTime('today');
		$min = new DateTime('today');
		$panelConfig = Common::getConfiguration('Panel');
		$alertPeriodType = $panelConfig['alert']['timePeriod']['type']['value'];
		$alertPeriodCount = $panelConfig['alert']['timePeriod']['count'];
		if ($alertPeriodType == 'DAYS_COUNT') {
			$max->modify("+$alertPeriodCount days");
		}
		return ProjectQuery::create()->filterByFinished(false)
									 ->filterByPlannedEnd(array('min' => $min, 'max' => $max));
	}

	/*
	* Obtiene un array asociativo con la cantidad de projects por cada color.
	*
	* @return array $colorsCount.
	*/
	public static function getProjectsByStatusColorCountAssoc() {
		$tableroConfig = Common::getConfiguration('Tablero');
		$availableColors = $tableroConfig["colors"];
		$projects = ProjectPeer::getAll();
		$colorsCount = array_fill_keys($availableColors, 0);

		foreach($projects as $project) {
			$color = $project->statusColor();
			$colorsCount[$color] ++;
		}
		return $colorsCount;
	}

	/*
	* Obtiene un array asociativo con el total ponderado de projects por cada color.
	*
	* @return array $colorsCount.
	*/
	public static function getProjectsByStatusColorWeightedByPriorityAssoc() {
		$tableroConfig = Common::getConfiguration('Tablero');
		$availableColors = $tableroConfig["colors"];
		$projects = ProjectPeer::getAll();
		$colorsCount = array_fill_keys($availableColors, 0);

		foreach($projects as $project) {
			$color = $project->statusColor();
			$colorsCount[$color] += $project->getWeightBasedOnPriority();
		}
		return $colorsCount;
	}

	 /**
	* Obtiene la velocidad de todos los proyectos en conjunto.
	* @return int $speed velocidad de todos los proyectos en conjunto.
	*/
	public static function getSpeed() {
		$colorsWeight = ProjectPeer::getProjectsByStatusColorWeightedByPriorityAssoc();
		$colorsCount = ProjectPeer::getProjectsByStatusColorCountAssoc();

		$speed = (1 - (($colorsWeight['red']*2 + $colorsWeight['yellow']) / ($colorsCount['red'] + $colorsCount['yellow'] + $colorsCount['green'] + $colorsCount['blue'])))*100;

		if ($speed < 0)
			$speed = 0;

		return $speed;
	}

	 /**
	* Obtiene el entero de 10 en 10 de la clase de velocidad de todos los proyectos
	* @return int $class entero de 10 en 10 para la clase de la velocidad de todos los proyectos
	*/
	public static function getSpeedClass() {
		$speed = ProjectPeer::getSpeed();
		$class = round($speed / 10) * 10;
		return $class;
	}

} // ProjectPeer
