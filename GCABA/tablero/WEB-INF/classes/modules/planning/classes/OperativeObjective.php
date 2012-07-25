<?php



/**
 * Skeleton subclass for representing a row from the 'planning_operativeObjective' table.
 *
 * Objetivos operativos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class OperativeObjective extends BaseOperativeObjective {
	
	public function getBrood() {
		return $this->getPlanningProjects();
	}

	/**
	 * Devuelve un string con quien modifico el Objetivo Operativo (OperativeObjective)
	 *
	 * @return string nombre del usuario que modifico el Objetivo Operativo
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
										->filterByPlanningobjectid($this->getId())
									->endUse()
									->find();
	}

	/**
	 * Devuelve las versiones para el asunto ordenadas en por fecha de creación y paginadas.
	 * @param string $orderType forma en que se ordena, Criteria::ASC = ascendente Criteria::DESC = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array Versions para el proyecto ordenados en forma decreciente por fecha de creación.
	 */
	public function getVersionsOrderedByUpdatedPaginated($orderType = Criteria::ASC, $page=1, $maxPerPage=5) {
		$filters = array();
		return BaseQuery::create('OperativeObjectiveLog')->getAllByOperativeObjective($this->getId(), $orderType)->createPager($filters, $page, $maxPerPage);
	}

	/**
	 * Devuelve array con posibles productos organizacionales (ProductKinds)
	 *  id => productos organizacionales
	 *
	 * @return array productos organizacionales
	 */
	public static function getProductKinds() {
		$productKinds = array(
			1 => 'Producción Externa',
			2 => 'Producción Organizacional',
			3 => 'Producción Interna'
		);
		return $productKinds;
	}

	/**
	 * Devuelve array con posibles generos (PopulationGender)
	 *  id => generos
	 *
	 * @return array generos
	 */
	public static function getPopulationGender() {
		$populationGender = array(
			0 => 'No aplica',
			1 => 'Mujer',
			2 => 'Hombre'
		);
		return $populationGender;
	}

} // OperativeObjective
