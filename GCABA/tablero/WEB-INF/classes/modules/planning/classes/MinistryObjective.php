<?php



/**
 * Skeleton subclass for representing a row from the 'planning_ministryObjective' table.
 *
 * Objetivos ministeriales
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class MinistryObjective extends BaseMinistryObjective {

	/**
	 * Devuelve true si el MinistryObjective tiene asociada la region,
	 * y false caso contrario.
	 * 
	 * @param Region $region
	 * @return boolean
	 */
	public function hasRegion($region) {
		return MinistryObjectiveRegionQuery::create()->filterByMinistryObjective($this)->filterByRegion($region)->count() > 0;
	}

} // MinistryObjective
