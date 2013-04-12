<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_activity' table.
 *
 * Actividades de las obras y proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningActivityQuery extends BasePlanningActivityQuery {
	
	protected function preSelect(\PropelPDO $con) {
		parent::preSelect($con);
		$this->orderById();
	}

 /**
	* Agrega filtros por fecha de vencimiento de la actividad
	*
	* @param   type array $range array con rango de fechas
	* @return condicion de filtrado por rango de fecha de vencimiento
	*/
	public function rangeExpiring($range) {
		return $this->filterByEndingdate($range);
	}

 /**
	* Agrega filtros por fecha de inicio de la actividad
	*
	* @param   type array $range array con rango de fechas
	* @return condicion de filtrado por rango de fecha de vencimiento
	*/
	public function rangeStarting($range) {
		return $this->filterByStartingdate($range);
	}
	
	public function filterByColor($color, $comparison = Criteria::EQUAL) {
		
		global $system;
		$availableColors = $system['config']['tablero']['colors'];
		
		$colorStates = array_keys($availableColors, $color);
		$filterMethod = 'filterBy'.$colorStates[0];
		
		return $this->$filterMethod(null, $comparison);
	}
	
	public function filterByDelayed($value = null, $comparison = Criteria::EQUAL) {
		return $this->where(array($this->conditionForDelayed($comparison)));
	}
	
	public function filterByFinished($value = null, $comparison = Criteria::EQUAL) {
		return $this->where(array($this->conditionForFinished($comparison)));
	}
	
	public function filterByLate($value = null, $comparison = Criteria::EQUAL) {
		return $this->where(array($this->conditionForLate($comparison)));
	}
	
	public function filterByOnTime($value = null, $comparison = Criteria::EQUAL) {
		$opposedComparison = $comparison == Criteria::EQUAL ? Criteria::NOT_EQUAL : Criteria::EQUAL;
		return $this->where(array(
			$this->conditionForDelayed($opposedComparison),
			$this->conditionForLate($opposedComparison),
			$this->conditionForFinished($opposedComparison),
			$this->conditionForCancelled($opposedComparison)
		), $comparison == Criteria::EQUAL ? 'and' : 'or');
	}
	
	public function filterByPlanned($value = null, $comparison = Criteria::EQUAL) {
		return $this->filterByStarted($value, $comparison);
	}
	
	public function filterByStarted($value = null, $comparison = Criteria::EQUAL) {
		return $this->where(array($this->conditionForStarted($comparison)));
	}
	
	public function conditionForCancelled($comparison = Criteria::EQUAL) {
		$condResult = $comparison == Criteria::EQUAL ? 'condCancelled' : 'condNotCancelled';
		$this->condition($condResult, PlanningActivityPeer::CANCELLED . ' ' . $comparison . ' TRUE');
		return $condResult;
	}
	
	public function conditionForDelayed($comparison = Criteria::EQUAL) {
		
		$currentTime = time();

		// Si se usa tolerancia en dias
		global $system;
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["late"];
			$currentTime = time() - ($days * 24 * 60 * 60);
		}
		
		$condDateComparison = uniqid('cond-');
		$this->condition($condDateComparison, '"'.date('Y-m-d', $currentTime).'"' . ($comparison == Criteria::EQUAL ? ' > ' : ' <= ') . PlanningActivityPeer::STARTINGDATE);
		$condStarted = $this->conditionForStarted($comparison == Criteria::EQUAL ? Criteria::NOT_EQUAL : Criteria::EQUAL);
		$cond1 = uniqid('cond-');
		$this->combine(array($condDateComparison, $condStarted), $comparison == Criteria::EQUAL ? 'and' : 'or', $cond1);
		
		$condStartingDateExistance = uniqid('cond-');
		$this->condition($condStartingDateExistance, PlanningActivityPeer::STARTINGDATE . ($comparison == Criteria::EQUAL ? ' IS NOT NULL' : ' IS NULL') );
		
		$condResult = $comparison == Criteria::EQUAL ? 'condDelayed' : 'condNotDelayed';
		$this->combine(array($cond1, $condStartingDateExistance), $comparison == Criteria::EQUAL ? 'and' : 'or', $condResult);
		return $condResult;
	}
	
	public function conditionForFinished($comparison = Criteria::EQUAL) {
		$condResult = $comparison == Criteria::EQUAL ? 'condFinished' : 'condNotFinished';
		$cond1 = uniqid('cond-');
		$cond2 = uniqid('cond-');
		$this->condition($cond1, PlanningActivityPeer::ACOMPLISHED .' '. $comparison . ' TRUE')
			->condition($cond2, PlanningActivityPeer::REALEND . ($comparison == Criteria::EQUAL ? ' IS NOT NULL' : ' IS NULL') )
			->combine(array($cond1, $cond2), $comparison == Criteria::EQUAL ? 'or' : 'and', $condResult);
		return $condResult;
	}
	
	public function conditionForLate($comparison = Criteria::EQUAL) {
		
		$currentTime = time();

		// Si se usa tolerancia en dias
		global $system;
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["late"];
			$currentTime = time() - ($days * 24 * 60 * 60);
		}
		
		$condDateComparison = uniqid('cond-');
		$this->condition($condDateComparison, '"'.date('Y-m-d', $currentTime).'"' . ($comparison == Criteria::EQUAL ? ' > ' : ' <= ') . PlanningActivityPeer::ENDINGDATE);
		$condFinished = $this->conditionForFinished($comparison == Criteria::EQUAL ? Criteria::NOT_EQUAL : Criteria::EQUAL);
		$cond1 = uniqid('cond-');
		$this->combine(array($condDateComparison, $condFinished), $comparison == Criteria::EQUAL ? 'and' : 'or', $cond1);
		
		$condEndingDateExistance = uniqid('cond-');
		$this->condition($condEndingDateExistance, PlanningActivityPeer::ENDINGDATE . ($comparison == Criteria::EQUAL ? ' IS NOT NULL' : ' IS NULL') );
		
		$condResult = $comparison == Criteria::EQUAL ? 'condLate' : 'condNotLate';
		$this->combine(array($cond1, $condEndingDateExistance), $comparison == Criteria::EQUAL ? 'and' : 'or', $condResult);
		return $condResult;
	}
	
	public function conditionForStarted($comparison = Criteria::EQUAL) {
		$condResult = $comparison == Criteria::EQUAL ? 'condStarted' : 'condNotStarted';
		$this->condition($condResult, PlanningActivityPeer::REALSTART . ' ' . ($comparison == Criteria::EQUAL ? Criteria::ISNOTNULL : Criteria::ISNULL) );
		return $condResult;
	}

} // PlanningActivityQuery
