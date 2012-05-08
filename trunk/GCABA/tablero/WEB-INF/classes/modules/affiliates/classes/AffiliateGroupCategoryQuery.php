<?php


/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_groupCategory' table.
 *
 * Groups / Categories
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.categories.classes
 */
class AffiliateGroupCategoryQuery extends BaseAffiliateGroupCategoryQuery {

	/**
	 * Returns a new AffiliateGroupCategoryQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AffiliateGroupCategoryQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AffiliateGroupCategoryQuery) {
			return $criteria;
		}
		$query = new self('application', 'AffiliateGroupCategory', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // AffiliateGroupCategoryQuery
