<?php


/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_level' table.
 *
 * Levels
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateLevelQuery extends BaseAffiliateLevelQuery {

	/**
	 * Returns a new AffiliateLevelQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AffiliateLevelQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AffiliateLevelQuery) {
			return $criteria;
		}
		$query = new self('application', 'AffiliateLevel', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // AffiliateLevelQuery
