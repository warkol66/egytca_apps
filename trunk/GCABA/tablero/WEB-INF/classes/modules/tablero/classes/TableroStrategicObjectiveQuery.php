<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_strategicObjective' table.
 *
 * Strategic Objective
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroStrategicObjectiveQuery extends BaseTableroStrategicObjectiveQuery {

	/**
	 * Returns a new TableroStrategicObjectiveQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TableroStrategicObjectiveQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TableroStrategicObjectiveQuery) {
			return $criteria;
		}
		$query = new self();
		if (null !== $modelAlias) {
			$query->setModelalias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // TableroStrategicObjectiveQuery
