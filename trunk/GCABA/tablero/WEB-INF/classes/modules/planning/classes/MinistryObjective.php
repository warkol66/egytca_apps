<?php



/**
 * Skeleton subclass for representing a row from the 'planning_ministryObjective' table.
 *
 * Objetivos ministeriales
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class MinistryObjective extends BaseMinistryObjective {

	/**
	 * Devuelve coleccion de objetos asociados (OperativeObjective)
	 *
	 * @return coll objetos asociados al objetivo
	 */
	public function getBrood() {
		return $this->getOperativeObjectives();
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
	 * Devuelve el nombre mas la particula identificatoria
	 *
	 * @return string
	 */
	public function getTreeName() {
		$pre = ConfigModule::get("planning","preTreeName");
		return $pre[get_class($this)].$this->getName();
	}

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
	 * Devuelve las versiones para el asunto ordenadas en por fecha de creacion y paginadas.
	 * @param string $orderType forma en que se ordena, Criteria::ASC = ascendente Criteria::DESC = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array Versions para el proyecto ordenados en forma decreciente por fecha de creacion.
	 */
	public function getVersionsOrderedByUpdatedPaginated($orderType = Criteria::ASC, $page=1, $maxPerPage=5) {
		$filters = array();
		return BaseQuery::create('MinistryObjectiveLog')->getAllByMinistryObjective($this->getId(), $orderType)->createPager($filters, $page, $maxPerPage);
	}

	/**
	 * Devuelve los indicadores asociados (MinistryObjective)
	 *
	 * @return PropelObjectCollection|PlanningIndicator[] Objetos indicadores asociados
	 */
	public function getPlanningIndicators() {
		return PlanningIndicatorQuery::create()
									->usePlanningIndicatorRelationQuery()
										->filterByPlanningobjecttype('MinistryObjective')
										->filterByPlanningobjectid($this->getId())
									->endUse()
									->find();
	}

	/**
	 * Devuelve true si el MinistryObjective tiene asociada la region,
	 * y false caso contrario.
	 *
	 * @param Region $region
	 * @return boolean
	 */
	public function hasRegion($region) {
		return MinistryObjectiveRegionQuery::create()->filterByMinistryObjective($this)->filterByRegion($region)->count() > 0;
	}

	/**
	 * Devuelve array con posibles ejes de gestion (PolicyGuidelines)
	 *  id => ejes de gestion
	 *
	 * @return array ejes de gestion
	 */
	public static function getPolicyGuidelines() {
		$policyGuidelines = array(
			1 => 'Fortalecimiento de las pol�ticas de promoci�n social, salud y educaci�n',
			2 => 'Seguridad',
			3 => 'Movilidad sustentable'
		);
		return $policyGuidelines;
	}
	/**
	 * Devuelve array con posibles tipos de Meta
	 *  id => tipo de meta
	 *
	 * @return array tipos de Meta
	 */
	public static function getGoalTypes() {
		$goalTypes = array(
			1 => 'Cualitativa',
			2 => 'Cuantitativa'
		);
		return $goalTypes;
	}
	/**
	 * Devuelve array con posibles tendencias de Meta
	 *  id => tendencias de meta
	 *
	 * @return array Tendencias de Meta
	 */
	public static function getGoalTrends() {
		$goalTrends = array(
			1 => 'Ascendente',
			2 => 'Descendente'
		);
		return $goalTrends;
	}

} // MinistryObjective
