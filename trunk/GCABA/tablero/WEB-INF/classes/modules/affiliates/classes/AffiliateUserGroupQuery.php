<?php


/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_userGroup' table.
 *
 * Users / Groups
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateUserGroupQuery extends BaseAffiliateUserGroupQuery {

	/**
	 * Returns a new AffiliateUserGroupQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AffiliateUserGroupQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AffiliateUserGroupQuery) {
			return $criteria;
		}
		$query = new self('application', 'AffiliateUserGroup', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // AffiliateUserGroupQuery
