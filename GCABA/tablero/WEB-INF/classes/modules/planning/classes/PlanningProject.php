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

	/* ******** random values for testing ******** */
	private $useRandomValues;

	private $randomAcomplished;
	private $randomCancelled;
	private $randomRealStart;
	private $randomRealEnd;
	private $randomStartingDate;
	private $randomEndingDate;

	private function randomDate($format) {
		$format = str_replace('%', '', $format);
		if (rand(0, 1)) {
			return null;
		} else {
			$sign = rand(0, 1) ? '+': '-';
			return date($format, strtotime('today '.$sign.rand(0, 365).' days'));
		}
	}

	public function getAcomplished() {
		if ($this->useRandomValues) {
			if (!isset($this->randomAcomplished))
				$this->randomAcomplished = rand(0, 1);
			return $this->randomAcomplished;
		} else {
			return parent::getAcomplished();
		}
	}

	public function getCancelled() {
		if ($this->useRandomValues) {
			if (!isset($this->randomCancelled))
				$this->randomCancelled = rand(0, 1);
			return $this->randomCancelled;
		} else {
			return parent::getCancelled();
		}
	}

	public function getRealStart($format = '%Y/%m/%d') {
		if ($this->useRandomValues) {
			if (!isset($this->randomRealStart))
				$this->randomRealStart = $this->randomDate($format);
			return $this->randomRealStart;
		} else {
			return parent::getRealStart($format);
		}
	}

	public function getRealEnd($format = '%Y/%m/%d') {
		if ($this->useRandomValues) {
			if (!isset($this->randomRealEnd))
				$this->randomRealEnd = $this->randomDate($format);
			return $this->randomRealEnd;
		} else {
			return parent::getRealEnd($format);
		}
	}

	public function getStartingDate($format = '%Y/%m/%d') {
		if ($this->useRandomValues) {
			if (!isset($this->randomStartingDate))
				$this->randomStartingDate = $this->randomDate($format);
			return $this->randomStartingDate;
		} else {
			return parent::getStartingDate($format);
		}
	}

	public function getEndingDate($format = '%Y/%m/%d') {
		if ($this->useRandomValues) {
			if (!isset($this->randomEndingDate))
				$this->randomEndingDate = $this->randomDate($format);
			return $this->randomEndingDate;
		} else {
			return parent::getEndingDate($format);
		}
	}
	/* ****** end random values for testing ****** */

	public function __construct() {
		parent::__construct();
		$this->baseProject = new BaseProject($this);
		$this->useRandomValues = ConfigModule::get('planning', 'useDemoValues');
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

	public function preSave(\PropelPDO $con = null) {
		parent::preSave($con);
		if ($this->getOrder() == 0)
			$this->setOrder(999);
		return true;
	}

	// TODO: Deberia reemplazar a isOnWork()????
	public function isOnExecution() {
		return ( !$this->getRealEnd() && $this->getRealStart('U') && ($this->getRealStart('U') < date('U')) )
			|| $this->hasPlanningConstructionsOnExecution();
	}

	public function hasPlanningConstructionsOnExecution() {
		foreach ($this->getPlanningConstructions() as $planningConstruction) {
			if ($planningConstruction->isOnExecution())
				return true;
		}
		return false;
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
	public function getBudgetItems($criteria) {
		return BudgetRelationQuery::create(null, $criteria)->filterByProjectObjectWithId($this->getId())->find();
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

		foreach ($this->baseProject->colors as $color)
			$colorsCount[$color] = 0;

		foreach ($constructions as $construction)
			$colorsCount[$construction->statusColor()]++;

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
	 * @return int $count cantidad de obras de un estado (color) determinado 
	 */
	public function countConstructionsByStatusColor($color) {
		return count($this->getConstructionsByStatusColor($color));
	}
	
	/**
	 * Devuelve verdadero si el proyecto no tiene actividades ni obras asociadas no canceladas.
	 * @param bool True si esta indefinido, false si no lo esta
	 */
	public function isUndefined() {
		if ($this->getInvestment()) {
			$constructionsCount = $this->countPlanningConstructions();
			if (!isset($this->constructionsColorsCount))
				$this->constructionsColorsCount = $this->getConstructionsByStatusColorCountAssoc();
			if ($constructionsCount === 0 || $constructionsCount === $this->constructionsColorsCount[$this->colors["cancelled"]])
				return true;
			else
				return false;  // @BR: Si tiene obras no esta indefinido
//				return $this->baseProject->isUndefined();
		}
		else
			return $this->baseProject->isUndefined();
	}

	/**
	 * Devuelve verdadero si la fecha actual es posterior a la fecha planificada de inicio y aún no se comenzó el proyecto.
	 * O bien alguna de las actividades u obras del proyecto esta retrasada.
	 * @param bool True si esta demorado, false si no lo esta
	 */
	function isDelayed() {
		if ($this->getInvestment()) {
			if (!isset($this->constructionsColorsCount))
				$this->constructionsColorsCount = $this->getConstructionsByStatusColorCountAssoc();
			if ($this->constructionsColorsCount[$this->baseProject->colors["delayed"]] > 0)
				return true;
			else
				return $this->baseProject->isDelayed();
		}
		else
			return $this->baseProject->isDelayed();
	}

	/**
	 * Devuelve verdadero si la fecha actual es posterior a la fecha planificada de finalizacion y aún no esta terminado el proyecto.
	 * O bien alguna de las actividades o construcciones del proyecto esta fuera de plazo.
	 * @param bool True si esta retrasado, false si no lo esta
	 */
	function isLate() {
		if ($this->getInvestment()) {
			if (!isset($this->constructionsColorsCount))
				$this->constructionsColorsCount = $this->getConstructionsByStatusColorCountAssoc();
			if ($this->constructionsColorsCount[$this->baseProject->colors["late"]] > 0)
				return true;
			else
				return $this->baseProject->isLate();
		}
		else
			return $this->baseProject->isLate();
	}

	/**
	 * Actualiza las fechas de inicio reales al guardar proyectos, obras o actividades
	 */
	public function doUpdateRealDates() {
		$this->updateRealEnd();
		$this->updateRealStart();
		$this->save();
	}

	/**
	 * @return boolean Whether or not the planningProject has unfinished asociated planningConstructions
	 */
	public function hasUnfinishedPlanningConstructions() {
		return BaseQuery::create('PlanningConstruction')
			->filterByPlanningProject($this)
			->filterByRealEnd(null, Criteria::ISNULL)
			->count() > 0;
	}

	/**
	 * @return boolean Whether or not the planningProject has unfinished asociated planningActivities
	 */
	public function hasUnfinishedPlanningActivities() {
		return BaseQuery::create('PlanningActivity')
								->filterByObjecttype('Project')
								->filterByObjectid($this->getId())
								->filterByRealEnd(null, Criteria::ISNULL)
								->count() > 0;
	}

	/**
	 * @return propel object  PlanningConstruction con la maxima fecha de finalizacion
	 */
	private function getLastFinishedConstruction() {
		return BaseQuery::create('PlanningConstruction')
								->filterByPlanningProject($this)
								->filterByRealEnd(null, Criteria::ISNOTNULL)
								->orderByRealend(Criteria::DESC)
								->findOne();
	}

	/**
	 * @return propel object  PlanningActivity con la maxima fecha de finalizacion
	 */
	private function getLastFinishedActivity() {
		return BaseQuery::create('PlanningActivity')
							->filterByObjecttype('Project')
							->filterByObjectid($this->getId())
							->filterByRealEnd(null, Criteria::ISNOTNULL)
							->orderByRealend(Criteria::DESC)
							->findOne();
	}

	/**
	 * Actualiza las fechas de finalizacion reales al guardar proyectos, obras o actividades
	 */
	private function updateRealEnd() {

		if ($this->getInvestment() && $this->hasUnfinishedPlanningConstructions()) {
			$this->setRealend(null);
			return;
		}

		if ($this->hasUnfinishedPlanningActivities()) {
			$this->setRealend(null);
			return;
		}

		$lastFinishedConstruction = $this->getInvestment() ? $this->getLastFinishedConstruction() : null;
		$lastFinishedActivity = $this->getLastFinishedActivity();

		if (!is_null($lastFinishedConstruction) && !is_null($lastFinishedActivity))
			$this->setRealend(max($lastFinishedConstruction->getRealend(), $lastFinishedActivity->getRealend()));
		elseif (!is_null($lastFinishedConstruction)) // && is_null($lastFinishedActivity)
			$this->setRealend($lastFinishedConstruction->getRealend());
		elseif (!is_null($lastFinishedActivity)) // && is_null($lastFinishedConstruction)
			$this->setRealend($lastFinishedActivity->getRealend());
		else // is_null($lastFinishedConstruction) && is_null($lastFinishedActivity)
			$this->setRealend(null);

	}

	/**
	 * Actualiza las fechas de inicio reales al guardar proyectos, obras o actividades
	 */
	private function updateRealStart() {

		$firstStartedConstruction = null;
		if ($this->getInvestment()) {
			$firstStartedConstruction = BaseQuery::create('PlanningConstruction')
																			->filterByPlanningProject($this)
																			->filterByRealStart(null, Criteria::ISNOTNULL)
																			->orderByRealstart(Criteria::ASC)
																			->findOne();
		}

		$firstStartedActivity = BaseQuery::create('PlanningActivity')
																->filterByObjecttype('Project')
																->filterByObjectid($this->getId())
																->filterByRealStart(null, Criteria::ISNOTNULL)
																->orderByRealstart(Criteria::ASC)
																->findOne();

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

	/**
	 * Devuelve eje de gestion (PolicyGuideline) asociado al Objetivo de Impacto
	 *
	 * @return PolicyGuideline del que se desprende el proyecto
	 */
	public function getPolicyGuideline() {
		$operativeObjective = $this->getOperativeObjective();
		if (is_object($operativeObjective)) {
			$ministryObjective = $operativeObjective->getMinistryObjective();
			if (is_object($ministryObjective)) {
				$impactObjective = $ministryObjective->getImpactObjective();
				if (is_object($impactObjective)) {
					$policyGuideline = ImpactObjective::getPolicyGuidelines();
					return $policyGuideline[$impactObjective->getPolicyGuideline()];
				}
			}
		}
		return;
	}

	/**
	 * Devuelve prioridad ministerial traducida
	 *
	 * @return string con Ministrypriority convertida a texto
	 */
	public function getMinistrypriorityTrasnlated() {
		$ministryPriorities = PlanningProject::getMinistryPriorities();
		return $ministryPriorities[$this->getMinistrypriority()];
	}

	/**
	 * Devuelve prioridad traducida
	 *
	 * @return string con Priority convertida a texto
	 */
	public function getPriorityTrasnlated() {
		$priorities = PlanningProject::getPriorities();
		return $priorities[$this->getPriority()];
	}

	/**
	 * Determina la existencia de una relacion con un determindo issue.
	 * @param $issue Object
	 */
	public function hasPlanningProjectTag($tag) {
		$projectTagQuery = PlanningProjectTagRelationQuery::create()->filterByPlanningProject($this)
												->filterByPlanningProjectTag($tag);
		return ($projectTagQuery->count() > 0);
	}

	/**
	 * Devuelve las actividades
	 * @return array Relacion las actividades
	 */
	public function getActivitiesOrderedForGantt() {
		return BaseQuery::create('PlanningActivity')->filterByObjecttype('Project')->filterByObjectid($this->getId())
									->filterByStartingdate(null, Criteria::ISNOTNULL)
									->filterByStartingdate('0000-00-00', Criteria::NOT_EQUAL)
									->filterByEndingdate(null, Criteria::ISNOTNULL)
									->filterByEndingdate('0000-00-00', Criteria::NOT_EQUAL)
									->orderByOrder()
									->orderByStartingdate()
									->find();
	}

	/**
	 * Devuelve las notas de seguimiento
	 * @return coll notas de seguimiento
	 */
	public function getPanelNotes() {
		return BaseQuery::create('PanelNote')->filterByObjecttype('PlanningProject')->filterByObjectid($this->getId())->find();
	}

 /**
	* Devuelve un array con las fechas para mostrar en el gantt
	* @param string $startDate fecha de referencia de inicio en formato yyyy-mm-dd
	* @param string $endDate fecha de referencia final en formato yyyy-mm-dd
	* @return array fechas para el gantt en formato yyyy-mm-dd
	*/
	public function getDatesArrayForGantt($startDate = NULL, $endDate = NULL) {

		$firstDateStr = BaseQuery::create('PlanningActivity')->filterByObjecttype('Project')->filterByObjectid($this->getId())
													->filterByStartingdate(null, Criteria::ISNOTNULL)
													->filterByStartingdate('0000-00-00', Criteria::NOT_EQUAL)
													->orderByStartingdate()->select('Startingdate')
													->findOne();
		$lastDateStr = BaseQuery::create('PlanningActivity')->filterByObjecttype('Project')->filterByObjectid($this->getId())
													->filterByEndingdate(null, Criteria::ISNOTNULL)
													->filterByEndingdate('0000-00-00', Criteria::NOT_EQUAL)
													->orderByEndingdate(Criteria::DESC)->select('Endingdate')
													->findOne();

		if (!is_null($startDate) && $startDate < $firstDateStr)
			$firstDateStr = $startDate;
		if (!is_null($endDate) && $endDate > $lastDateStr)
			$lastDateStr = $endDate;

		$firstDate = new DateTime($firstDateStr);
		$lastDate = new DateTime($lastDateStr);
		if ($firstDate->format('Y-m') == $lastDate->format('Y-m'))
			$firstDate->modify('-1 month');

		while ($firstDate <= $lastDate) {
			$dates = Common::findFirstAndLastDay($firstDate->format('Y-m-d'));
			$datesArray[] = $dates;
			$firstDate = DateTime::createFromFormat('Y-m-d', $dates["last"]);
			$firstDate->modify('+1 day');
		}

		return $datesArray;
	}

} // PlanningProject
