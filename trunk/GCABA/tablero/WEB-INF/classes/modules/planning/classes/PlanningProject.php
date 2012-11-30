<?php

require_once 'BaseProject.php';

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
	
	private $baseProject;
	private $constructionsColorsCount;
	
	public function __construct() {
		parent::__construct();
		$this->baseProject = new BaseProject($this);
	}
	
	public function __call($name, $params) {
		try {
			return parent::__call($name, $params);
		} catch (Exception $e) {
			if (method_exists($this->baseProject, $name))
				return call_user_func_array(array($this->baseProject, $name), $params);
			else
				throw $e;
		}
	}
	
	/**
	 * Obtiene los proyectos (constructions) asociados al project
	 */
	public function getAllProjects() {
		return $this->getPlanningConstructions();
	}

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
	 * Obtiene un array asociativo con la cantidad de constructions asignadas al proyecto por cada color.
	 *
	 * @return array $colorsCount.
	 */
	public function getConstructionsByStatusColorCountAssoc() {
		$constructions = $this->getPlanningConstructions();
		$colorsCount = array();

		foreach ($this->baseProject->colors as $color) {
			$colorsCount[$color] = 0;
		}

		foreach ($constructions as $construction) {
			$color = $construction->statusColor();
			$colorsCount[$color]++;
		}

		return $colorsCount;
	}
	
	/**
	 * Obtiene los constructions asignadas al proyecto con un determinado status color.
	 *
	 * @return PropelObjectCollection Constructions
	 */
	public function getConstructionsByStatusColor($color) {
		$constructions = $this->getPlanningConstructions();
		$filteredConstructions = new PropelObjectCollection();
		foreach ($constructions as $construction) {
			if ($construction->isOfStatusColor($color)) {
				$filteredConstructions->append($construction);
			}
		}
		return $filteredConstructions;
	}

	/**
	 * Obtiene la cantidad de constructions asignadas al proyecto con un determinado status color.
	 *
	 * @return int $count
	 */
	public function countConstructionsByStatusColor($color) {
		return count($this->getConstructionsByStatusColor($color));
	}
	
	/**
	 * Devuelve verdadero si el proyecto no tiene actividades ni obras asociadas no canceladas.
	 */
	public function isUndefined() {
		
		$constructionsCount = $this->countPlanningConstructions();

		if (!isset($this->constructionsColorsCount))
			$this->constructionsColorsCount = $this->getConstructionsByStatusColorCountAssoc();

		if ($constructionsCount === 0 || $constructionsCount === $this->constructionsColorsCount[$this->colors["cancelled"]])
			return true;
		else
			return $this->baseProject->isUndefined();
	}
	
	/**
	 * Devuelve verdadero si la fecha actual es posterior a la fecha planificada de inicio y aún no se comenzó el proyecto.
	 * O bien alguna de las actividades u obras del proyecto esta retrasada.
	 */
	function isDelayed() {

		if (!isset($this->constructionsColorsCount))
			$this->constructionsColorsCount = $this->getConstructionsByStatusColorCountAssoc();
		
		if ($this->constructionsColorsCount[$this->baseProject->colors["delayed"]] > 0)
			return true;
		else
			return $this->baseProject->isDelayed();
	}
	
	/**
	 * Devuelve verdadero si la fecha actual es posterior a la fecha planificada de finalizacion y aún no esta terminado el proyecto.
	 * O bien alguna de las actividades o construcciones del proyecto esta fuera de plazo.
	 */
	function isLate() {
		
		if (!isset($this->constructionsColorsCount))
			$this->constructionsColorsCount = $this->getConstructionsByStatusColorCountAssoc();
		
		if ($this->constructionsColorsCount[$this->baseProject->colors["late"]] > 0)
			return true;
		else
			return $this->baseProject->isLate();
	}
	
	public function doUpdateRealDates() {
		$this->updateRealEnd();
		$this->updateRealStart();
		$this->save();
	}
	
	private function updateRealEnd() {
		
		// if any construction is unfinished, project is unfinished
		$unfinishedConstructionsCount = BaseQuery::create('PlanningConstruction')
			->filterByPlanningProject($this)
			->filterByRealEnd(null, Criteria::ISNULL)
			->count()
		;
		if ($unfinishedConstructionsCount == 0) {
			$this->setRealend(null);
			return;
		}

		// if any activity is unfinished, project is unfinished
		$unfinishedActivitiesCount = BaseQuery::create('PlanningActivity')
			->filterByObjecttype('Project')
			->filterByObjectid($this->getId())
			->filterByRealEnd(null, Criteria::ISNULL)
			->count()
		;
		if ($unfinishedActivitiesCount == 0) {
			$this->setRealend(null);
			return;
		}

		$lastFinishedConstruction = BaseQuery::create('PlanningConstruction')
			->filterByPlanningProject($this)
			->filterByRealEnd(null, Criteria::ISNOTNULL)
			->orderByRealend(Criteria::DESC)
			->findOne()
		;

		$lastFinishedActivity = BaseQuery::create('PlanningActivity')
			->filterByObjecttype('Project')
			->filterByObjectid($this->getId())
			->filterByRealEnd(null, Criteria::ISNOTNULL)
			->orderByRealend(Criteria::DESC)
			->findOne()
		;
		
		if (!is_null($lastFinishedConstruction) && !is_null($lastFinishedActivity))
			$this->setRealend(max($lastFinishedConstruction->getRealend(), $lastFinishedActivity->getRealend()));
		elseif (!is_null($lastFinishedConstruction)) // && is_null($lastFinishedActivity)
			$this->setRealend($lastFinishedConstruction->getRealend());
		elseif (!is_null($lastFinishedActivity)) // && is_null($lastFinishedConstruction)
			$this->setRealend($lastFinishedActivity->getRealend());
		else // is_null($lastFinishedConstruction) && is_null($lastFinishedActivity)
			$this->setRealend(null);
		
	}
	
	private function updateRealStart() {
		
		$firstStartedConstruction = BaseQuery::create('PlanningConstruction')
			->filterByPlanningProject($this)
			->filterByRealStart(null, Criteria::ISNOTNULL)
			->orderByRealstart(Criteria::ASC)
			->findOne()
		;
		
		$firstStartedActivity = BaseQuery::create('PlanningActivity')
			->filterByObjecttype('Project')
			->filterByObjectid($this->getId())
			->filterByRealStart(null, Criteria::ISNOTNULL)
			->orderByRealstart(Criteria::ASC)
			->findOne()
		;
		
		if (!is_null($firstStartedConstruction) && !is_null($firstStartedActivity))
			$this->setRealstart(min($firstStartedConstruction->getRealStart(), $firstStartedActivity->getRealStart()));
		elseif (!is_null($firstStartedConstruction)) // && is_null($firstStartedActivity)
			$this->setRealstart($firstStartedConstruction->getRealStart());
		elseif (!is_null($firstStartedActivity)) // && is_null($firstStartedConstruction)
			$this->setRealstart($firstStartedActivity->getRealStart());
		else // is_null($firstStartedConstruction) && is_null($firstStartedActivity)
			$this->setRealstart(null);
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
