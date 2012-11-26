<?php



/**
 * Skeleton subclass for representing a row from the 'planning_activity' table.
 *
 * Actividades de las obras y proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningActivity extends BasePlanningActivity {
	
	private $colors;
	
	public function __construct() {
		parent::__construct();
		
		global $system;
		$this->colors = $system["config"]["tablero"]["colors"];
	}

	/**
	 * Devuelve el nombre mas la particula identificatoria
	 *
	 * @return string
	 */
	public function getTreeName() {
		$pre = ConfigModule::get("planning","preTreeName");
		return $pre[get_class($this)].$this->getName();
	}

	/**
	 * Devuelve las actividades
	 * @return array Relacion las actividades
	 */
	public function getPlanningProject() {
		return BaseQuery::create('Planning'.$this->getObjecttype())->findOneById($this->getObjectid());
	}
	
	function statusColor() {
		if (!rand(0,5))
			return $this->colors["cancelled"];
		if (!rand(0,5))
			return $this->colors["finished"];
		if (!rand(0,5))
			return $this->colors["late"];
		if (!rand(0,5))
			return $this->colors["delayed"];
		if (!rand(0,5))
			return $this->colors["planned"];
		
		return $this->colors["onTime"];
		
		//TODO: averiguar
//		if ($this->isCancelled())
//			return $this->colors["cancelled"];
//		if ($this->isFinished())
//			return $this->colors["finished"];
//		if ($this->isLate())
//			return $this->colors["late"];
//		if ($this->isDelayed2())
//			return $this->colors["delayed"];
//		if (!$this->isStarted())
//			return $this->colors["planned"];
		return $this->colors["onTime"];
	}
//	
//	function isOfStatusColor($color) {
//		return ($this->statusColor() === $color);
//	}
//
//	function isStarted() {
//		return true; //TODO: averiguar
//		return !is_null( $this->getRealStart() );
//	}
//	
//	function isCancelled() {
//		return false; //TODO: averiguar
//		return $this->getCancelled();
//	}
//	
//	function isFinished() {
//		return false; //TODO: averiguar
//		return ( $this->getCompleted() || (!is_null($this->getRealEnd())) );
//	}
//	
//	function isOnTime() {
//		return true; //TODO: averiguar
//		if (!$this->isDelayed2() && !$this->isLate() && !$this->isFinished() && !$this->isCancelled()) 
//			return true;
//		return false;
//	}
//
//	function isDelayed2() {
//		return false; //TODO: averiguar
//		global $system;	
//			
//		$currentTime = time();
//		$plannedStart = $this->getPlannedStart('U');
//		
//		if (is_null($plannedStart)) 
//			return false;
//		
//		// Si se usa tolerancia en dias
//		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
//			$days = $system["config"]["tablero"]["activities"]["delayed"]; 
//			$currentTime = time() - ($days * 24 * 60 * 60);		
//		}
//		// TODO agregar otros tipos de tolerancias
//		
//		if ( $currentTime > $plannedStart && !$this->isStarted())
//			return true;
//		return false;		
//	}	
//
//	function isLate() {
//		return false; //TODO: averiguar
//		global $system;
//
//		$currentTime = time();
//		$plannedEnd = $this->getPlannedEnd('U');
//		
//		if (is_null($plannedEnd)) 
//			return false;
//		
//		// Si se usa tolerancia en dias
//		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
//			$days = $system["config"]["tablero"]["activities"]["late"];
//			$currentTime = time() - ($days * 24 * 60 * 60);			
//		}
//		// TODO agregar otros tipos de tolerancias
//		
//		if ( ($currentTime > $plannedEnd) && !$this->isFinished )
//			return true;
//		return false;			
//	}

} // PlanningActivity







//
//
//<?php
//
//
//
///**
// * Skeleton subclass for representing a row from the 'projects_activity' table.
// *
// * Activity
// *
// * You should add additional methods to this class to meet the
// * application requirements.  This class will only be generated as
// * long as it does not already exist in the output directory.
// *
// * @package    propel.generator.projects.classes
// */
//class ProjectActivity extends BaseProjectActivity {
//
//	/** the default item name for this class */
//	const ITEM_NAME = 'Activity';
//
//	private $toLog;
//	private $minorChange;
//	
//	/**
//	 * Indica si un afiliado/dependencia es duenio de la instancia
//	 * @param $affiliateId id de afiliado/dependencia
//	 * @return true si lo es, false sino
//	 */
//	function getProject() {
//		$project = ProjectPeer::get($this->getProjectId());
//		if (empty($project))
//			$project = new Project(); 
//		return $project;
//	}
//
//	/**
//	 * Indica si un afiliado/dependencia es duenio de la instancia
//	 * @param $affiliateId id de afiliado/dependencia
//	 * @return true si lo es, false sino
//	 */
//	function isOwner($affiliateId) {
//		$affiliate = $this->getProject()->getObjective()->getAffiliate();
//		if ($affiliate->getId() == $affiliateId)
//			return true;
//		
//		return false;
//	}
//	
//	function statusColor() {
//		global $system;	
//		$colors = $system["config"]["tablero"]["colors"];
//		if ($this->isCancelled())
//			return $colors["cancelled"];
//		if ($this->isFinished())
//			return $colors["finished"];
//		if ($this->isLate())
//			return $colors["late"];
//		if ($this->isDelayed2())
//			return $colors["delayed"];
//		if (!$this->isStarted())
//			return $colors["planned"];
//		return $colors["onTime"];
//									
//	}
//	
//	function isOfStatusColor($color) {
//		return ($this->statusColor() === $color);
//	}
//
//	function isStarted() {
//		return !is_null( $this->getRealStart() );
//	}
//		
//	function isCancelled() {
//		return $this->getCancelled();
//	}
//	
//	function isFinished() {
//		return ( $this->getCompleted() || (!is_null($this->getRealEnd())) );
//	}
//	
//	function isOnTime() {
//		if (!$this->isDelayed2() && !$this->isLate() && !$this->isFinished() && !$this->isCancelled()) 
//			return true;
//		return false;
//	}
//
//	function isDelayed2() {
//		global $system;	
//			
//		$currentTime = time();
//		$plannedStart = $this->getPlannedStart('U');
//		
//		if (is_null($plannedStart)) 
//			return false;
//		
//		// Si se usa tolerancia en dias
//		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
//			$days = $system["config"]["tablero"]["activities"]["delayed"]; 
//			$currentTime = time() - ($days * 24 * 60 * 60);		
//		}
//		// TODO agregar otros tipos de tolerancias
//		
//		if ( $currentTime > $plannedStart && !$this->isStarted())
//			return true;
//		return false;		
//	}	
//
//	function isLate() {
//		global $system;
//
//		$currentTime = time();
//		$plannedEnd = $this->getPlannedEnd('U');
//		
//		if (is_null($plannedEnd)) 
//			return false;
//		
//		// Si se usa tolerancia en dias
//		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
//			$days = $system["config"]["tablero"]["activities"]["late"];
//			$currentTime = time() - ($days * 24 * 60 * 60);			
//		}
//		// TODO agregar otros tipos de tolerancias
//		
//		if ( ($currentTime > $plannedEnd) && !$this->isFinished )
//			return true;
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
//	 * Devuelve el Date en formato YYYY-MM-DD
//	 *
//	 *	@return string
//	 */		
//	public function getDateFormatted() {
//		
//		$date = $this->getDate();
//
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
//			//si no hay fecha de expiracion, se devuelve la fecha de maniana
//			list($year,$month,$day) = explode("-",$this->getDateFormatted());
//			return $year . "-" . $month . "-" . ($day+1);		
//		}		
//		return $this->formatDate($date);
//	}
//
//	/**
//	 * Devuelve los logs para la actividad ordenados en forma decreciente por fecha de creación.
//	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
//	 * @return array Logs para la actividad ordenados en forma decreciente por fecha de creación.
//	 */
//	public function getLogsOrderedByUpdated($orderType = 'asc') {
//		$projectActivityLogPeer = new ProjectActivityLogPeer();
//		return $projectActivityLogPeer->getAllByActivityIdOrderedByUpdated($this->getId(), $orderType);
//	}
//	
//	/**
//	 * Devuelve los logs para la actividad ordenados en forma decreciente por fecha de creación y paginados.
//	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
//	 * @param int $page numero de pagina.
//	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
//	 * @return array Logs para la actividad ordenados en forma decreciente por fecha de creación.
//	 */
//	public function getLogsOrderedByUpdatedPaginated($orderType = 'asc', $page=1, $maxPerPage=5) {
//		$projectActivityLogPeer = new ProjectActivityLogPeer();
//		return $projectActivityLogPeer->getAllByActivityIdOrderedByUpdatedPaginated($this->getId(), $orderType, $page, $maxPerPage);
//	}
//	
//	public function getLogCount() {
//		return ProjectActivityLogQuery::create()->filterByActivityId($this->getId())->count();
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
//	public function hasToLog() {
//		return ((ConfigModule::get("projects","useLogs")) && !$this->isNew() &&
//			 (((ConfigModule::get("projects","useMinorChanges")) && !$this->minorChange ) ||
//			 (!ConfigModule::get("projects","useMinorChanges"))));
//	}
//	
//	public function setToLog($objectLog) {
//		$this->toLog = $objectLog;
//	}
//
//	public function postUpdate($con = null) {
//		if ($this->hasToLog() && $this->toLog != null) {
//			$objectLog = $this->toLog;
//			$objectLog->setId(NULL);
//			$objectLog->setActivityId($this->getId());
//			$objectLog->setUpdated(time());
//			try {
//				$objectLog->save();
//			}
//			catch (PropelException $exp) {
//				if (ConfigModule::get("global","showPropelExceptions"))
//					print_r($exp->getMessage());
//			}
//		}		
//	}
//	
//	public function preUpdate($con =null) {		
//		$this->setUpdated(time());
//		$this->setLastModification(time());
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
//		if (!ConfigModule::get("projects","verifyGroupWriteAccess"))
//			return true;
//		
//		// Si se trata de administrador o supervisor, tiene acceso.
//		if ($user->isAdmin() || $user->isSupervisor())
//			return true;
//		
//		$responsibleCode = $this->getProject()->getResponsibleCode();
//		
//		// Caso contrario, hay que ver si el usuario pertenece al grupo correcto.
//		$result = GroupQuery::create()->join('Group.UserGroup')->join('Group.Position')
//										 ->where('UserGroup.Userid = ?', $user->getId())
//										 ->where('Position.Code = ?', $responsibleCode)->count();
//		return $result > 0;
//			
//	}
//
//	/**
//	 * Devuelve la información de navegación para listados
//	 *
//	 *	@return array información de navegación hacia arriba
//	 */
//	public function getParentLinkPath() {
//		$project = $this->getProject();
//
//		$parentLinkInfo = array();
//		$parentLinkInfo['parentName'] = $project;
//		$parentLinkInfo['parentParentLink'] = "objectivesList";
//		$parentLinkInfo['parentParentFilters'] = "&filters[fromObjectives]=true&filters[objective]=";
//
//		$strategicObjective = StrategicObjectiveQuery::create()->findOneById($strategicObjectiveId);
//		$parentLinkInfo['parentParentObject'] = $strategicObjective;
//		$parentLinkInfo['parentParentId'] = $policyGuideline->getPolicyGuidelineId();
//		
//		return $parentLinkInfo;
//	}
//
//} // ProjectActivity
