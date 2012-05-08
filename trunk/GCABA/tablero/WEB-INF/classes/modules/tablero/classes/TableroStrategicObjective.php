<?php


/**
 * Skeleton subclass for representing a row from the 'tablero_strategicObjective' table.
 *
 * Strategic Objective
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroStrategicObjective extends BaseTableroStrategicObjective {

	/** the default item name for this class */
	const ITEM_NAME = 'Strategic Objective';

	/**
	 * Entrega el nombre de la dependecia
	 * @return nombre 
	 */	 
	function getDependencyName() {
		$dependency = TableroDependencyPeer::get($this->getAffiliateId());
		return $dependency->getName();
	}

	/**
	 * Entrega el nombre de la dependecia
	 * @return cantidad de objetivos asociados al objetivo estratégico 
	 */	 
	function getObjectivesCount() {
		$objectives = TableroObjectiveQuery::create()->filterByStrategicobjectiveid($this->getId())->count();
		return $objectives;
	}

	/**
	 * Entrega el nombre de la dependecia
	 * @return cantidad de objetivos asociados a la dependencia 
	 */	 
	function getObjectiveCountByDependency() {
		$dependency = TableroDependencyPeer::get($this->getAffiliateId());
		$objectives = TableroObjectiveQuery::create()->filterByAffiliateid($this->getAffiliateId())->count();
		return $objectives;
	}

} // TableroStrategicObjective
