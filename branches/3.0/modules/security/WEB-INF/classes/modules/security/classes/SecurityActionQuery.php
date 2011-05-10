<?php


/**
 * Skeleton subclass for performing query and update operations on the 'security_action' table.
 *
 * Actions del sistema
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.security.classes
 */
class SecurityActionQuery extends BaseSecurityActionQuery {

	/**
	 * Returns a new SecurityActionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SecurityActionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SecurityActionQuery) {
			return $criteria;
		}
		$query = new self('application', 'SecurityAction', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // SecurityActionQuery
