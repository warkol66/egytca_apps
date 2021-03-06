<?php



/**
 * Skeleton subclass for representing a row from the 'planning_projectLog' table.
 *
 * Proyectos - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningProjectLog extends BasePlanningProjectLog {

	/**
	 * Devuelve un string con quien modifico el Proyecto (PlanningProject)
	 *
	 * @return string nombre del usuario que modifico el Proyecto
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
	 * Devuelve los indicadores asociados (PlanningProject)
	 *
	 * @return PropelObjectCollection|PlanningIndicator[] Objetos indicadores asociados
	 */
	public function getPlanningIndicators() {
		return PlanningIndicatorQuery::create()
									->usePlanningIndicatorRelationQuery()
										->filterByPlanningobjecttype('PlanningProject')
										->filterByPlanningobjectid($this->getPlanningprojectid())
									->endUse()
									->find();
	}


	/**
	 * Devuelve los indicadores asociados (PlanningProject)
	 *
	 * @return PropelObjectCollection|PlanningIndicator[] Objetos indicadores asociados
	 */
	public function countPlanningConstructions() {
		return PlanningConstructionQuery::create()
							->filterByPlanningprojectid($this->getProjectid())
							->find();
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
	public function getAllByPlanningProject($planningProjectId, $orderType = Criteria::ASC) {
		 return $this->filterByProjectid($planningProjectId)->orderByUpdatedAt($orderType);
	}

	/**
	 * Devuelve las partidas presupuestarias
	 * @return array Relacion con partidas presupuestarias
	 */
	public function getBudgetItems() {
		return BaseQuery::create('BudgetRelation')->filterByObjecttype('Project')->filterByObjectid($this->getProjectid())->find();
	}

	/**
	 * Devuelve las actividades
	 * @return array Relacion las actividades
	 */
	public function getActivities() {
		return BaseQuery::create('PlanningActivity')->filterByObjecttype('Project')->filterByObjectid($this->getProjectid())->find();
	}

	/**
	 * Devuelve el objeto (OperativeObjective) del que se desprende el proyecto
	 *
	 * @return OperativeObjective del que se desprende el proyecto
	 */
	public function getAntecessor() {
		return $this->getOperativeObjective();
	}

	/**
	 * Devuelve el InternalCode del proyecto
	 *
	 * @return string codigo de proyecto
	 */
	public function getStringCode() {
		$antecessor = $this->getAntecessor();
		if (is_object($antecessor)) {
			return str_pad($antecessor->getInternalCode(), 2, "00", STR_PAD_LEFT) . "." . str_pad($this->getInternalCode(), 2, "00", STR_PAD_LEFT);
		}
		else
			return "00.00.00." . str_pad($this->getInternalCode(), 2, "00", STR_PAD_LEFT);
	}

} // PlanningProjectLog
