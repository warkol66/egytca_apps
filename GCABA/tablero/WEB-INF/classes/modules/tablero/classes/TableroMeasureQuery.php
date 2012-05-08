<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_measure' table.
 *
 * Measure
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroMeasureQuery extends BaseTableroMeasureQuery {

	/**
	 * Returns a new TableroMeasureQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TableroMeasureQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TableroMeasureQuery) {
			return $criteria;
		}
		$query = new self('application', 'TableroMeasure', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // TableroMeasureQuery
