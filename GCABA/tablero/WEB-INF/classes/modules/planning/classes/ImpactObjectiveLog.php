<?php



/**
 * Skeleton subclass for representing a row from the 'planning_impactObjectiveLog' table.
 *
 * Objetivos de Impacto - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class ImpactObjectiveLog extends BaseImpactObjectiveLog {

	/**
	 * Devuelve un string con quien modifico el Objetivo de Impacto (ImpactObjective)
	 *
	 * @return string nombre del usuario que modifico el Objetivo de Impacto
	 */
	public function updatedBy() {
		if ($this->getUserobjecttype() != "") {
			$objectQueryName = $this->getUserobjecttype() . 'Query';
			if (class_exists($objectQueryName)) {
				$query = BaseQuery::create($this->getUserobjecttype());
				return $query->findPK($this->getUserobjectid());
			}
		}
		return;
	}

	/**
	 * Devuelve los indicadores asociados (PlanningIndicators)
	 *
	 * @return Coll indicadores asociados
	 */
	public function getPlanningIndicators() {
		return BaseQuery::create("PlanningIndicatorRelation")->filterByPlanningobjecttype('ImpactObjective')->filterByPlanningobjectid($this->getImpactobjectiveid())->find();
	}

	/**
	 * Obtiene todas las versiones de un asunto a partir de su objectiveId ordenados por instante de creaci�n y paginados.
	 *
	 * @param int $issueId id del asunto.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array versions correspondientes al asunto ordenados por instante de creaci�n.
	 */
	public function getAllByImpactObjective($impactObjectiveId, $orderType = Criteria::ASC) {
		return $this->filterByImpactobjectiveid($impactObjectiveId)->orderByUpdatedAt($orderType);
	}


} // ImpactObjectiveLog
