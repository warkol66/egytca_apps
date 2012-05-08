<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_measureUnit' table.
 *
 * Unidad de Medida
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroMeasureUnitQuery extends BaseTableroMeasureUnitQuery {

	/**
	 * Returns a new TableroMeasureUnitQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TableroMeasureUnitQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TableroMeasureUnitQuery) {
			return $criteria;
		}
		$query = new self('application', 'TableroMeasureUnit', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // TableroMeasureUnitQuery
