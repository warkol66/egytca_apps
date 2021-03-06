<?php

require_once 'BaseProject.php';

/**
 * Skeleton subclass for representing a row from the 'planning_construction' table.
 *
 * Obras
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningConstruction extends BasePlanningConstruction {

	private $baseProject;

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

	public function postSave(\PropelPDO $con = null) {
		parent::postSave($con);
		if ($this->getPlanningProject())
			$this->getPlanningProject()->doUpdateRealDates();
	}

	// TODO: Deberia reemplazar a isOnWork()????
	public function isOnExecution() {
		return ( !$this->getRealEnd() && $this->getRealStart('U') && ($this->getRealStart('U') < date('U')) )
			|| $this->hasActivitiesOnExecution();
	}

	public function hasActivitiesOnExecution() {
		foreach ($this->getActivities() as $activity) {
			if ($activity->isOnExecution())
				return true;
		}
		return false;
	}

	public function isToBeInaugurated() {
		$inaugurationDateBefore = ConfigModule::get('panel', 'inaugurationDateBefore');
		$inaugurationDateAfter = ConfigModule::get('panel', 'inaugurationDateAfter');

		return $this->getPotentialendingdate('U') > strtotime("now - $inaugurationDateBefore days")
				&& $this->getPotentialendingdate('U') < strtotime("now + $inaugurationDateAfter days");
	}

	/**
	 * Obtiene el objective asociado al project
	 */
	public function getOperativeObjective() {
		return $this->getPlanningProject()->getOperativeObjective();
	}

	/**
	 * Devuelve coleccion de objetos asociados (PlanningActivity)
	 *
	 * @return coll objetos asociados a la obra
	 */
	public function getBrood() {
		return $this->getActivities();
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
	 * Devuelve el nombre mas la particula identificatoria
	 *
	 * @return string
	 */
	public function getTreeName() {
		$pre = ConfigModule::get("planning","preTreeName");
		return $pre[get_class($this)].$this->getName();
	}

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
	 * Devuelve las versiones para el asunto ordenadas en por fecha de creacion y paginadas.
	 * @param string $orderType forma en que se ordena, Criteria::ASC = ascendente Criteria::DESC = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array Versions para el proyecto ordenados en forma decreciente por fecha de creacion.
	 */
	public function getVersionsOrderedByUpdatedPaginated($orderType = Criteria::ASC, $page=1, $maxPerPage=5) {
		$filters = array();
		return BaseQuery::create('PlanningConstructionLog')->getAllByPlanningConstruction($this->getId(), $orderType)->createPager($filters, $page, $maxPerPage);
	}

	/**
	 * Devuelve true si el PlanningConstruction tiene asociada la region,
	 * y false caso contrario.
	 *
	 * @param Region $region
	 * @return boolean
	 */
	public function hasRegion($region) {
		return ConstructionRegionQuery::create()->filterByPlanningConstruction($this)->filterByRegion($region)->count() > 0;
	}

	/**
	 * Devuelve las partidas presupuestarias
	 * @return PropelObjectCollection partidas presupuestarias
	 */
	public function getBudgetItems($criteria) {
		return BudgetRelationQuery::create(null, $criteria)->filterByConstructionObjectWithId($this->getId())->find();
	}

	/**
	 * Devuelve las actividades
	 * @return array Relacion las actividades
	 */
	public function getActivities() {
		return BaseQuery::create('PlanningActivity')->filterByObjecttype('Construction')->filterByObjectid($this->getId())->find();
	}

	/**
	 * Devuelve la cantidad de actividades
	 * @return integer Cantidad de actividades
	 */
	public function countActivities() {
		return BaseQuery::create('PlanningActivity')->filterByObjecttype('Construction')->filterByObjectid($this->getId())->count();
	}

	/**
	 * Actualiza las fechas de inicio y finalizacion reales al guardar actividades
	 */
	public function doUpdateRealDates() {
		$this->updateRealEnd();
		$this->updateRealStart();
		$this->save();
	}

	/**
	 * Actualiza las fechas de finalizacion reales al guardar actividades
	 */
	private function updateRealEnd() {

		$unfinishedActivitiesCount = BaseQuery::create('PlanningActivity')
																			->filterByObjecttype('Construction')
																			->filterByObjectid($this->getId())
																			->filterByRealend(null, Criteria::ISNULL)
																			->count();
		if ($unfinishedActivitiesCount != 0) {
			$this->setRealend(null);
			return;
		}

		$lastFinishedActivity = BaseQuery::create('PlanningActivity')
			->filterByObjecttype('Construction')
			->filterByObjectid($this->getId())
			->filterByRealend(null, Criteria::ISNOTNULL)
			->orderByRealend(Criteria::DESC)
			->findOne()
		;
		$this->setRealend($lastFinishedActivity ? $lastFinishedActivity->getRealend() : null);
	}

	/**
	 * Actualiza las fechas de inicio reales al guardar actividades
	 */
	private function updateRealStart() {

		$firstStartedActivity = BaseQuery::create('PlanningActivity')
															->filterByObjecttype('Construction')
															->filterByObjectid($this->getId())
															->filterByRealend(null, Criteria::ISNOTNULL)
															->orderByRealend(Criteria::ASC)
															->findOne();
		$this->setRealstart($firstStartedActivity ? $firstStartedActivity->getRealend() : null);
	}

	/**
	 * Devuelve array con posibles tipos de licitacion (tenderId)
	 *  id => resultado esperado
	 *
	 * @return array resultados esperados
	 */
	public static function getTenderTypes() {
		$tenderTypes = array(
			1 => 'Licitacion Publica',
			2 => 'Licitacion Privada',
			3 => 'Otros'
		);
		return $tenderTypes;
	}
	/**
	 * Devuelve array con posibles tipos de Obra (constructionType)
	 *  id => resultado esperado
	 *
	 * @return array resultados esperados
	 */
	public static function getConstructionTypes() {
		$constructionTypes = array(
			1 => 'Obras Menores',
			2 => 'Obras Mayores'
		);
		return $constructionTypes;
	}

	/**
	 * Devuelve eje de gestion (PolicyGuideline) asociado al Objetivo de Impacto
	 *
	 * @return PolicyGuideline del que se desprende el proyecto
	 */
	public function getPolicyGuideline() {
		$planningProject = $this->getPlanningProject();
		if (is_object($planningProject))
			return $planningProject->getPolicyGuideline();
		return;
	}

	/**
	 * Devuelve las actividades
	 * @return array Relacion las actividades
	 */
	public function getActivitiesOrderedForGantt() {
		return BaseQuery::create('PlanningActivity')->filterByObjecttype('Construction')->filterByObjectid($this->getId())
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
		return BaseQuery::create('PanelNote')->filterByObjecttype('PlanningConstruction')->filterByObjectid($this->getId())->find();
	}

 /**
	* Devuelve un array con las fechas para mostrar en el gantt
	* @param string $startDate fecha de referencia de inicio en formato yyyy-mm-dd
	* @param string $endDate fecha de referencia final en formato yyyy-mm-dd
	* @return array fechas para el gantt en formato yyyy-mm-dd
	*/
	public function getDatesArrayForGantt($startDate = NULL, $endDate = NULL) {

		$firstDateStr = BaseQuery::create('PlanningActivity')->filterByObjecttype('Construction')->filterByObjectid($this->getId())
														->filterByEndingdate(null, Criteria::ISNOTNULL)
														->filterByEndingdate('0000-00-00', Criteria::NOT_EQUAL)
														->orderByEndingdate()
														->select('Endingdate')
														->findOne();
		$lastDateStr = BaseQuery::create('PlanningActivity')->filterByObjecttype('Construction')->filterByObjectid($this->getId())
														->filterByEndingdate(null, Criteria::ISNOTNULL)
														->filterByEndingdate('0000-00-00', Criteria::NOT_EQUAL)
														->orderByEndingdate(Criteria::DESC)
														->select('Endingdate')
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

} // PlanningConstruction
