<?php



/**
 * Skeleton subclass for representing a row from the 'planning_impactObjective' table.
 *
 * Objetivos de Impacto
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class ImpactObjective extends BaseImpactObjective {
	
	/**
	 * Devuelve coleccion de objetos asociados (MinistryObjective)
	 *
	 * @return coll objetos asociados al objetivo
	 */
	public function getBrood() {
		return $this->getMinistryObjectives();
	}

	/**
	 * Devuelve el objeto (Position) del que se desprende el objetivo de impacto
	 *
	 * @return Position del que se desprende el objetivo de impacto
	 */
	public function getAntecessor() {
		return $this->getPosition();
	}

	/**
	 * Devuelve el InternalCode 
	 *
	 * @return Codigo
	 */
	public function getStringCode() {

		return str_pad($this->getInternalCode(),2,"00",STR_PAD_LEFT);

	}
	/**
	 * Devuelve el nombre mas la particula identificatoria
	 *
	 * @return string
	 */
	public function getTreeName() {
		$pre = ConfigModule::get("planning","preTreeName");
		return $pre[get_class($this)].$this->getName();
	}

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
	 * Devuelve las versiones para el asunto ordenadas en por fecha de creación y paginadas.
	 * @param string $orderType forma en que se ordena, Criteria::ASC = ascendente Criteria::DESC = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array Versions para el proyecto ordenados en forma decreciente por fecha de creación.
	 */
	public function getVersionsOrderedByUpdatedPaginated($orderType = Criteria::ASC, $page=1, $maxPerPage=5) {
		$filters = array();
		return BaseQuery::create('ImpactObjectiveLog')->getAllByImpactObjective($this->getId(), $orderType)->createPager($filters, $page, $maxPerPage);
	}

	/**
	 * Devuelve los indicadores asociados (PlanningIndicators)
	 *
	 * @return PropelObjectCollection|PlanningIndicator[] Objetos indicadores asociados
	 */
	public function getPlanningIndicators() {
		return PlanningIndicatorQuery::create()
									->usePlanningIndicatorRelationQuery()
										->filterByPlanningobjecttype('ImpactObjective')
										->filterByPlanningobjectid($this->getId())
									->endUse()
									->find();
	}

	/**
	 * Devuelve array con posibles ejes de gestion (PolicyGuidelines)
	 *  id => ejes de gestion
	 *
	 * @return array ejes de gestion
	 */
	public static function getPolicyGuidelines() {
		$policyGuidelines = array(
			1 => 'Ciudad Verde',
			2 => 'Ciudad Moderna / Participación Ciudadana / Futuro',
			3 => 'Buenos Aires Ciudad de Todos los Argentinos',
			4 => 'Jóvenes / Educación',
			5 => 'Vida Sana /Salud',
			6 => 'Realización Personal / Vulnerables'

		);
		return $policyGuidelines;
	}

	/**
	 * Devuelve array con posibles resultados esperados (ExpectedResult)
	 *  id => resultado esperado
	 *
	 * @return array resultados esperados
	 */
	public static function getExpectedResults() {
		$expectedResults = array(
			1 => 'Incrementar',
			2 => 'Descender',
			3 => 'Acelerar',
			4 => 'Desacelerar',
			5 => 'Sostener',
			6 => 'Conservar',
			7 => 'Mantener'
		);
		return $expectedResults;
	}



} // ImpactObjective
