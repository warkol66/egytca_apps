<?php


/**
 * Skeleton subclass for representing a row from the 'tablero_objective' table.
 *
 * Objective
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroObjective extends BaseTableroObjective {

	/** the default item name for this class */
	const ITEM_NAME = 'Objective';

	//mapea un status a la llamada del metodo que indica que estado tiene
	 private $projectStatus = array(
	 				'delayed'=>'isDelayed',
	 				'ended'=>'isEnded',
	 				'working'=>'isOnWork',
					'OnTime'=>'isOnTime',
					'Delayed'=>'isDelayed2',
					'Late'=>'isLate'
	 				);
	 
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
		
		foreach ($this->getTableroProjects() as $project) {
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

		foreach ($this->getTableroProjects() as $project) {
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
		$sql = "SELECT count(p.ID) as counter FROM ".TableroProjectPeer::TABLE_NAME." p WHERE p.OBJECTIVEID = '".$this->getId()."' AND 
				NOT EXISTS (SELECT * FROM ".TableroMilestonePeer::TABLE_NAME." m WHERE m.EXPIRATIONDATE>='".$delayedDate."' AND m.COMPLETED=0 AND m.PROJECTID = p.ID)";
		
		$con = Propel::getConnection(TableroObjectivePeer::DATABASE_NAME);
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
		$sql = "SELECT count(p.ID) as counter FROM ".TableroProjectPeer::TABLE_NAME." p WHERE p.OBJECTIVEID = '".$this->getId()."' AND 
				NOT EXISTS (SELECT * FROM ".TableroMilestonePeer::TABLE_NAME." m WHERE m.EXPIRATIONDATE>='".$lateDate."' AND m.COMPLETED=0 AND m.PROJECTID = p.ID) AND
				EXISTS (SELECT * FROM ".TableroMilestonePeer::TABLE_NAME." m WHERE m.EXPIRATIONDATE<'".$lateDate."' AND m.EXPIRATIONDATE>='".$delayedDate."' AND m.COMPLETED=0 AND m.PROJECTID = p.ID)";

		$con = Propel::getConnection(TableroObjectivePeer::DATABASE_NAME);
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
		$sql = "SELECT count(p.ID) as counter FROM ".TableroProjectPeer::TABLE_NAME." p WHERE p.OBJECTIVEID = '".$this->getId()."' AND 
				EXISTS (SELECT * from ".TableroMilestonePeer::TABLE_NAME." m WHERE m.EXPIRATIONDATE>='".$lateDate."' AND m.COMPLETED=0 AND m.PROJECTID = p.ID)";

		$con = Propel::getConnection(TableroObjectivePeer::DATABASE_NAME);
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
	 * Devuelve el nombre del Objetivo Estratégico
	 *
	 *	@return string
	 */
	public function getStrategicObjective()
	{
		$strategicObjectiveId = $this->getStrategicObjectiveId();
		$strategicObjective = TableroStrategicObjectiveQuery::create()->findOneById($strategicObjectiveId);
		return $strategicObjective->getName();
	}

} // TableroObjective
