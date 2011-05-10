<?php


/**
 * Skeleton subclass for performing query and update operations on the 'security_actionLabel' table.
 *
 * etiquetas de actions de seguridad
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.security.classes
 */
class SecurityActionLabelQuery extends BaseSecurityActionLabelQuery {

	/**
	 * Returns a new SecurityActionLabelQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SecurityActionLabelQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SecurityActionLabelQuery) {
			return $criteria;
		}
		$query = new self('application', 'SecurityActionLabel', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // SecurityActionLabelQuery
