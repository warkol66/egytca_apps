<?php



/**
 * Skeleton subclass for representing a row from the 'planning_ministryObjectiveLog' table.
 *
 * Objetivos ministeriales - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class MinistryObjectiveLog extends BaseMinistryObjectiveLog {

	/**
	 * Devuelve un string con quien modifico el Objetivo Ministerial (MinistryObjective)
	 *
	 * @return string nombre del usuario que modifico el Objetivo Ministerial
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
	 * Devuelve los indicadores asociados (MinistryObjective)
	 *
	 * @return Coll indicadores asociados
	 */
	public function getPlanningIndicators() {
		return PlanningIndicatorQuery::create()
									->usePlanningIndicatorRelationQuery()
										->filterByPlanningobjecttype('MinistryObjective')
										->filterByPlanningobjectid($this->getMinistryobjectiveid())
									->endUse()
									->find();
	}

	/**
	 * Devuelve el objeto (ImpactObjective) del que se desprende el objetivo ministerial
	 *
	 * @return ImpactObjective del que se desprende el objetivo ministerial
	 */
	public function getAntecessor() {
		return $this->getImpactObjective();
	}

	/**
	 * Devuelve el InternalCode del objetivo ministerial
	 *
	 * @return string con codigo del objetivo ministerial
	 */
	public function getStringCode() {
		$antecessor = $this->getAntecessor();
		if (is_object($antecessor)) {
			return str_pad($antecessor->getInternalCode(), 2, "00", STR_PAD_LEFT) . "." . str_pad($this->getInternalCode(), 2, "00", STR_PAD_LEFT);
		}
		else
			return "00." . str_pad($this->getInternalCode(), 2, "00", STR_PAD_LEFT);
	}

	/**
	 * Devuelve true si el MinistryObjective tiene asociada la region,
	 * y false caso contrario.
	 * 
	 * @param Region $region
	 * @return boolean
	 */
	public function hasRegion($region) {
		return MinistryObjectiveRegionQuery::create()->filterByMinistryobjectiveid($this->getMinistryobjectiveid())->filterByRegion($region)->count() > 0;
	}

	/**
	 * Obtiene todas las versiones de un asunto a partir de su ministryObjectiveId ordenados por instante de creaci�n y paginados.
	 *
	 * @param int $ministryObjectiveId id del objetivo ministerial.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array versions correspondientes al asunto ordenados por instante de creaci�n.
	 */
	public function getAllByMinistryObjective($ministryObjectiveId, $orderType = Criteria::ASC) {
		return $this->filterByMinistryobjectiveid($ministryObjectiveId)->orderByUpdatedAt($orderType);
	}

} // MinistryObjectiveLog
