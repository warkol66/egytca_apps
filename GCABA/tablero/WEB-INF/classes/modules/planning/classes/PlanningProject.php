<?php



/**
 * Skeleton subclass for representing a row from the 'planning_project' table.
 *
 * Proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningProject extends BasePlanningProject {
	
	/**
	 * Devuelve coleccion de objetos asociados (PlanningActivity)
	 *
	 * @return coll objetos asociados al proyecto
	 */
	public function getBrood() {
		$constructionQuery = PlanningConstructionQuery::create()->filterByPlanningProject($this);
		$activitiesQuery = BaseQuery::create('PlanningActivity')->filterByObjecttype('Project')->filterByObjectid($this->getId());
		if ($constructionQuery->count() > 0)
	    $brood = $constructionQuery->find();
	   else
	    $brood = $activitiesQuery->find();
		return $brood;
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
	 * Devuelve el InternalCode del objetivo Operativo
	 *
	 * @return Codigo
	 */
	public function getStringCode() {

		$antecessor= $this->getAntecessor();
		$code=str_pad($antecessor->getStringCode(),2,"00",STR_PAD_LEFT);
		return $code.".".str_pad($this->getInternalCode(),2,"00",STR_PAD_LEFT);

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
	 * Devuelve un string con quien modifico el Proyecto (PlanningProject)
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
	 * Devuelve los indicadores asociados (PlanningProject)
	 *
	 * @return PropelObjectCollection|PlanningIndicator[] Objetos indicadores asociados
	 */
	public function getPlanningIndicators() {
		return PlanningIndicatorQuery::create()
									->usePlanningIndicatorRelationQuery()
										->filterByPlanningobjecttype('PlanningProject')
										->filterByPlanningobjectid($this->getId())
									->endUse()
									->find();
	}

	/**
	 * Devuelve las versiones para el proyecto ordenadas en por fecha de creacion y paginadas.
	 * @param string $orderType forma en que se ordena, Criteria::ASC = ascendente Criteria::DESC = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return PropelPager|PlanningProjectLog[] Objetos versiones de proyecto ordenados y pagina
	 */
	public function getVersionsOrderedByUpdatedPaginated($orderType = Criteria::ASC, $page=1, $maxPerPage=5) {
		$filters = array();
		return BaseQuery::create('PlanningProjectLog')->getAllByPlanningProject($this->getId(), $orderType)->createPager($filters, $page, $maxPerPage);
	}

	/**
	 * Devuelve las partidas presupuestarias
	 * @return array Relacion con partidas presupuestarias
	 */
	public function getBudgetItems() {
		return BaseQuery::create('BudgetRelation')->filterByObjecttype('Project')->filterByObjectid($this->getId())->find();
	}

	/**
	 * Devuelve las actividades
	 * @return array Relacion las actividades
	 */
	public function getActivities() {
		return BaseQuery::create('PlanningActivity')->filterByObjecttype('Project')->filterByObjectid($this->getId())->find();
	}

	/**
	 * Devuelve la cantidad de actividades
	 * @return integer Cantidad de actividades
	 */
	public function countActivities() {
		return BaseQuery::create('PlanningActivity')->filterByObjecttype('Project')->filterByObjectid($this->getId())->count();
	}

	/**
	 * Devuelve array con posibles prioridades ministeriales
	 *  id => prioridad
	 *
	 * @return array Prioridades Ministeriales
	 */
	public static function getMinistryPriorities() {
		$ministryPriorities = array(
			1 => 'Alta',
			2 => 'Media',
			3 => 'Baja'
		);
		return $ministryPriorities;
	}
	/**
	 * Devuelve array con posibles prioridades de Jefatura
	 *  id => prioridad de jefatura
	 *
	 * @return array Prioridades  de Jefatura
	 */
	public static function getPriorities() {
		$priorities = array(
			1 => 'A+',
			2 => 'A',
			3 => 'B',
			4 => 'C'
		);
		return $priorities;
	}

} // PlanningProject
