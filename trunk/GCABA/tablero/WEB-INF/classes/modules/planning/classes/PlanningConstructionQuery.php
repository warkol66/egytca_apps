<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_construction' table.
 *
 * Obras
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningConstructionQuery extends BasePlanningConstructionQuery {

 /**
	* Agrega filtros por issue y sus descendientes
	*
	* @param   type integer $positionCode code del Position
	* @return condicion de filtrado por position y descendientes
	*/
	public function broodPositions($positionCode) {
		$position = PositionQuery::create()->findOneByCode($positionCode);
		return $this->filterByPosition($position->getBranch());
	}

} // PlanningConstructionQuery
