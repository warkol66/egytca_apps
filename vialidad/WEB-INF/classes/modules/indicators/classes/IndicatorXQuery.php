<?php


/**
 * Skeleton subclass for performing query and update operations on the 'indicators_x' table.
 *
 * Valores del eje x
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class IndicatorXQuery extends BaseIndicatorXQuery {
	
	private $periodFormat = 'Y-m-d'; // format of the date returned by Period methods. Changing this will disrupt comparisons
	private $sqlDateFormat = '%m-%Y'; // format of the date stored at 'Name'
	
	// comparison => function mapping
	private $periodComparisonMap = array(
		Criteria::EQUAL => 'conditionForPeriodEqual',
		Criteria::LESS_EQUAL => 'conditionForPeriodLessEqual',
		Criteria::GREATER_EQUAL => 'conditionForPeriodGreaterEqual'
	);
	
	public function filterDistinctNamesByIndicatorIds($indicatorIds) {
		return $this->filterByIndicatorId($indicatorIds)
					->select('Name')
					->orderByName()
					->distinct();
	}
	
	private function sqlForFirstDay() {
		$month = "STR_TO_DATE(".IndicatorXPeer::NAME.", '".$this->sqlDateFormat."')";
		return "DATE_FORMAT($month, '%Y-%m-01')";
	}
	
	private function sqlForLastDay() {
		$firstDay = $this->sqlForFirstDay();
		return "LAST_DAY($firstDay)";
	}
	
	public function conditionForPeriodGreaterEqual($period) {
		
		$condName = uniqid('cond-');
		$lastDay = $this->sqlForLastDay();

		$this->condition($condName, "$lastDay >= ?", $period->getMin($this->periodFormat));
		return $condName;
	}
	
	public function conditionForPeriodLessEqual($period) {
		
		$condName = uniqid('cond-');
		$firstDay = $this->sqlForFirstDay();
		
		$this->condition($condName, "$firstDay <= ?", $period->getMax($this->periodFormat));
		return $condName;
	}
	
	public function conditionForPeriodEqual($period) {
		
		$condName = uniqid('cond-');
		$firstDay = $this->sqlForFirstDay();
		
		$this->condition($condName, "$firstDay = ?", $period->getMin($this->periodFormat));
		return $condName;
	}
	
	public function conditionForPeriod($period, $comparison = Criteria::EQUAL) {
		
		if (is_array($period)) {
			
			if (!array_key_exists('min', $period) && !array_key_exists('max', $period)) {
				throw new Exception('"'.Criteria::IN.'" comparison is not implemented');
			}
			
			// ahora pueden ser 1 o 2 condiciones
			$conditions = array();
			if (array_key_exists('min', $period))
				$conditions[] = $this->conditionForPeriodGreaterEqual($period['min']);
			if (array_key_exists('max', $period))
				$conditions[] = $this->conditionForPeriodLessEqual($period['max']);
			
			// hay por lo menos 1 condicion
			if (count($conditions) == 1) {
				return $conditions[0];
			}
			else {
				$condName = uniqid('cond-');
				$this->combine($conditions, 'and', $condName);
				return $condName;
			}
		}
		else {
			if (array_key_exists($comparison, $this->periodComparisonMap)) {
				$conditionFunction = $this->periodComparisonMap[$comparison];
				return $this->$conditionFunction($period);
			}
			else
				throw new Exception("\"$comparison\" comparison is not implemented");
		}
		
		return $this;
	}
	
	public function filterByPeriod($period, $comparison = Criteria::EQUAL) {
		return $this->where(array($this->conditionForPeriod($period, $comparison)));
	}
} // IndicatorXQuery
