<?php


/**
 * Skeleton subclass for performing query and update operations on the 'objectives_objective' table.
 *
 * Objective
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.objectives.classes
 */
class ObjectivePeer extends BaseObjectivePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Objectives';

	private  $dependencyId;
	private  $objectives = false;
	private  $projects = false;
	private  $projectsEnded = false;
	private  $projectsDelayed = false;
	private  $projectsWorking = false;
	private  $indicators = false;
	private  $milestones = false;
	//opciones de filtrado
	private  $dateFrom;
	private  $dateTo;
	private  $searchString;
	private  $strategicObjective;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"strategicObjective"=>"setStrategicObjective",
					"searchString"=>"setSearchString",
					"dependency"=>"setSearchDependency",
					"commune"=>"setSearchCommune",
					"region"=>"setSearchRegion",
					"dateFrom"=>"setDateFrom",
					"dateTo"=>"setDateTo"
				);

	//mapea un status a la llamada del metodo que indica que estado tiene
	 private $projectStatus = array(
					'delayed'=>'isDelayed',
					'ended'=>'isEnded',
					'working'=>'isOnWork',
					'OnTime'=>'isOnTime',
					'Delayed'=>'isDelayed2',
					'Late'=>'isLate'
					);

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	/**
	 * Especifica el Id del afiliado.
	 * @param int Id del afiliado.
	 */
	public function setAffiliateId($affiliateId) {
		$this->affiliateId = $affiliateId;
	}

	/**
	 * Especifica un objetivo estrat�gico
	 * @param strategicObjective id del objetivo estrat�gico.
	 */
	public function setStrategicObjective($strategicObjective) {
		$this->strategicObjective = $strategicObjective;
	}

	/**
	* Crea un objective nuevo.
	*
	* @param string $name name del objective
	* @param int $affiliateId affiliateId del objective
	* @param int $description description del objective
	* @param string $date date del objective
	* @param string $expirationDate expirationDate del objective
	* @param int $achieved achieved del objective
	* @param string $notes notes del objective
	* @return boolean true si se creo el objective correctamente, false sino
	*/
	function create($params) {
		$object = new Objective();
		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($object,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$object->$setMethod($value);
				else
					$object->$setMethod(null);
			}
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
	* Crea un objective nuevo.
	*
	* @param string $name name del objective
	* @param int $affiliateId affiliateId del objective
	* @param int $description description del objective
	* @param string $date date del objective
	* @param string $expirationDate expirationDate del objective
	* @param int $achieved achieved del objective
	* @param string $notes notes del objective
	* @return boolean true si se creo el objective correctamente, false sino
	*/
	function createMigration($objectiveParams,$con = null){
		$objectiveObj = new Objective();
		foreach ($objectiveParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($objectiveObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$objectiveObj->$setMethod($value);
				else
					$objectiveObj->$setMethod(null);
			}
		}
		try {
			$objectiveObj->save($con);
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
	* @param array $params con los datos del proyecto
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params) {
		$object = ObjectivePeer::retrieveByPK($id);
		if ((ConfigModule::get("objectives","useLogs")) &&
			 (((ConfigModule::get("objectives","useMinorChanges")) && (empty($params["minorChange"]))) ||
			 (!ConfigModule::get("objectives","useMinorChanges")))) {
			$objectLog = new ObjectiveLog();
			$objectLog = Common::morphObjectValues($object,$objectLog);
			$objectLog->setId(NULL);
			$objectLog->setObjectiveId($id);
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
	* Elimina un objective a partir de los valores de la clave.
	*
	* @param int $id id del objective
	*	@return boolean true si se elimino correctamente el objective, false sino
	*/
	function delete($id) {
		$objectiveObj = ObjectivePeer::retrieveByPK($id);
		$objectiveObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un objective.
	*
	* @param int $id id del objective
	* @return array Informacion del objective
	*/
	function get($id) {
		$objectiveObj = ObjectivePeer::retrieveByPK($id);
		return $objectiveObj;
	}

	/**
	* Obtiene la informacion de un objective a partir de su nombre.
	*
	* @param string $name Nombre del objective
	* @return array Informacion del objective
	*/
	function getByName($name,$con = null) {
		$cond = new Criteria();
		$cond->add(ObjectivePeer::NAME,$name);
		$objective = ObjectivePeer::doSelectOne($cond,$con);
		return $objective;
	 }

	/**
	* Obtiene todos los objectives.
	*
	*	@return array Informacion sobre todos los objectives
	*/
	function getAll($affiliateId = null) {
		$cond = new Criteria();
		if ($affiliateId != null) {
			$cond->add(ObjectivePeer::AFFILIATEID,$affiliateId);
		}
		$alls = ObjectivePeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene todos los objectives paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @param int $idAffiliate Id de dependencencia, opcional para limitar la busqueda
	* @return array Informacion sobre todos los objectives
	*/
	function getAllPaginated($page=1,$perPage=-1,$idAffiliate = null) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		if ($idAffiliate != null)
			$cond->add(ObjectivePeer::AFFILIATEID,$idAffiliate);
		$pager = new PropelPager($cond,"ObjectivePeer", "doSelect",$page,$perPage);
		return $pager;
	 }


	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);

		if ($this->searchString)
			$criteria->add(ObjectivePeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		if ($this->affiliateId)
			$criteria->add(ObjectivePeer::AFFILIATEID,$this->affiliateId);

		if ($this->strategicObjective)
			$criteria->add(ObjectivePeer::STRATEGICOBJECTIVEID,$this->strategicObjective);
			
		if (ConfigModule::get('users', 'useFilterByUserGroup')) {
			$user = Common::getAdminLogged();
			if (!empty($user) && !$user->isAdmin() && !$user->isSupervisor()) {
				$userGroupsIds = Common::getAdminGroupsIds();
				$criteriaOnGroups = $criteria->getNewCriterion(PositionPeer::USERGROUPID, $userGroupsIds, Criteria::IN);
				$criteria->addAnd($criteriaOnGroups);
				$criteria->addJoin(ObjectivePeer::RESPONSIBLECODE, PositionPeer::CODE, Criteria::INNER_JOIN);	
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
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"ObjectivePeer", "doSelect",$page,$perPage);
		return $pager;
	 }
	 
	/**
	* Obtiene todas las activities con las opciones de filtro asignadas al peer.
	*
	*/
	function getAllFiltered() {
		$cond = $this->getCriteria();
		return ObjectivePeer::doSelect($cond);
	}

 /**
	* Obtiene todos los regions posibles a elegir
	*
	* @param int $id Id del objetivo
	* @return array regiones disponibles para ser agregadas al objetivo
	*/
	function getRegionCandidates($id = 0)
	{
		if ($id > 0) {
			$criteria = new Criteria();
			$not_in_query = RegionPeer::ID . ' NOT IN (SELECT ' . ObjectiveRegionPeer::REGIONID . '
											FROM ' . ObjectiveRegionPeer::TABLE_NAME . '
											WHERE ' . ObjectiveRegionPeer::OBJECTIVEID . ' = ' . $id . ')';
			$criteria->add(RegionPeer::ID, $not_in_query, Criteria::CUSTOM);
			$regions = RegionPeer::doSelect($criteria);
		}
		else
			$regions = RegionQuery::create()->find();

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
		return ObjectiveQuery::create()->filterByDate(array('min' => time(), 'max' => $max ));
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
		} else if ($schedulePeriodType == 'MONTHS_COUNT') {
			$min->modify('- '. (date('d') - 1) . ' days + 1 month');
			$max->modify('- '. (date('d') - 1) . ' days + 1 month');
			$max->modify("+$schedulePeriodCount months");
		}
		return ObjectiveQuery::create()->filterByExpirationDate(array('min' => time(), 'max' => $max ));
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
		return ObjectiveQuery::create()->filterByAchieved(false)
									   ->filterByExpirationDate(array('min' => time(), 'max' => $max ));
	}

} // ObjectivePeer
