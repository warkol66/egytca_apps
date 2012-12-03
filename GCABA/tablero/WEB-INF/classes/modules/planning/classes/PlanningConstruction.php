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
	 * @return array Relacion con partidas presupuestarias
	 */
	public function getBudgetItems() {
		$planningProject = $this->getPlanningProject();
		if (empty($planningProject))
			$planningProject = new PlanningProject();
		return BaseQuery::create('BudgetRelation')->filterByObjecttype('Project')->filterByObjectid($planningProject->getId())->find();
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
	
	public function doUpdateRealDates() {
		$this->updateRealEnd();
		$this->updateRealStart();
		$this->save();
	}
	
	private function updateRealEnd() {
		
		$unfinishedActivitiesCount = BaseQuery::create('PlanningActivity')
			->filterByObjecttype('Construction')
			->filterByObjectid($this->getId())
			->filterByRealEnd(null, Criteria::ISNULL)
			->count()
		;
		if ($unfinishedActivitiesCount == 0) {
			$this->setRealend(null);
			return;
		}
		
		$lastFinishedActivity = BaseQuery::create('PlanningActivity')
			->filterByObjecttype('Construction')
			->filterByObjectid($this->getId())
			->filterByRealEnd(null, Criteria::ISNOTNULL)
			->orderByRealend(Criteria::DESC)
			->findOne()
		;
		$this->setRealend($lastFinishedActivity ? $lastFinishedActivity->getRealStart() : null);
	}
	
	private function updateRealStart() {
		
		$firstStartedActivity = BaseQuery::create('PlanningActivity')
			->filterByObjecttype('Construction')
			->filterByObjectid($this->getId())
			->filterByRealStart(null, Criteria::ISNOTNULL)
			->orderByRealstart(Criteria::ASC)
			->findOne()
		;
		
		$this->setRealstart($firstStartedActivity ? $firstStartedActivity->getRealStart() : null);
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
	
} // PlanningConstruction
