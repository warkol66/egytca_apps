<?php


/**
 * Skeleton subclass for representing a row from the 'projects_project' table.
 *
 * Project
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.projects.classes
 */
class Project extends BaseProject {

	/** the default item name for this class */
	const ITEM_NAME = 'Project';
		
	private $colors;
	private $colorsCount;
	private $toLog;
	private $minorChange;

	public $errorMessages = array();

	function __construct() {
		parent::__construct();
		
		global $system;
		$this->colors = $system["config"]["tablero"]["colors"];
	}
	
	/**
	 * Indica si un afiliado/dependencia es duenio de la instancia
	 * @param $affiliateId id de afiliado/dependencia
	 * @return true si lo es, false sino
	 */
	function isOwner($affiliateId) {
		$affiliate = $this->getObjective()->getAffiliate();
		if ($affiliate->getId() == $affiliateId)
			return true;
		
		return false;
	}
		
	/**
	 * Devuelve verdadero si el proyecto esta en desarrollo y su fecha de expiracion está vencida.
	 *
	 */
	function isDelayed() {
		return ($this->isOnWork() && ($this->getPlannedEnd <= date('Y-m-d')." 00:00:00"));
	}
	
	/**
	 * Devuelve verdadero si el proyecto esta seteado como finished o si tiene fecha real de finalizacion.
	 *
	 */
	function isEnded() {
		return ( ($this->getFinished() == 1) || (!is_null($this->getRealEnd())) );
	}
	
	/**
	 * Devuelve verdadero si el proyecto esta en desarrollo
	 *
	 */
	function isOnWork() {
		return ( ($this->getFinished() == 0) && (is_null($this->getRealEnd())) );
	}
	
	/**
	 * Devuelve el color acorde al estado del proyecto
	 *
	 */
	function statusColor() {
		
		// el uso de este metodo nos asegura recorrer las activities del proyecto una unica vez por consulta.
		if (!isset($this->colorsCount))
			$this->colorsCount = $this->getActivitiesByStatusColorCountAssoc();
		
		if ($this->isCancelled())
			return $this->colors["cancelled"];
		if ($this->isEnded())
			return $this->colors["finished"];
		if ($this->isUndefined())
			return $this->colors["notDefined"];
		if ($this->isLate())
			return $this->colors["late"];
		if ($this->isDelayed2())
			return $this->colors["delayed"];
		if (!$this->isStarted())
			return $this->colors["planned"];

		return $this->colors["onTime"];		
	}
	
	/**
	 * Devuelve verdadero o falso si el proyecto tiene un color determinado
	 * @param $color color del proyecto
	 */
	function isOfStatusColor($color) {
		return ($this->statusColor() === $color);
	}
	
	/**
	 * Devuelve verdadero si el proyecto tiene fecha real de inicio.
	 */
	function isStarted() {
		return !is_null( $this->getRealStart() );
	}
	
	/**
	 * Devuelve verdadero si el proyecto esta seteado como cancelado.
	 */		
	function isCancelled() {
		return $this->getCancelled();
	}
		
	/**
	 * Devuelve verdadero si el proyecto no tiene actividades asociadas no canceladas.
	 */	
	function isUndefined() {
		$totalActivities = $this->getAllActivitiesCount();
		
		if (!isset($this->colorsCount))
			$this->colorsCount = $this->getActivitiesByStatusColorCountAssoc();
		
		if ( $totalActivities === 0 )
			return true;
		
		if ($totalActivities === $this->colorsCount[$this->colors["cancelled"]])
			return true;
		
		return false;
	}
	
	/**
	 * Devuelve verdadero si la fecha actual es posterior a la fecha planificada de inicio y aún no se comenzó el proyecto.
	 * O bien alguna de las actividades del proyecto esta retrasada.
	 */
	function isDelayed2() {
		global $system;	
		
		if (!isset($this->colorsCount))
			$this->colorsCount = $this->getActivitiesByStatusColorCountAssoc();
		
		$currentTime = time();
		$plannedStart = $this->getPlannedStart('U');
		
		if (is_null($plannedStart)) 
			return false;
		
		// Si se usa tolerancia en dias
		if ($system["config"]["tablero"]["projects"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["delayed"]; 
			$currentTime = time() - ($days * 24 * 60 * 60);		
		}
		// TODO agregar otros tipos de tolerancias
		
		if ( $currentTime > $plannedStart && !$this->isStarted() || ($this->colorsCount[$this->colors["delayed"]] > 0))
			return true;
		return false;
	}	
	
	
	/*
	 * Devuelve verdadero si la fecha actual es posterior a la fecha planificada de finalizacion y aún no esta terminado el proyecto.
	 * O bien alguna de las actividades del proyecto esta fuera de plazo.
	 */
	function isLate() {
		global $system;
		
		if (!isset($this->colorsCount))
			$this->colorsCount = $this->getActivitiesByStatusColorCountAssoc();
			
		$currentTime = time();
		$plannedEnd = $this->getPlannedEnd('U');
		
		if (is_null($plannedEnd)) 
			return false;
		
		// Si se usa tolerancia en dias
		if ($system["config"]["tablero"]["projects"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["late"];
			$currentTime = time() - ($days * 24 * 60 * 60);			
		}
		// TODO agregar otros tipos de tolerancias
		
		if ( (($currentTime > $plannedEnd) && !$this->isEnded()) || ($this->colorsCount[$this->colors["late"]] > 0) )
			return true;
		return false;		
	}		
	

	/*
	* Obtiene los milestones en tiempo del proyecto.
	*
	* @return array Milestones
	*/
	function getMilestonesOnTime() {
		$cond = $this->getMilestonesOnTimeCriteria();
		$milestones = TableroMilestonePeer::doSelect($cond);		
		return $milestones;
	}
	
	/*
	* Obtiene el criteria utilizado para obtener los milestones en tiempo del proyecto.
	*
	* @return Criteria Criteria
	*/
	function getMilestonesOnTimeCriteria($noProject = false) {
		$cond = new Criteria();
		if (!$noProject)
			$cond->add(TableroMilestonePeer::PROJECTID,$this->getId());
		global $system;		
		//Si es de tipo dias
		if ($system["config"]["tablero"]["milestones"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["milestones"]["delayed"]; 
			$delayedTime = time() + ($days * 24 * 60 * 60);
			$delayedDate = date('Y-m-d', $delayedTime);
		}
		//Agregar los otros tipos
		$criterion = $cond->getNewCriterion(TableroMilestonePeer::EXPIRATIONDATE, $delayedDate." 00:00:00", Criteria::LESS_THAN);
		$criterion->addAnd($cond->getNewCriterion(TableroMilestonePeer::COMPLETED,0,Criteria::EQUAL));
		$criterion2 = $cond->getNewCriterion(TableroMilestonePeer::COMPLETED,1,Criteria::EQUAL);
		$criterion->addOr($criterion2);
		$cond->add($criterion);	
		return $cond;	
	}	
	
	/*
	* Obtiene la cantidad de milestones en tiempo del proyecto.
	*
	* @return int Cantidad de milestones
	*/	
	function getCountMilestonesOnTime() {
		$cond = $this->getMilestonesOnTimeCriteria();
		$milestones = TableroMilestonePeer::doCount($cond);		
		return $milestones;
	}	
	
	/*
	* Obtiene el criteria utilizado para obtener los milestones con retrazo del proyecto.
	*
	* @return Criteria Criteria
	*/
	function getMilestonesDelayedCriteria($noProject = false) {
		$cond = new Criteria();
		if (!$noProject)
			$cond->add(TableroMilestonePeer::PROJECTID,$this->getId());
		global $system;		
		//Si es de tipo dias
		if ($system["config"]["tablero"]["milestones"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["milestones"]["delayed"]; 
			$delayedTime = time() + ($days * 24 * 60 * 60);
			$delayedDate = date('Y-m-d', $delayedTime);
			$days = $system["config"]["tablero"]["milestones"]["late"]; 
			$lateTime = time() + ($days * 24 * 60 * 60);
			$lateDate = date('Y-m-d', $lateTime);			
		}
		//Agregar los otros tipos
		$criterion = $cond->getNewCriterion(TableroMilestonePeer::EXPIRATIONDATE, $lateDate." 00:00:00", Criteria::LESS_THAN);
		$criterion->addAnd($cond->getNewCriterion(TableroMilestonePeer::EXPIRATIONDATE, $delayedDate." 00:00:00", Criteria::GREATER_EQUAL));		
		$criterion->addAnd($cond->getNewCriterion(TableroMilestonePeer::COMPLETED,0,Criteria::EQUAL));
		$cond->add($criterion);	
		return $cond;	
	}		
	
	/*
	* Obtiene los milestones retrasados del proyecto.
	*
	* @return array Milestones
	*/
	function getMilestonesDelayed() {
		$cond = $this->getMilestonesDelayedCriteria();
		$milestones = TableroMilestonePeer::doSelect($cond);	
		return $milestones;
	}

	/*
	* Obtiene la cantidad de milestones retrazados del proyecto.
	*
	* @return int Cantidad de milestones
	*/	
	function getCountMilestonesDelayed() {
		$cond = $this->getMilestonesDelayedCriteria();
		$milestones = TableroMilestonePeer::doCount($cond);		
		return $milestones;
	}		

	/*
	* Obtiene el criteria utilizado para obtener los milestones con demora del proyecto.
	*
	* @return Criteria Criteria
	*/
	function getMilestonesLateCriteria($noProject = false) {
		$cond = new Criteria();
		if (!$noProject)		
			$cond->add(TableroMilestonePeer::PROJECTID,$this->getId());
		global $system;		
		//Si es de tipo dias
		if ($system["config"]["tablero"]["milestones"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["milestones"]["late"];
			$lateTime = time() + ($days * 24 * 60 * 60);
			$lateDate = date('Y-m-d', $lateTime);			
		}
		//Agregar los otros tipos
		$criterion = $cond->getNewCriterion(TableroMilestonePeer::EXPIRATIONDATE, $lateDate." 00:00:00", Criteria::GREATER_EQUAL);
		$criterion->addAnd($cond->getNewCriterion(TableroMilestonePeer::COMPLETED,0,Criteria::EQUAL));
		$cond->add($criterion);	
		return $cond;	
	}		

	/*
	* Obtiene los milestones demorados del proyecto.
	*
	* @return array Milestones
	*/
	function getMilestonesLate() {
		$cond = $this->getMilestonesLateCriteria();
		$milestones = TableroMilestonePeer::doSelect($cond);	
		return $milestones;
	}

	/*
	* Obtiene la cantidad de milestones demorados del proyecto.
	*
	* @return int Cantidad de milestones
	*/	
	function getCountMilestonesLate() {
		$cond = $this->getMilestonesLateCriteria();
		$milestones = TableroMilestonePeer::doCount($cond);		
		return $milestones;
	}

	/**
	 * Da formato de YYYY-MM-DD a un datetime
	 *
	 *	@return string	 
	 */	
	private function formatDate($date) {
		preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/", $date, $regs);
		return "$regs[1]-$regs[2]-$regs[3]";
	}

	/**
	 * Devuelve el Date en formato YYYY-MM-DD
	 *
	 *	@return string
	 */		
	public function getDateFormatted() {
		$date = $this->getDate();
		if (empty($date))
			//si no hay fecha se devuelve la fecha de hoy
			return date('Y-m-d');
		return $this->formatDate($date);
	}

	/**
	 * Devuelve el Goal Expiration Date en formato YYYY-MM-DD
	 *
	 *	@return string
	 */		
	public function getGoalExpirationDateFormatted() {

		$date = $this->getGoalExpirationDate();
		if (empty($date) || ($date == "1999-11-30 00:00:00")) {
			//si no hay fecha de expiracion, se devuelve la fecha de maniana
			list($year,$month,$day) = explode("-",$this->getDateFormatted());
			return $year . "-" . $month . "-" . ($day+1);		
		}		
		return $this->formatDate($date);
	}	

	/**
	 * Devuelve el nombre del Objetivo
	 *
	 *	@return string
	 */
	public function getObjectiveName() {
		$objectiveId = $this->getObjectiveId();
		$objective = ObjectiveQuery::create()->filterById($objectiveId)->findOneOrCreate();
		return $objective->getName();
	}	

	/**
	 * Devuelve la información de navegación para listados
	 *
	 *	@return array información de navegación hacia arriba
	 */
	public function getParentLinkPath() {

		$parentLinkInfo = array();
		$objectiveId = $this->getObjectiveId();

		$objective = ObjectiveQuery::create()->findOneById($objectiveId);

		$parentLinkInfo['parentObject'] = $objective;
		$parentLinkInfo['parentLink'] = "projectsList&filters[fromObjectives]=true&filters[objective]=";
		$parentLinkInfo['parentId'] = $objectiveId;
		
		return $parentLinkInfo;
	}

	/**
	 * Devuelve el nombre de la localidad
	 *
	 *	@return string
	 */
	public function getRegion(){
		$regionId = $this->getRegionId();
		$region = RegionPeer::get($regionId);
		return $region->getName();
	}	

	/**
	 * Devuelve el nombre de la Depedencia
	 *
	 *	@return string
	 */
	public function getDependency(){
		$objectiveId = $this->getObjectiveId();
		$objective = ObjectivePeer::get($objectiveId);
		if (is_object($objective)){
			$dependencyId = $objective->getAffiliateId();
			$affiliate = AffiliatePeer::get($dependencyId);
			return $affiliate->getName();
		}
		else
			return;
	}	

	/**
	* Obtiene el icono para el mapa.
	*
	* @return string nombre del icono
	*
	*/
	function getImageIcon(){
		$objectiveId = $this->getObjectiveId();
		$criteria = new Criteria();
		$criteria->add(ObjectivePeer::ID, $objectiveId);
		$criteria->addJoin(ObjectivePeer::ID, ProjectPeer::OBJECTIVEID);
//		$criteria->addJoin(ObjectivePeer::AFFILIATEID, AffiliateInfoPeer::AFFILIATEID);
//		$affiliateInfo = AffiliateInfoPeer::doSelectOne($criteria);
		
		if (!empty($affiliateInfo))
			$icon = $affiliateInfo->getImageIcon();
		return $icon;

	}

	/**
	* Informa si el proyecto tiene erorres de valiación
	*
	*/
	public function hasErrors() {
		return (count($this->getValidationFailures()) > 0);
	}

	/**
	* Guardado del proyecto
	* @param $con conexión a la base de datos
	*/
	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) { 
				parent::save($con);
				return true;
			} else {
				return false;
			}
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	* Define que la modificación a un proyecto es un cambio menor, no generando ProjectLog
	* @param $expr boolean que indica si es o no cambio menor
	*/
	public function setMinorChange($expr = true) {
		$this->minorChange = $expr;
	}
	
	/**
	* Define cuando debe ser generado un registro de ProjectLog
	*
	*/
	public function hasToLog() {
		return ((ConfigModule::get("projects","useLogs")) && !$this->isNew() &&
			 (((ConfigModule::get("projects","useMinorChanges")) && !$this->minorChange ) ||
			 (!ConfigModule::get("projects","useMinorChanges"))));
	}
	
	/**
	* Setea cuando debe ser generado un registro de ProjectLog
	*
	*/
	public function setToLog($objectLog) {
		$this->toLog = $objectLog;
	}

	/**
	* Modificaciones a datos posteriores a actualizar un project
	* @param $con conexión a la base de datos
	*/
	public function postUpdate($con = null) {
		if ($this->hasToLog() && $this->toLog != null) {
			$objectLog = $this->toLog;
			$objectLog->setId(NULL);
			$objectLog->setProjectId($this->getId());
			$objectLog->setUpdated(time());
			try {
				$objectLog->save();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
		}		
	}
	
	/**
	* Modificaciones a datos previos a actualizar un project
	* @param $con conexión a la base de datos
	*/
	public function preUpdate($con =null) {		
		$this->setUpdated(time());
		$this->setLastModification(time());
		if (method_exists($this,"getChanges")) {
			$changes = $this->getChanges() + 1;
			$this->setChanges($changes);
		}
		return true;
	}
	
	/**
	* Modificaciones a datos previos a guardar un project
	* @param $con conexión a la base de datos
	*/
	public function preSave($con =null) {		
		if (method_exists($this,"setUserId"))
			$this->setUserId($_SESSION["loginUser"]->getId());
		return true;
	}

	/*
	* Obtiene los activities asignadas al proyecto con un determinado status color.
	*
	* @return array Activities
	*/
	public function getActivitiesByStatusColor($color) {
		$activities = $this->getAllActivities();
		$filteredActivities = array();
		foreach ($activities as $activity) {
			if ($activity->isOfStatusColor($color)) {
				$filteredActivities[] = $activity;
			}
		}
		return $filteredActivities;
	}
	
	/*
	* Obtiene la cantidad de activities asignadas al proyecto con un determinado status color.
	*
	* @return int $count
	*/
	public function getActivitiesByStatusColorCount($color) {
		return getActivitiesByStatusColor($color)->count();
	}
	
	/*
	* Obtiene un array asociativo con la cantidad de activities asignadas al proyecto por cada color.
	*
	* @return array $colorsCount.
	*/
	public function getActivitiesByStatusColorCountAssoc() {
		$activities = $this->getAllActivities();
		$colorsCount = array();
		foreach($activities as $activitiy) {
			$color = $activitiy->statusColor();
			if (!isset($colorsCount[$color]))
				$colorsCount[$color] = 1;
			else
				$colorsCount[$color] ++; 
		}
		// me aseguro de setear el resto de los colores disponibles que no hayan sido inicializados
		foreach($this->colors as $color) {
			if (!isset($colorsCount[$color]))
				$colorsCount[$color] = 0;
		}
		return $colorsCount;
	}
	
	/*
	* Obtiene todas las activities asociadas a la instancia.
	*
	* @return PropelCollection $activities
	*/
	public function getAllActivities() {
		return ProjectActivityQuery::create()->findByProjectId($this->getId());
	}
	
	/*
	* Obtiene la cantidad total de activities asociadas a la instancia.
	*
	* @return int $count
	*/
	public function getAllActivitiesCount() {
		return ProjectActivityQuery::create()->filterByProjectId($this->getId())->count();
	}
	
	/**
	 * Devuelve el peso del proyecto basado en la prioridad. Devuelve 0 si tiene una prioridad invalida.
	 *
	 */
	public function getWeightBasedOnPriority() {
		$priority = $this->getPriority();
		if ($priority == ProjectPeer::CRITICAL)
			return 6;
		if ($priority == ProjectPeer::HIGH)
			return 4;
		if ($priority == ProjectPeer::MEDIUM_HIGH)
			return 3;
		if ($priority == ProjectPeer::MEDIUM)
			return 2;
		return 1;
	}
	
	/**
	 * Devuelve los logs para el proyecto ordenados en forma decreciente por fecha de creación.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array Logs para el proyecto ordenados en forma decreciente por fecha de creación.
	 */
	public function getLogsOrderedByUpdated($orderType = 'asc') {
		$projectLogPeer = new ProjectLogPeer();
		return $projectLogPeer->getAllByProjectIdOrderedByUpdated($this->getId(), $orderType);
	}
	
	/**
	 * Devuelve los logs para el proyecto ordenados en forma decreciente por fecha de creación y paginados.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array Logs para el proyecto ordenados en forma decreciente por fecha de creación.
	 */
	public function getLogsOrderedByUpdatedPaginated($orderType = 'asc', $page=1, $maxPerPage=5) {
		$projectLogPeer = new ProjectLogPeer();
		return $projectLogPeer->getAllByProjectIdOrderedByUpdatedPaginated($this->getId(), $orderType, $page, $maxPerPage);
	}
	
	public function getLogCount() {
		return ProjectLogQuery::create()->filterByProjectId($this->getId())->count();
	}
	
	public function hasWriteAccess($user) {
		
		// Si está deshabilitado el chequeo en el config devuelvo true.
		if (!ConfigModule::get("projects","verifyGroupWriteAccess"))
			return true;
		
		// Si se trata de administrador o supervisor, tiene acceso.
		if ($user->isAdmin() || $user->isSupervisor())
			return true;
		
		$responsibleCode = $this->getResponsibleCode();
		
		// Caso contrario, hay que ver si el usuario pertenece al grupo correcto.
		$result = GroupQuery::create()->join('Group.UserGroup')->join('Group.Position')
										 ->where('UserGroup.Userid = ?', $user->getId())
										 ->where('Position.Code = ?', $responsibleCode)->count();
		return $result > 0;
			
	}
	
	/**
	 * Devuelve los contratistas establecidos como preClasificados para la licitación.
	 */
	public function getPreClasifiedContractors() {
		$contractors = ContractorQuery::create()
												->orderByName()
												->useProjectContractorQuery()
													->filterByProject($this)
													->filterByType(2)
												->endUse()
											->find();
		if(count($contractors) == 0)
			$contractors = NULL;
		return $contractors;
	}
	
	/**
	 * Devuelve los contratistas establecidos como Clasificados para la licitación.
	 */
	public function getClasifiedContractors() {
		$contractors = ContractorQuery::create()
												->orderByName()
												->useProjectContractorQuery()
													->filterByProject($this)
													->filterByType(1)
												->endUse()
											->find();
		return $contractors;
	}

	/**
	 * Associate a Contractor object to this object
	 * through the projects_contractor cross reference table.
	 *
	 * @param      Contractor $contractor The ProjectContractor object to relate
	 * @param	   Tipo de relacion con el contratista.
	 * @return     void
	 */
	public function addContractor($contractor, $type) {
		if ($this->collContractors === null) {
			$this->initContractors();
		}
		
		// nos fijamos si ya lo tiene con el tipo correcto
		if (!$this->hasContractor($contractor, $type)) {
			// aún podría pasar que lo tenga con otro tipo. En ese caso hay que reinsertarlo.
			$this->removeContractor($contractor->getId());
			
			if (!$this->collContractors->contains($contractor)) { // only add it if the **same** object is not already associated
				$projectContractor = new ProjectContractor();
				$projectContractor->setContractor($contractor);
				$projectContractor->setType($type);
				$this->addProjectContractor($projectContractor);
				$this->collContractors[]= $contractor;
			}
		}
	}
	
	
	/**
	 * Determina la existencia de una relacion con un determindo contratista.
	 * @param $contractor Object
	 * @param $type Object[optional]
	 */
	public function hasContractor($contractor, $type = null) {
		$projectContractorQuery = ProjectContractorQuery::create()->filterByProjectId($this->getId())
															 ->filterByContractorId($contractor->getId());
		if ($type !== null)
			$projectContractorQuery->filterByType($type);
		
		return ($projectContractorQuery->count() > 0);															 		
	}
	
	/**
	 * Elimina las relaciones con los contratistas cuyas id son pasadas por parámetro.
	 * @param $contractorIds Object
	 * @param $type Object[optional]
	 */
	
	public function removeContractor($contractorIds, $type = null) {
		$projectContractorQuery = ProjectContractorQuery::create()->filterByProjectId($this->getId())
															 	  ->filterByContractorId($contractorIds);
		if ($type !== null)
			$projectContractorQuery->filterByType($type);
		
		$projectContractorQuery->delete();															 		
	}
	
	/**
	 * Elimina de la lista de contratistas preclasificados a aquellos cuyas id son pasadas por parámetro.
	 * @param $contractorIds Object
	 */
	
	public function removeContractorFromPreClasifiedList($contractorIds) {
		$projectContractorQuery = ProjectContractorQuery::create()->filterByProjectId($this->getId())
															 	  ->filterByContractorId($contractorIds)
																  ->filterByType(2);
		
		$projectContractorQuery->update(array('Type' => 1));															 		
	}

	/**
	 * En el project log dice quien realizo el cambio. Se crea aca por razones de compatibilidad.
	 */
	public function changedBy() {
		return;															 		
	}

	/*
	* Obtiene la primera fecha de todas las activities asociadas a la instancia.
	*
	* @return date $date
	*/
	public function getAllActivitiesPlannedStart() {
		return ProjectActivityQuery::create()->select('Plannedstart')->filterByProject($this)->filterByPlannedstart(array('min' => 0))->orderByPlannedstart()->findOne();
	}

	/*
	* Obtiene la primera fecha de todas las activities asociadas a la instancia.
	*
	* @return date $date
	*/
	public function getAllActivitiesPlannedend() {
		return ProjectActivityQuery::create()->select('Plannedend')->filterByProject($this)->orderByPlannedend(Criteria::DESC)->findOne();
	}

	/*
	* Obtiene la primera fecha de todas las activities asociadas a la instancia.
	*
	* @return date $date
	*/
	public function getAllActivitiesRealStart() {
		return ProjectActivityQuery::create()->select('Realstart')->filterByProject($this)->filterByRealstart(array('min' => 0))->orderByRealstart()->findOne();
	}

	/*
	* Obtiene la primera fecha de todas las activities asociadas a la instancia.
	*
	* @return date $date
	*/
	public function getAllActivitiesRealEnd() {
		return ProjectActivityQuery::create()->select('Realend')->filterByProject($this)->orderByRealend(Criteria::DESC)->findOne();
	}

} // Project
