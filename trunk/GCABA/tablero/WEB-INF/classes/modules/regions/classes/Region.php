<?php


/**
 * Skeleton subclass for representing a row from the 'regions_regions' table.
 *
 * Regiones
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.regions.classes
 */
class Region extends BaseRegion {

	/** the default item name for this class */
	const ITEM_NAME = 'Region';

	/**
	* Obtiene el nombre del padre de un region.
	*
	* @return array Informacion del region
	*/
	function getParentName()
	{
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getName();
		}
		else
			return;
	}

	/**
	* Obtiene el nombre del padre de un region.
	*
	* @return array Informacion del region
	*/
	function getParentId()
	{
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getId();
		}
		else
			return;
	}

	/**
	* Obtiene el nombre traducido fel tipo de region.
	*
	* @return array tipos de region
	*/
	function getRegionTypeTranslated()
	{
		$type = $this->getType();

		$regionTypes = RegionPeer::getRegionTypes();
		$regionTypeName = $regionTypes[$type];
		$regionTypeNameTranslated = Common::getTranslation($regionTypeName,'regions');
		return $regionTypeNameTranslated;

	}
	
	/**
	 * Devuelve las partidas presupuestarias
	 * @return PropelObjectCollection partidas presupuestarias
	 */
	function getBudgetItems($criteria) {
		return BudgetRelationQuery::create(null, $criteria)->filterByBudgetgeolocation($this->getOldid())->find();
	}

} // Region
