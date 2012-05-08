<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_communeProcess' table.
 *
 * Asociacion entre Comunas y Procesos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroCommuneProcessQuery extends BaseTableroCommuneProcessQuery {

	/**
	 * Returns a new TableroCommuneProcessQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TableroCommuneProcessQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TableroCommuneProcessQuery) {
			return $criteria;
		}
		$query = new self('application', 'TableroCommuneProcess', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // TableroCommuneProcessQuery
