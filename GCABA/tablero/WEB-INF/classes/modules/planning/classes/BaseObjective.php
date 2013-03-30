<?php

class BaseObjective {
	
	private $child;
	private $colors;
//	private $colorsCount;
	
	//mapea un status a la llamada del metodo que indica que estado tiene
	private $projectStatus = array(
		'delayed' => 'isDelayed',
		'ended' => 'isEnded',
		'working' => 'isOnWork',
		'onTime' => 'isOnTime',
		'late' => 'isLate'
	);

	public function __construct($child) {
		$this->child = $child;
		global $system;
		$this->colors = $system["config"]["tablero"]["colors"];
	}
	
	/**
	 * Obtiene un array asociativo con la cantidad de projects asignados al objetivo por cada color.
	 *
	 * @return array $colorsCount.
	 */
	public function getProjectsByStatusColorCountAssoc() {
		$projects = $this->child->getAllProjects();
		$colorsCount = array();
		
		foreach ($this->colors as $color) {
			$colorsCount[$color] = 0;
		}

		foreach ($projects as $project) {
			$color = $project->statusColor();
			$colorsCount[$color]++;
		}

		return $colorsCount;
	}
	
	/**
	 * Obtiene los proyectos asignadas al objetivo con un determinado status color.
	 *
	 * @return array Projects
	 */
	public function getProjectsByStatusColor($color) {
		$projects = $this->child->getAllProjects();
		$filteredProjects = array();
		foreach ($projects as $project) {
			if ($project->isOfStatusColor($color)) {
				$filteredProjects []= $project;
			}
		}
		return $filteredProjects;
	}
	
	/**
	 * Obtiene la cantidad de projects asignados al objetivo con un determinado status color.
	 *
	 * @return int $count
	 */
	public function countProjectsByStatusColor($color) {
		return count($this->child->getProjectsByStatusColor($color));
	}

	private function countProjectsByStatus($status) {
	
		//busco la llamada a hacer
		$method = $this->projectStatus[$status];
		$count = 0;
		foreach ($this->child->getAllProjects() as $project) {
			if ($project->$method())
				$count++;
		}
		
		return $count;
	}
	
	function statusColor() {
		if ($this->child->isOnTime())
			return $this->colors["onTime"];
		if ($this->isDelayed())
			return $this->colors["delayed"];			
		if ($this->isLate())
			return $this->colors["late"];			
	}
	
	function isOnTime() {
		return ($this->child->countProjectsByStatus('delayed') == 0 && $this->child->countProjectsByStatus('late') == 0);
	}
	
	function isDelayed() {
		return ($this->child->countProjectsByStatus('delayed') != 0 && $this->child->countProjectsByStatus('late') == 0);
	}

	function isLate() {
		return ($this->child->countProjectsByStatus('late') != 0);
	}
	
	/**
	 * Devuelve las partidas presupuestarias
	 * @return PropelObjectCollection partidas presupuestarias
	 */
	function getBudgetItems($criteria) {
		$budgetItems = array();
		foreach ($this->child->getAllProjects() as $project) { // $project no necesariamente es un PlanningProject (ver BaseProject)
			$budgetItems = array_merge($budgetItems, $project->getBudgetItems($criteria)->getArrayCopy());
		}
		return new PropelObjectCollection($budgetItems);
	}
	
}

//	private $toLog;
//	private $minorChange;	 
//	 
//
//	/**
//	 * Indica si un afiliado/dependencia es duenio de la instancia
//	 * @param $affiliateId id de afiliado/dependencia
//	 * @return true si lo es, false sino
//	 */	 
//	function isOwner($affiliateId) {
//		$affiliate = $this->getAffiliate();
//		if ($affiliate->getId() == $affiliateId)
//			return true;
//		
//		return false;
//	}
//	
//	/**
//	 * Da formato de YYYY-MM-DD a un datetime
//	 *
//	 *	@return string	 
//	 */
//	private function formatDate($date) {
//		
//		preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/", $date, $regs);
//		return "$regs[1]-$regs[2]-$regs[3]";
//		
//	}
//	
//	/**
//	 * Devuelve el date en formato YYYY-MM-DD
//	 *
//	 *	@return string
//	 */
//	public function getDateFormatted() {
//
//		$date = $this->getDate();
//		if (empty($date))
//			//si no hay fecha se devuelve la fecha de hoy
//			return date('Y-m-d');
//	
//		return $this->formatDate($date);
//	}
//	
//	/**
//	 * Devuelve el Expiration Date en formato YYYY-MM-DD
//	 *
//	 *	@return string
//	 */	
//	public function getExpirationDateFormatted() {
//		
//		$date = $this->getExpirationDate();
//		if (empty($date) || ($date == "1999-11-30 00:00:00")) {
//			
//			//si no hay fecha de expiracion, se devuelve la fecha de maniana
//			list($year,$month,$day) = explode("-",$this->getDateFormatted());
//			return $year . "-" . $month . "-" . ($day+1);		
//		}		
//		return $this->formatDate($date);
//	}		
//
//	/**
//	 * Devuelve el nombre del Objetivo Estrat�gico
//	 *
//	 *	@return string
//	 */
//	public function getStrategicObjective() {
//		$strategicObjectiveId = $this->getStrategicObjectiveId();
//		if ($strategicObjectiveId > 0) {
//			$strategicObjective = StrategicObjectiveQuery::create()->findOneById($strategicObjectiveId);
//			if (is_null($strategicObjective))
//				$strategicObjective = new StrategicObjective();
//		}
//		else
//			$strategicObjective = new StrategicObjective();
//		return $strategicObjective->getName();
//	}
//	
//	/**
//	 * Devuelve la información de navegación para listados
//	 *
//	 *	@return array información de navegación hacia arriba
//	 */
//	public function getParentLinkPath() {
//		$parentLinkInfo = array();
//
//		$strategicObjectiveId = $this->getStrategicObjectiveId();
//		$strategicObjective = StrategicObjectiveQuery::create()->findOneById($strategicObjectiveId);
//
//		if(!empty($strategicObjective)){
//			$parentLinkInfo['parentLink'] = "objectivesList&filters[fromStrategicObjectives]=true&filters[strategicObjective]=";
//			$parentLinkInfo['parentObject'] = $strategicObjective;
//			$parentLinkInfo['parentId'] = $strategicObjectiveId;
//			return $parentLinkInfo;
//		}
//		else
//			return;
//	}
//
//	/**
//	 * Obtiene el nombre del responsable asignado si hay alguno.
//	 * @return string nombre del responsable asignado, '' si no tiene.
//	 */
//	public function getResponsibleName() {
//		$responsibleName = '';
//		
//	}
//	
//	/**
//	 * Devuelve los logs para el objetivo ordenados en forma decreciente por fecha de creación.
//	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
//	 * @return array Logs para el objetivo ordenados en forma decreciente por fecha de creación.
//	 */
//	public function getLogsOrderedByUpdated($orderType = 'asc') {
//		$objectiveLogPeer = new ObjectiveLogPeer();
//		return $objectiveLogPeer->getAllByObjectiveIdOrderedByUpdated($this->getId(), $orderType);
//	}
//	
//	/**
//	 * Devuelve los logs para el objetivo ordenados en forma decreciente por fecha de creación y paginados.
//	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
//	 * @param int $page numero de pagina.
//	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
//	 * @return array Logs para el objetivo ordenados en forma decreciente por fecha de creación.
//	 */
//	public function getLogsOrderedByUpdatedPaginated($orderType = 'asc', $page=1, $maxPerPage=5) {
//		$objectiveLogPeer = new ObjectiveLogPeer();
//		return $objectiveLogPeer->getAllByObjectiveIdOrderedByUpdatedPaginated($this->getId(), $orderType, $page, $maxPerPage);
//	}
//	
//	public function save(PropelPDO $con = null) {
//		try {
//			if ($this->validate()) { 
//				parent::save($con);
//				return true;
//			} else {
//				return false;
//			}
//		}
//		catch (PropelException $exp) {
//			if (ConfigModule::get("global","showPropelExceptions"))
//				print_r($exp->getMessage());
//			return false;
//		}
//	}
//	
//	public function setMinorChange($expr = true) {
//		$this->minorChange = $expr;
//	}
//	
//	public function getMinorChange() {
//		return;
//	}
//
//	public function hasToLog() {
//		return ((ConfigModule::get("objectives","useLogs")) && !$this->isNew() &&
//			 (((ConfigModule::get("objectives","useMinorChanges")) && !$this->minorChange ) ||
//			 (!ConfigModule::get("objectives","useMinorChanges"))));
//	}
//	
//	public function setToLog($objectLog) {
//		$this->toLog = $objectLog;
//	}
///*
//	public function postUpdate($con = null) {
//		if ($this->hasToLog() && $this->toLog != null) {
//			$objectLog = $this->toLog;
//			$objectLog->setId(NULL);
//			$objectLog->setObjectiveId($this->getId());
//			$objectLog->setUpdated(time());
//			print_r($objectLog);die;
//			try {
//				$objectLog->save();
//			}
//			catch (PropelException $exp) {
//				if (ConfigModule::get("global","showPropelExceptions"))
//					print_r($exp->getMessage());
//			}
//		}		
//	}
//*/	
//
//	/**
//	* Modificaciones a datos previos a guardar un project
//	* @param $con conexión a la base de datos
//	*/
//	public function preSave($con =null) {		
//		if (method_exists($this,"setUserId"))
//			$this->setUserId($_SESSION["loginUser"]->getId());
//		return true;
//	}
//
//	public function preUpdate($con =null) {		
//		$this->setUpdated(time());
//		//$this->setLastModification(time());
//		if (method_exists($this,"getChanges")) {
//			$changes = $this->getChanges() + 1;
//			$this->setChanges($changes);
//		}
//		return true;
//	}
//	
//	public function hasWriteAccess($user) {
//		
//		// Si está deshabilitado el chequeo en el config devuelvo true.
//		if (!ConfigModule::get("objectives","verifyGroupWriteAccess"))
//			return true;
//		
//		// Si se trata de administrador o supervisor, tiene acceso.
//		if ($user->isAdmin() || $user->isSupervisor())
//			return true;
//		
//		$responsibleCode = $this->getResponsibleCode();
//		
//		// Caso contrario, hay que ver si el usuario pertenece al grupo correcto.
//		$result = GroupQuery::create()->join('Group.UserGroup')->join('Group.Position')
//										 ->where('UserGroup.Userid', $user->getId())
//										 ->where('Position.Code', $responsibleCode)->count();
//		return $result > 0;
//			
//	}
//	
//	public function getLogCount() {
//		return ObjectiveLogQuery::create()->filterByObjectiveId($this->getId())->count();
//	}
//	
//	public function hasAnyDisbursementIndicator() {
//		$indicatorsCount = ProjectQuery::create()->filterByObjectiveId($this->getId())
//												 ->select('Indicatorid')
//												 ->where('Indicatorid IS NOT NULL')
//												 ->count();
//		return $indicatorsCount > 0;
//	}
//
//
//
//	/**
//	 * Obtiene un array asociativo con el total ponderado de projects asignados al position por cada color.
//	 *
//	 * @return array $colorsCount.
//	 */
//	public function getProjectsByStatusColorWeightedByPriorityAssoc() {
//		$projects = $this->getAllProjects();
//		$colorsCount = array();
//		foreach($projects as $project) {
//			$color = $project->statusColor();
//			if (!isset($colorsCount[$color]))
//				$colorsCount[$color] = $project->getWeightBasedOnPriority();
//			else
//				$colorsCount[$color] += $project->getWeightBasedOnPriority(); 
//		}
//		// me aseguro de setear el resto de los colores disponibles que no hayan sido inicializados
//		foreach($this->colors as $color) {
//			if (!isset($colorsCount[$color]))
//				$colorsCount[$color] = 0;
//		}
//		return $colorsCount;
//	}
//
// /**
//	* Obtiene la velocidad de la policyGuideline
//	* @return int $speed velocidad de la policyGuideline
//	*/
//	public function getSpeed() {
//		$colorsWeight = $this->getProjectsByStatusColorWeightedByPriorityAssoc();
//		$colorsCount = $this->getProjectsByStatusColorCountAssoc();
//		
//		$totalProjects = $colorsCount['red'] + $colorsCount['yellow'] + $colorsCount['green'] + $colorsCount['blue'] + $colorsCount['black'] + $colorsCount['white'];
//		$totalWeight = $colorsWeight['red'] + $colorsWeight['yellow'] + $colorsWeight['green'] + $colorsWeight['blue'] + $colorsWeight['black'] + $colorsWeight['white'];
//		
//		$speed = round((1 - (( $colorsWeight['red']*2 + $colorsWeight['yellow'] ) / ($totalWeight) ))*100);
//
//		if ($speed < 0) 
//			$speed = 0;
//
//		return $speed;
//	}
//
// /**
//	* Obtiene el entero de 10 en 10 de la clase de velocidad de la policyGuideline
//	* @return int $class entero de 10 en 10 para la clase de la velocidad de la policyGuideline
//	*/
//	public function getSpeedClass() {
//		$speed = $this->getSpeed();
//		$class = round($speed / 10) * 10;
//		return $class;
//	}
//	
//} // Objective
