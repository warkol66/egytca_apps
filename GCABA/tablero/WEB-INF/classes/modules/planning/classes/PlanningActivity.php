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
	
	/* ******** random values for testing ******** */
	private $useRandomValues;
	
	private $randomAcomplished;
	private $randomCancelled;
	private $randomRealStart;
	private $randomRealEnd;
	private $randomStartingDate;
	private $randomEndingDate;
	
	private function randomDate($format) {
		$format = str_replace('%', '', $format);
		if (rand(0, 1)) {
			return null;
		} else {
			$sign = rand(0, 1) ? '+': '-';
			return date($format, strtotime('today '.$sign.rand(0, 365).' days'));
		}
	}
	
	public function getAcomplished() {
		if ($this->useRandomValues) {
			if (!isset($this->randomAcomplished))
				$this->randomAcomplished = rand(0, 1);
			return $this->randomAcomplished;
		} else {
			return parent::getAcomplished();
		}
	}
	
	public function getCancelled() {
		if ($this->useRandomValues) {
			if (!isset($this->randomCancelled))
				$this->randomCancelled = rand(0, 1);
			return $this->randomCancelled;
		} else {
			return parent::getCancelled();
		}
	}
	
	public function getRealStart($format = '%Y/%m/%d') {
		if ($this->useRandomValues) {
			if (!isset($this->randomRealStart))
				$this->randomRealStart = $this->randomDate($format);
			return $this->randomRealStart;
		} else {
			return parent::getRealStart($format);
		}
	}
	
	public function getRealEnd($format = '%Y/%m/%d') {
		if ($this->useRandomValues) {
			if (!isset($this->randomRealEnd))
				$this->randomRealEnd = $this->randomDate($format);
			return $this->randomRealEnd;
		} else {
			return parent::getRealEnd($format);
		}
	}
	
	public function getStartingDate($format = '%Y/%m/%d') {
		if ($this->useRandomValues) {
			if (!isset($this->randomStartingDate))
				$this->randomStartingDate = $this->randomDate($format);
			return $this->randomStartingDate;
		} else {
			return parent::getStartingDate($format);
		}
	}
	
	public function getEndingDate($format = '%Y/%m/%d') {
		if ($this->useRandomValues) {
			if (!isset($this->randomEndingDate))
				$this->randomEndingDate = $this->randomDate($format);
			return $this->randomEndingDate;
		} else {
			return parent::getEndingDate($format);
		}
	}
	/* ****** end random values for testing ****** */
	
	public function __construct() {
		parent::__construct();
		
		global $system;
		$this->colors = $system["config"]["tablero"]["colors"];
		
		$this->useRandomValues = ConfigModule::get('planning', 'useDemoValues');
	}
	
	public function postSave(\PropelPDO $con = null) {
		parent::postSave($con);
		if ($this->getProject())
			$this->getProject()->doUpdateRealDates();
	}
	
	// TODO: Deberia reemplazar a isOnWork()????
	public function isOnExecution() {
		return ( !$this->getRealEnd() && $this->getRealStart('U') && ($this->getRealStart('U') < date('U')) );
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
	public function getProject() {
		return BaseQuery::create('Planning'.$this->getObjecttype())->findOneById($this->getObjectid());
	}
	
	/**
	 * Devuelve el color "status" de una actividad
	 * @return string con el color "status" de una actividad
	 */
	function statusColor() {
		if ($this->isCancelled())
			return $this->colors["cancelled"];
		if ($this->isFinished())
			return $this->colors["onTime"];
		if ($this->isLate() && !$this->isUndefined())
			return $this->colors["late"];
		if ($this->isUndefined() || $this->isDelayed())
			return $this->colors["delayed"];
		if (!$this->isStarted())
			return $this->colors["planned"];
		if ($this->isStarted())
			return $this->colors["onTime"];
		return $this->colors["planned"];
	}
	/**
	 * Devuelve true si la actividad esta cancelada
	 * @return bool si o no si esta cancelada
	 */
	function isCancelled() {
		return $this->getCancelled();
	}
	/**
	 * Devuelve true si la actividad esta terminada
	 * @return bool si o no si tiene fecha de fin real y marcada como cumplida
	 */
	function isFinished() {
		return ($this->getAcomplished() && !is_null($this->getRealEnd('U')));
	}
	/**
	 * Devuelve true si la actividade no tiene las fechas necesarias
	 * @return bool si tiene o no cargadas las fechas necesarias
	 */
	function isUndefined() {
		if ($this->getObjecttype() == "Construction")
			return is_null($this->getEndingDate('U'));
		else
			return (is_null($this->getStartingDate('U')) || is_null($this->getEndingDate('U')));
	}
	/**
	 * Devuelve true si la actividad esta iniciada, en caso que sea hito, devuelve true siempre
	 * @return bool si se inicio o no la actividad
	 */
	function isStarted() {
		if ($this->getObjecttype() == "Construction")
			return false;
		else
			return !is_null($this->getRealStart('U'));
	}
	/**
	 * Devuelve true si la actividad esta demorada, su inicio o fin estan vencidas y menores a la tolerancia
	 * @return bool si o no dependiendo de si esta demorada
	 */
	function isDelayed() {
		// Tolerancia en dias
		global $system;
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["delayed"];
			if ($days > 0)
				$comparisonTime = time() - ($days * 24 * 60 * 60);
			else
				$comparisonTime = time();
		}
		$comparisonDate = strtotime(date('Y-m-d', $comparisonTime)); 		// tiempo del comienzo del dia (comparo contra un date, no un datetime)

		if ($this->getObjecttype() == "Construction")
			return (($this->getEndingDate('U') < date('U')) && ($this->getEndingDate('U') > $comparisonDate));
		else
			if ($this->isStarted())
				return (($this->getEndingDate('U') < date('U')) && ($this->getEndingDate('U') > $comparisonDate));
			else
				return (($this->getStartingDate('U') < date('U')) && ($this->getStartingDate('U') > $comparisonDate));
	}
	/**
	 * Devuelve true si la actividad esta retrasada, su inicio o fin estan vencidos y mayores a la tolerancia
	 * @return bool si o no dependiendo de si esta demorada
	 */
	function isLate() {
		// Tolerancia en dias
		global $system;
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["delayed"];
			if ($days > 0)
				$comparisonTime = time() - ($days * 24 * 60 * 60);
			else
				$comparisonTime = time();
		}
		$comparisonDate = strtotime(date('Y-m-d', $comparisonTime)); 		// tiempo del comienzo del dia (comparo contra un date, no un datetime)
		if ($this->getObjecttype() == "Construction")
			return (($this->getEndingDate('U') < date('U')) && ($this->getEndingDate('U') < $comparisonDate));
		else
			if ($this->isStarted())
				return (($this->getEndingDate('U') < date('U')) && ($this->getEndingDate('U') < $comparisonDate));
			else
				return (($this->getStartingDate('U') < date('U')) && ($this->getStartingDate('U') < $comparisonDate));
	}
	/**
	 * Devuelve true si la actividad esta a termino
	 * @return bool si o no dependiendo de si esta a termino
	 */
	function isOnTime() {
		return (!$this->isDelayed() && !$this->isLate() && !$this->isFinished() && !$this->isCancelled());
	}
	/**
	 * Devuelve true la actividad es del color indicado
	 * @return bool si tiene o no el color indicado
	 */
	function isOfStatusColor($color) {
		return ($this->statusColor() === $color);
	}


/*	function isLate() {
		global $system;

		$currentTime = time();
		$plannedEnd = $this->getEndingdate('U');

		if (is_null($plannedEnd))
			return false;

		// Si se usa tolerancia en dias
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["late"];
			$currentTime = time() - ($days * 24 * 60 * 60);
		}
		// TODO agregar otros tipos de tolerancias
		
		$currentTime = strtotime(date('Y-m-d', $currentTime)); // tiempo del comienzo del dia (comparo contra un date, no un datetime)
		return (($currentTime > $plannedEnd) && !$this->isFinished());
	}
*/
} // PlanningActivity



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
//		$affiliate = $this->getProject()->getObjective()->getAffiliate();
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
