<?php



/**
 * Skeleton subclass for representing a row from the 'affiliates_level' table.
 *
 * Levels
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateLevel extends BaseAffiliateLevel {

	public function preInsert(PropelPDO $con = null) {
		$bitLevel = AffiliateLevelPeer::getUnusedBitLevel();
		if ($bitLevel !== false) {
			$this->setBitLevel($bitLevel);
			return true;
		}
		return false;
	}

	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) {
				parent::save($con);
				return true;
			}
			else
				return false;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // AffiliateLevel
