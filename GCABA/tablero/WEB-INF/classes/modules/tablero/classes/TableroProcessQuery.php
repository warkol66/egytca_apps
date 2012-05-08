<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_process' table.
 *
 * Process
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroProcessQuery extends BaseTableroProcessQuery {

	/**
	 * Returns a new TableroProcessQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TableroProcessQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TableroProcessQuery) {
			return $criteria;
		}
		$query = new self('application', 'TableroProcess', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // TableroProcessQuery
