<?php



/**
 * Skeleton subclass for representing a row from the 'clients_group' table.
 *
 * Groups
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.clients.classes
 */
class ClientGroup extends BaseClientGroup {

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
		$obj = CategoryQuery::create()->join('ClientGroupCategory', Criteria::LEFT_JOIN)
									->where('ClientGroupCategory.Groupid <> ?', $this->getId())
									->orWhere('ClientGroupCategory.Groupid IS NULL')
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

} // ClientGroup
