<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_operativeObjectiveLog' table.
 *
 * Objetivos operativos - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class OperativeObjectiveLogQuery extends BaseOperativeObjectiveLogQuery {

	/**
	 * Obtiene todas las versiones de un objetivo operativo a partir de su operativeObjectiveId ordenados por instante de creaci�n.
	 *
	 * @param int $operativeObjectiveId id del objetivo de operativo.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array versions correspondientes al objetivo operativo ordenados por instante de creaci�n.
	 */
	public function getAllByOperativeObjective($operativeObjectiveId, $orderType = Criteria::ASC) {
		return $this->filterByOperativeobjectiveid($operativeObjectiveId)->orderByUpdatedAt($orderType);
	}


} // OperativeObjectiveLogQuery
