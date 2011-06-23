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
} // IndicatorXQuery
