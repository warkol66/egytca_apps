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
	
	public function filterDistinctNamesByIndicatorIds($indicatorIds) {
		return $this->filterByIndicatorId($indicatorIds)
					->select('Name')
					->orderByName()
					->distinct();
	}
	
	public function filterByDate($date, $comparison = Criteria::EQUAL) {
		
		// todo esto sirve si el formato de fecha es Y-m-d. Revisar para otros formatos
		
		if (is_array($date)) {
			if (array_key_exists('min', $date))
				$this->filterByName($date['min'], Criteria::GREATER_EQUAL);
			if (array_key_exists('max', $date))
				$this->filterByName($date['max'], Criteria::LESS_EQUAL);
			if (!array_key_exists('min', $date) && !array_key_exists('max', $date))
				$this->filterByName($date, Criteria::IN); // TODO: funciona?
		}
		else
			$this->filterByName($date, $comparison);
		
		return $this;
	}
} // IndicatorXQuery
