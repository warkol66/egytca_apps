<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_region' table.
 *
 * Barrios
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroRegionQuery extends BaseTableroRegionQuery {

	/**
	 * Returns a new TableroRegionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TableroRegionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TableroRegionQuery) {
			return $criteria;
		}
		$query = new self('application', 'TableroRegion', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // TableroRegionQuery
