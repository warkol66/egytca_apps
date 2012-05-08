<?php


/**
 * Skeleton subclass for representing a row from the 'regions_timezones' table.
 *
 * Regiones y Zonas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.regions.classes
 */
class RegionTimezone extends BaseRegionTimezone {

	/** the default item name for this class */
	const ITEM_NAME = 'Region Timezone';

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

} // RegionTimezone
