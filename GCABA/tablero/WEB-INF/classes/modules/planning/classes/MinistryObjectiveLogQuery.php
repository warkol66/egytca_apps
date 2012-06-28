<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_ministryObjectiveLog' table.
 *
 * Objetivos ministeriales - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class MinistryObjectiveLogQuery extends BaseMinistryObjectiveLogQuery {

	/**
	 * Obtiene todas las versiones de un objetivo de impacto a partir de su ministryObjectiveId ordenados por instante de creación.
	 *
	 * @param int $impactObjectiveId id del objetivo ministerial.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array versions correspondientes al objetivo ministerial ordenados por instante de creación.
	 */
	public function getAllByMinistryObjective($ministryObjectiveId, $orderType = Criteria::ASC) {
		return $this->filterByMinistryobjectiveid($ministryObjectiveId)->orderByUpdatedAt($orderType);
	}

} // MinistryObjectiveLogQuery
