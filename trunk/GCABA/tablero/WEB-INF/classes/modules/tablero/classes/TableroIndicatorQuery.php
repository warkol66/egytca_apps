<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_indicator' table.
 *
 * Indicator
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroIndicatorQuery extends BaseTableroIndicatorQuery {

	/**
	 * Returns a new TableroIndicatorQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TableroIndicatorQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TableroIndicatorQuery) {
			return $criteria;
		}
		$query = new self('application', 'TableroIndicator', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // TableroIndicatorQuery
