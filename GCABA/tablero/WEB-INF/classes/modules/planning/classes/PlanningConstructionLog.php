<?php



/**
 * Skeleton subclass for representing a row from the 'planning_constructionLog' table.
 *
 * Obras - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningConstructionLog extends BasePlanningConstructionLog {

	/**
	 * Devuelve un string con quien modifico la obra (PlanningConstruction)
	 *
	 * @return string nombre del usuario que modifico la obra
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
	 * Devuelve las partidas presupuestarias
	 * @return array Relacion con partidas presupuestarias
	 */
	public function getBudgetItems() {
		$planningProject = $this->getPlanningProject();
		return BaseQuery::create('BudgetRelation')->filterByObjecttype('Project')->filterByObjectid($planningProject->getId())->find();
	}

	/**
	 * Devuelve las actividades
	 * @return array Relacion las actividades
	 */
	public function getActivities() {
		return BaseQuery::create('PlanningActivity')->filterByObjecttype('Construction')->filterByObjectid($this->getConstructionid())->find();
	}

	/**
	 * Devuelve el objeto (PlanningProject) del que se desprende la obra
	 *
	 * @return PlanningProject del que se desprende la obra
	 */
	public function getAntecessor() {
		return $this->getPlanningProject();
	}

	/**
	 * Devuelve las partidas presupuestarias
	 * @return array Relacion con partidas presupuestarias
	 */
	public function getConstructionProgresss() {
		return BaseQuery::create('ConstructionProgress')->filterByConstructionId($this->getConstructionid())->find();
	}


	/**
	 * Obtiene todas las versiones de un asunto a partir de su planningConstructionId ordenados por instante de creacion y paginados.
	 *
	 * @param int $planningConstructionId id del objetivo ministerial.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array versions correspondientes al asunto ordenados por instante de creacion.
	 */
	public function getAllByPlanningConstruction($planningConstructionId, $orderType = Criteria::ASC) {
		return $this->filterByPlanningconstructionid($planningConstructionId)->orderByUpdatedAt($orderType);
	}

} // PlanningConstructionLog
