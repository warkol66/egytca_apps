<?php


/**
 * Skeleton subclass for representing a row from the 'processes_process' table.
 *
 * Process
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.processes.classes
 */
class Process extends BaseProcess {

	/** the default item name for this class */
	const ITEM_NAME = 'Process';

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
	
	function isDelayed() {
	
		return ($this->isOnWork() && ($this->getGoalExpirationDate <= date('Y-m-d')." 00:00:00"));
		
	}
	
	function isEnded() {
		
		return ($this->getFinished() == 1);
	
	}
	
	function isOnWork() {

		return ($this->getFinished() == 0);
	
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
		return ($this->getCountMilestonesDelayed() == 0 && $this->getCountMilestonesLate() == 0);
	}
	
	function isDelayed2() {
		return ($this->getCountMilestonesDelayed() != 0 && $this->getCountMilestonesLate() == 0);
	}	
	
	function isLate() {
		return ($this->getCountMilestonesLate() != 0);
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
	function getMilestonesOnTimeCriteria($noProcess = false) {
		$cond = new Criteria();
		if (!$noProcess)
			$cond->add(TableroMilestonePeer::PROCESSID,$this->getId());
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
	function getMilestonesDelayedCriteria($noProcess = false) {
		$cond = new Criteria();
		if (!$noProcess)
			$cond->add(TableroMilestonePeer::PROCESSID,$this->getId());
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
	function getMilestonesLateCriteria($noProcess = false) {
		$cond = new Criteria();
		if (!$noProcess)		
			$cond->add(TableroMilestonePeer::PROCESSID,$this->getId());
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
	
} // Process
