<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_impactObjectiveLog' table.
 *
 * Objetivos de Impacto - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class ImpactObjectiveLogQuery extends BaseImpactObjectiveLogQuery {

	/**
	 * Obtiene todas las versiones de un objetivo de impacto a partir de su objectiveId ordenados por instante de creación.
	 *
	 * @param int $impactObjectiveId id del objetivo de impacto.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array versions correspondientes al objetivo de impacto ordenados por instante de creación.
	 */
	public function getAllByImpactObjective($impactObjectiveId, $orderType = Criteria::ASC) {
		return $this->filterByImpactobjectiveid($impactObjectiveId)->orderByUpdatedAt($orderType);
	}



} // ImpactObjectiveLogQuery
