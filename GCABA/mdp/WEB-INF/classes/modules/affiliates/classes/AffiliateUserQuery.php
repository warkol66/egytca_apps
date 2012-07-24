<?php



/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_user' table.
 *
 * Usuarios de afiliado
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateUserQuery extends BaseAffiliateUserQuery {

	public function owners() {
		return $this->joinAffiliateRelatedByOwnerid(null, Criteria::INNER_JOIN)
					->distinct();
	}

} // AffiliateUserQuery
