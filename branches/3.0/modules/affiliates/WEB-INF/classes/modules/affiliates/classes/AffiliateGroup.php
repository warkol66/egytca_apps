<?php



/**
 * Skeleton subclass for representing a row from the 'affiliates_group' table.
 *
 * Groups
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateGroup extends BaseAffiliateGroup {

	/**
	* Obtiene las categorias que puede acceder un grupos de usuarios.
	*
	* Existe para compatibilidad hacia atras.
	* @return array GroupCategories
	*/
	function getCategories() {
		return $this->getCategorys();
	}

	/**
	* Obtiene las categorias que no puede acceder un grupos de usuarios.
	*
	* @return array Categories
	*/
	function getNotAssignedCategories() {
		$obj = CategoryQuery::create()->join('AffiliateGroupCategory', Criteria::LEFT_JOIN)
									->where('AffiliateGroupCategory.Groupid <> ?', $this->getId())
									->orWhere('AffiliateGroupCategory.Groupid IS NULL')
									->find();
		return $obj;
	}

	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) {
				parent::save($con);
				return true;
			} else {
				return false;
			}
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // AffiliateGroup
