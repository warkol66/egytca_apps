<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_projectLog' table.
 *
 * Proyectos - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningProjectLogQuery extends BasePlanningProjectLogQuery {

	/**
	 * Obtiene todas las versiones de un objetivo operativo a partir de su operativeObjectiveId ordenados por instante de creación.
	 *
	 * @param int $operativeObjectiveId id del objetivo de operativo.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array versions correspondientes al objetivo operativo ordenados por instante de creación.
	 */
	public function getAllByPlanningProject($planningProjectId, $orderType = Criteria::ASC) {
		return $this->filterByProjectid($planningProjectId)->orderByUpdatedAt($orderType);
	}

} // PlanningProjectLogQuery
