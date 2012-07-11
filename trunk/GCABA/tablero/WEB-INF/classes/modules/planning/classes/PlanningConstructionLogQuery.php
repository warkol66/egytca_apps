<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_constructionLog' table.
 *
 * Obras - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningConstructionLogQuery extends BasePlanningConstructionLogQuery {

	/**
	 * Obtiene todas las versiones de un objetivo de impacto a partir de su planningConstructionId ordenados por instante de creaci�n.
	 *
	 * @param int $impactObjectiveId id del objetivo ministerial.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array versions correspondientes al objetivo ministerial ordenados por instante de creaci�n.
	 */
	public function getAllByPlanningConstruction($planningConstructionId, $orderType = Criteria::ASC) {
		return $this->filterByConstructionid($planningConstructionId)->orderByUpdatedAt($orderType);
	}

} // PlanningConstructionLogQuery
