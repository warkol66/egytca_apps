<?php


/**
 * Skeleton subclass for performing query and update operations on the 'indicators_serie' table.
 *
 * Series
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class IndicatorSerieQuery extends BaseIndicatorSerieQuery {

	public function filterDistinctNamesByIndicatorIds($indicatorIds) {
		return $this->filterByIndicatorId($indicatorIds)
					->select('Name')
					->orderByName()
					->distinct();
	}
} // IndicatorSerieQuery
