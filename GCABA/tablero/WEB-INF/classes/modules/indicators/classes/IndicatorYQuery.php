<?php


/**
 * Skeleton subclass for performing query and update operations on the 'indicators_y' table.
 *
 * Valores del eje Y
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class IndicatorYQuery extends BaseIndicatorYQuery {
	
	public function filterBySerieName($name = null, $comparison = null)
	{
		return $this->join('IndicatorSerie')
					->useQuery('IndicatorSerie')->filterByName($name, $comparison)->endUse();
	}
	
	public function filterByXName($name = null, $comparison = null)
	{
		return $this->join('IndicatorX')
					->useQuery('IndicatorX')->filterByName($name, $comparison)->endUse();
	}
	
	public function filterByIndicatorId($indicatorId = null, $comparison = null)
	{
		return $this->join('IndicatorSerie')
					->join('IndicatorX')
					->useQuery('IndicatorX')->filterByIndicatorId($indicatorId, $comparison)->endUse()
					->useQuery('IndicatorSerie')->filterByIndicatorId($indicatorId, $comparison)->endUse();
	}
	
	public function findSumValues() {
		return $this->withColumn('SUM(Value)', 'SumValue')
					->select('SumValue')
					->findOne();
	}
} // IndicatorYQuery
