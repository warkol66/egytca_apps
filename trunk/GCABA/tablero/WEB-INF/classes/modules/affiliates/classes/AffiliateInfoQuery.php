<?php


/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_affiliateInfo' table.
 *
 * Informacion del afiliado
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateInfoQuery extends BaseAffiliateInfoQuery {

	/**
	 * Returns a new AffiliateInfoQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AffiliateInfoQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AffiliateInfoQuery) {
			return $criteria;
		}
		$query = new self('application', 'AffiliateInfo', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // AffiliateInfoQuery
