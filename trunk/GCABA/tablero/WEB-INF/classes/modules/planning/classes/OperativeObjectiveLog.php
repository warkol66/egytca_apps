<?php



/**
 * Skeleton subclass for representing a row from the 'planning_operativeObjectiveLog' table.
 *
 * Objetivos operativos - Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class OperativeObjectiveLog extends BaseOperativeObjectiveLog {

	/**
	 * Devuelve un string con quien modifico el Objetivo Operativo (OperativeObjective)
	 *
	 * @return string nombre del usuario que modifico el proyecto
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
	 * Devuelve los indicadores asociados (OperativeObjective)
	 *
	 * @return PropelObjectCollection|PlanningIndicator[] Objetos indicadores asociados
	 */
	public function getPlanningIndicators() {
		return PlanningIndicatorQuery::create()
									->usePlanningIndicatorRelationQuery()
										->filterByPlanningobjecttype('OperativeObjective')
										->filterByPlanningobjectid($this->getOperativeobjectiveid())
									->endUse()
									->find();
	}

} // OperativeObjectiveLog
