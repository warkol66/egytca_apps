<?php


/**
 * Skeleton subclass for representing a row from the 'objectives_objective' table.
 *
 * Objective
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.objectives.classes
 */
class Objective extends BaseObjective {

	/** the default item name for this class */
	const ITEM_NAME = 'Objective';
	
	private $toLog;
	private $minorChange;
	

	//mapea un status a la llamada del metodo que indica que estado tiene
	 private $projectStatus = array(
	 				'delayed'=>'isDelayed',
	 				'ended'=>'isEnded',
	 				'working'=>'isOnWork',
					'OnTime'=>'isOnTime',
					'Delayed'=>'isDelayed2',
					'Late'=>'isLate'
	 				);

	private $colors;
	private $colorsCount;
	
	function __construct() {
		parent::__construct();
		global $system;
		$this->colors = $system["config"]["tablero"]["colors"];
	}
	
	function statusColor() {
		global $system;	
		$colors = $system["config"]["tablero"]["colors"];
		if ($this->isOnTime())
			return $colors["onTime"];
		if ($this->isDelayed2())
			return $colors["delayed"];			
		if ($this->isLate())
			return $colors["late"];			
	}	 
	 
	function isOnTime() {
		return ($this->getCountProjectsDelayed() == 0 && $this->getCountProjectsLate() == 0);
	}

	function isDelayed2() {
		return ($this->getCountProjectsDelayed() != 0 && $this->getCountProjectsLate() == 0);
	}	

	function isLate() {
		return ($this->getCountProjectsLate() != 0);
	}		 
	 

	/**
	 * Indica si un afiliado/dependencia es duenio de la instancia
	 * @param $affiliateId id de afiliado/dependencia
	 * @return true si lo es, false sino
	 */	 
	function isOwner($affiliateId) {
		$affiliate = $this->getAffiliate();
		if ($affiliate->getId() == $affiliateId)
			return true;
		
		return false;
	}
	
	private function countNumberProjects($status) {
	
		//busco la llamada a hacer
		$method = $this->projectStatus[$status];

		$count = 0;
		
		foreach ($this->getProjects() as $project) {
			if ($project->$method()) {
				$count++;
			}
		}
		
		return $count;
	
	}
	
	private function getProjectsByStatus($status) {

		//busco la llamada a hacer
		$method = $this->projectStatus[$status];

		$projects = array(); //proyectos a devolver

		foreach ($this->getProjects() as $project) {
			if ($project->$method()) {
				$projects[] = $project;
			}
		}

		return $projects;

	}	
	
	/**
   	 * Indica la cantidad de proyectos retrasados del objetivo
   	 *
   	 * @return int cantidad de proyectos que cumplen la condicion
   	 */
	public function getNumberOfDelayedProjects() {
		return $this->countNumberProjects('delayed');
	}

	/**
   	 * Indica la cantidad de proyectos Finalizados del objetivo
   	 *
   	 * @return int cantidad de proyectos que cumplen la condicion
   	 */
	public function getNumberOfEndedProjects() {
		return $this->countNumberProjects('ended');
	}

	/**
   	 * Indica la cantidad de proyectos en ejecucion del objetivo
   	 *
   	 * @return int cantidad de proyectos que cumplen la condicion
   	 */	
	public function getNumberOfWorkingProjects() {
		return $this->countNumberProjects('working');
	}

	/**
	* Obtiene la cantidad de proyectos en tiempo del objetivo. Los proyectos en tiempo son los que poseen a todos sus hitos en tiempo.
	*
	* @return int Cantidad de proyectos en tiempo.
	*/
	function getCountProjectsOnTime() {
		global $system;		
		//Si es de tipo dias
		if ($system["config"]["tablero"]["milestones"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["milestones"]["delayed"]; 
			$delayedTime = time() + ($days * 24 * 60 * 60);
			$delayedDate = date('Y-m-d', $delayedTime)." 00:00:00";
		}
		//Agregar los otros tipos
		$sql = "SELECT count(p.ID) as counter FROM ".ProjectPeer::TABLE_NAME." p WHERE p.OBJECTIVEID = '".$this->getId()."' AND 
				NOT EXISTS (SELECT * FROM ".ProjectActivityPeer::TABLE_NAME." m WHERE m.EXPIRATIONDATE>='".$delayedDate."' AND m.COMPLETED=0 AND m.PROJECTID = p.ID)";
		
		$con = Propel::getConnection(ObjectivePeer::DATABASE_NAME);
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch(); 
		if (!empty($row))
		   return $row["counter"];
		else
			return 0;
	}
	
	/**
	* Obtiene la cantidad de proyectos retrazados del objetivo. Los proyectos retrazados son los que poseen algunos de sus hitos retrazados y ninguno demorado.
	*
	* @return int Cantidad de proyectos retrazados.
	*/
	function getCountProjectsDelayed() {
		global $system;		
		//Si es de tipo dias
		if ($system["config"]["tablero"]["milestones"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["milestones"]["delayed"]; 
			$delayedTime = time() + ($days * 24 * 60 * 60);
			$delayedDate = date('Y-m-d', $delayedTime)." 00:00:00";
			$days = $system["config"]["tablero"]["milestones"]["late"]; 
			$lateTime = time() + ($days * 24 * 60 * 60);
			$lateDate = date('Y-m-d', $lateTime)." 00:00:00";			
		}
		//Agregar los otros tipos
		$sql = "SELECT count(p.ID) as counter FROM ".ProjectPeer::TABLE_NAME." p WHERE p.OBJECTIVEID = '".$this->getId()."' AND 
				NOT EXISTS (SELECT * FROM ".ProjectActivityPeer::TABLE_NAME." m WHERE m.EXPIRATIONDATE>='".$lateDate."' AND m.COMPLETED=0 AND m.PROJECTID = p.ID) AND
				EXISTS (SELECT * FROM ".ProjectActivityPeer::TABLE_NAME." m WHERE m.EXPIRATIONDATE<'".$lateDate."' AND m.EXPIRATIONDATE>='".$delayedDate."' AND m.COMPLETED=0 AND m.PROJECTID = p.ID)";

		$con = Propel::getConnection(ObjectivePeer::DATABASE_NAME);
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch(); 
		if (!empty($row))
		   return $row["counter"];
		else
			return 0;
	}	
	
	/**
	* Obtiene la cantidad de proyectos demorados del objetivo. Los proyectos demorados son los que poseen algunos de sus hitos demorados.
	*
	* @return int Cantidad de proyectos demorados.
	*/
	function getCountProjectsLate() {
		global $system;		
		//Si es de tipo dias
		if ($system["config"]["tablero"]["milestones"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["milestones"]["late"];
			$lateTime = time() + ($days * 24 * 60 * 60);
			$lateDate = date('Y-m-d', $lateTime)." 00:00:00";			
		}
		//Agregar los otros tipos
		$sql = "SELECT count(p.ID) as counter FROM ".ProjectPeer::TABLE_NAME." p WHERE p.OBJECTIVEID = '".$this->getId()."' AND 
				EXISTS (SELECT * from ".ProjectActivityPeer::TABLE_NAME." m WHERE m.EXPIRATIONDATE>='".$lateDate."' AND m.COMPLETED=0 AND m.PROJECTID = p.ID)";

		$con = Propel::getConnection(ObjectivePeer::DATABASE_NAME);
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch(); 
		if (!empty($row))
		   return $row["counter"];
		else
			return 0;	
	}	
	
	/**
	* Obtiene los proyectos en tiempo del objetivo. Los proyectos en tiempo son los que poseen a todos sus hitos en tiempo.
	*
	* @return array Proyectos en tiempo.
	*/
	function getProjectsOnTime() {
		return $this->getProjectsByStatus('OnTime');
	}		
	
	/**
	* Obtiene los proyectos retrazados del objetivo. Los proyectos retrazados son los que poseen algunos de sus hitos retrazados y ninguno demorado.
	*
	* @return array Proyectos retrazados.
	*/
	function getProjectsDelayed() {
		return $this->getProjectsByStatus('Delayed');
	}	
	
	/**
	* Obtiene los proyectos demorados del objetivo. Los proyectos demorados son los que poseen algunos de sus hitos demorados.
	*
	* @return array Proyectos demorados.
	*/
	function getProjectsLate() {
		return $this->getProjectsByStatus('Late');
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
	 * Devuelve el date en formato YYYY-MM-DD
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
	 * Devuelve el Expiration Date en formato YYYY-MM-DD
	 *
	 *	@return string
	 */	
	public function getExpirationDateFormatted() {
		
		$date = $this->getExpirationDate();
		if (empty($date) || ($date == "1999-11-30 00:00:00")) {
			
			//si no hay fecha de expiracion, se devuelve la fecha de maniana
			list($year,$month,$day) = explode("-",$this->getDateFormatted());
			return $year . "-" . $month . "-" . ($day+1);		
		}		
		return $this->formatDate($date);
	}		

	/**
	 * Devuelve el nombre del Objetivo Estrat�gico
	 *
	 *	@return string
	 */
	public function getStrategicObjective() {
		$strategicObjectiveId = $this->getStrategicObjectiveId();
		if ($strategicObjectiveId > 0) {
			$strategicObjective = StrategicObjectiveQuery::create()->findOneById($strategicObjectiveId);
			if (is_null($strategicObjective))
				$strategicObjective = new StrategicObjective();
		}
		else
			$strategicObjective = new StrategicObjective();
		return $strategicObjective->getName();
	}
	/**
	 * Devuelve el nombre del Eje de Gesti�n
	 *
	 *	@return string
	 */
	public function getPolicyGuideline() {
		$policyGuidelineId = $this->getPolicyGuidelineId();
		if ($policyGuidelineId > 0)
			$policyGuideline = PolicyGuidelineQuery::create()->findOneById($policyGuidelineId);
		else {
			$strategicObjectiveId = $this->getStrategicObjectiveId();
			if ($strategicObjectiveId > 0){
				$strategicObjective = StrategicObjectiveQuery::create()->findOneById($strategicObjectiveId);
				if (!is_null($strategicObjective)){
					$policyGuidelineId = $strategicObjective->getPolicyGuidelineId();
					$policyGuideline = PolicyGuidelineQuery::create()->findOneById($policyGuidelineId);
					if ($policyGuidelineId > 0)
						$policyGuideline = PolicyGuidelineQuery::create()->findOneById($policyGuidelineId);

					if (empty($policyGuideline))
						$policyGuideline = new PolicyGuideline();

				}
				else
					$policyGuideline = new PolicyGuideline();
			}
			else
				$policyGuideline = new PolicyGuideline();
		}
		return $policyGuideline->getName();
	}
	
	/**
	 * Devuelve la información de navegación para listados
	 *
	 *	@return array información de navegación hacia arriba
	 */
	public function getParentLinkPath() {
		$parentLinkInfo = array();

		$strategicObjectiveId = $this->getStrategicObjectiveId();
		$strategicObjective = StrategicObjectiveQuery::create()->findOneById($strategicObjectiveId);

		if(!empty($strategicObjective)){
			$parentLinkInfo['parentLink'] = "objectivesList&filters[fromStrategicObjectives]=true&filters[strategicObjective]=";
			$parentLinkInfo['parentObject'] = $strategicObjective;
			$parentLinkInfo['parentId'] = $strategicObjectiveId;
			return $parentLinkInfo;
		}
		else
			return;
	}

	/**
	 * Obtiene el nombre del responsable asignado si hay alguno.
	 * @return string nombre del responsable asignado, '' si no tiene.
	 */
	public function getResponsibleName() {
		$responsibleName = '';
		
	}
	
	/**
	 * Devuelve la cantidad de proyectos asociados
	 *
	 *	@return string
	 */
	public function getProjectsCount() {
		$count = ProjectQuery::create()->filterByObjectiveId($this->getId())->count();
		return $count;
	}
	
	/**
	 * Devuelve los logs para el objetivo ordenados en forma decreciente por fecha de creación.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array Logs para el objetivo ordenados en forma decreciente por fecha de creación.
	 */
	public function getLogsOrderedByUpdated($orderType = 'asc') {
		$objectiveLogPeer = new ObjectiveLogPeer();
		return $objectiveLogPeer->getAllByObjectiveIdOrderedByUpdated($this->getId(), $orderType);
	}
	
	/**
	 * Devuelve los logs para el objetivo ordenados en forma decreciente por fecha de creación y paginados.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array Logs para el objetivo ordenados en forma decreciente por fecha de creación.
	 */
	public function getLogsOrderedByUpdatedPaginated($orderType = 'asc', $page=1, $maxPerPage=5) {
		$objectiveLogPeer = new ObjectiveLogPeer();
		return $objectiveLogPeer->getAllByObjectiveIdOrderedByUpdatedPaginated($this->getId(), $orderType, $page, $maxPerPage);
	}
	/*
	* Obtiene los proyectos asignadas al objetivo con un determinado status color.
	*
	* @return array Projects
	*/
	public function getProjectsByStatusColor($color) {
		$projects = $this->getAllProjects();
		$filteredProjects = array();
		foreach ($projects as $project) {
			if ($project->isOfStatusColor($color)) {
				$filteredProjects[] = $project;
			}
		}
		return $filteredProjects;
	}
	
	/*
	* Obtiene la cantidad de projects asignados al objetivo con un determinado status color.
	*
	* @return int $count
	*/
	public function getProjectsByStatusColorCount($color) {
		return getProjectsByStatusColor($color)->count();
	}
	
	/*
	* Obtiene un array asociativo con la cantidad de projects asignados al objetivo por cada color.
	*
	* @return array $colorsCount.
	*/
	public function getProjectsByStatusColorCountAssoc() {
		$projects = $this->getAllProjects();
		$colorsCount = array();
		foreach($projects as $project) {
			$color = $project->statusColor();
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
	* Obtiene todas los projects asociados a la instancia.
	*
	* @return PropelCollection $activities
	*/
	public function getAllProjects() {
		return ProjectQuery::create()->findByObjectiveId($this->getId());
	}
	
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
	
	public function setMinorChange($expr = true) {
		$this->minorChange = $expr;
	}
	
	public function getMinorChange() {
		return;
	}

	public function hasToLog() {
		return ((ConfigModule::get("objectives","useLogs")) && !$this->isNew() &&
			 (((ConfigModule::get("objectives","useMinorChanges")) && !$this->minorChange ) ||
			 (!ConfigModule::get("objectives","useMinorChanges"))));
	}
	
	public function setToLog($objectLog) {
		$this->toLog = $objectLog;
	}
/*
	public function postUpdate($con = null) {
		if ($this->hasToLog() && $this->toLog != null) {
			$objectLog = $this->toLog;
			$objectLog->setId(NULL);
			$objectLog->setObjectiveId($this->getId());
			$objectLog->setUpdated(time());
			print_r($objectLog);die;
			try {
				$objectLog->save();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
		}		
	}
*/	
	public function preUpdate($con =null) {		
		$this->setUpdated(time());
		//$this->setLastModification(time());
		$changes = $this->getChanges() + 1;
		$this->setChanges($changes);
		return true;
	}
	
	public function hasWriteAccess($user) {
		
		// Si está deshabilitado el chequeo en el config devuelvo true.
		if (!ConfigModule::get("objectives","verifyGroupWriteAccess"))
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
	
	public function getLogCount() {
		return ObjectiveLogQuery::create()->filterByObjectiveId($this->getId())->count();
	}
	
	public function hasAnyDisbursementIndicator() {
		$indicatorsCount = ProjectQuery::create()->filterByObjectiveId($this->getId())
												 ->select('Indicatorid')
												 ->where('Indicatorid IS NOT NULL')
												 ->count();
		return $indicatorsCount > 0;
	}



	/**
	 * Obtiene un array asociativo con el total ponderado de projects asignados al position por cada color.
	 *
	 * @return array $colorsCount.
	 */
	public function getProjectsByStatusColorWeightedByPriorityAssoc() {
		$projects = $this->getAllProjects();
		$colorsCount = array();
		foreach($projects as $project) {
			$color = $project->statusColor();
			if (!isset($colorsCount[$color]))
				$colorsCount[$color] = $project->getWeightBasedOnPriority();
			else
				$colorsCount[$color] += $project->getWeightBasedOnPriority(); 
		}
		// me aseguro de setear el resto de los colores disponibles que no hayan sido inicializados
		foreach($this->colors as $color) {
			if (!isset($colorsCount[$color]))
				$colorsCount[$color] = 0;
		}
		return $colorsCount;
	}

 /**
	* Obtiene la velocidad de la policyGuideline
	* @return int $speed velocidad de la policyGuideline
	*/
	public function getSpeed() {
		$colorsWeight = $this->getProjectsByStatusColorWeightedByPriorityAssoc();
		$colorsCount = $this->getProjectsByStatusColorCountAssoc();
		
		$totalProjects = $colorsCount['red'] + $colorsCount['yellow'] + $colorsCount['green'] + $colorsCount['blue'] + $colorsCount['black'] + $colorsCount['white'];
		$totalWeight = $colorsWeight['red'] + $colorsWeight['yellow'] + $colorsWeight['green'] + $colorsWeight['blue'] + $colorsWeight['black'] + $colorsWeight['white'];
		
		$speed = round((1 - (( $colorsWeight['red']*2 + $colorsWeight['yellow'] ) / ($totalWeight) ))*100);

		if ($speed < 0) 
			$speed = 0;

		return $speed;
	}

 /**
	* Obtiene el entero de 10 en 10 de la clase de velocidad de la policyGuideline
	* @return int $class entero de 10 en 10 para la clase de la velocidad de la policyGuideline
	*/
	public function getSpeedClass() {
		$speed = $this->getSpeed();
		$class = round($speed / 10) * 10;
		return $class;
	}
	
} // Objective
