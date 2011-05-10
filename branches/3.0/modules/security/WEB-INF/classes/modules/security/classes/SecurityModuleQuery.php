<?php


/**
 * Skeleton subclass for performing query and update operations on the 'security_module' table.
 *
 * Modulos del sistema
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.security.classes
 */
class SecurityModuleQuery extends BaseSecurityModuleQuery {

	/**
	 * Returns a new SecurityModuleQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SecurityModuleQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SecurityModuleQuery) {
			return $criteria;
		}
		$query = new self('application', 'SecurityModule', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // SecurityModuleQuery
