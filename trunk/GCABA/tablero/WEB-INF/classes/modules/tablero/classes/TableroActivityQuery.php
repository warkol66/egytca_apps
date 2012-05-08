<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_activity' table.
 *
 * Activity
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroActivityQuery extends BaseTableroActivityQuery {

	/**
	 * Returns a new TableroActivityQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TableroActivityQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TableroActivityQuery) {
			return $criteria;
		}
		$query = new self('application', 'TableroActivity', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // TableroActivityQuery
