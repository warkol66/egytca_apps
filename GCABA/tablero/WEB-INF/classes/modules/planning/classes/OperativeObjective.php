<?php

require_once 'BaseObjective.php';

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
	
	private $baseObjective;
	
	public function __construct() {
		parent::__construct();
		$this->baseObjective = new BaseObjective($this);
	}
	
	public function __call($name, $params) {
		try {
			return parent::__call($name, $params);
		} catch (Exception $e) {
			if (method_exists($this->baseObjective, $name))
				return call_user_func_array(array($this->baseObjective, $name), $params);
			else
				throw $e;
		}
	}
	
	/**
	 * Obtiene los proyectos asociados al objective
	 */
	public function getAllProjects() {
		$projects = array();
		foreach ($this->getPlanningProjects() as $planningProject) {
			$projects []= $planningProject;
			$projects = array_merge($projects, $planningProject->getAllProjects()->getArrayCopy());
		}
		return new PropelObjectCollection($projects);
	}

	/**
	 * Devuelve coleccion de objetos asociados (PlanningProjects)
	 *
	 * @return coll objetos asociados al obejtivo
	 */
	public function getBrood() {
		return $this->getPlanningProjects();
	}

	/**
	 * Devuelve el objeto (MinistryObjective) del que se desprende el objetivo operativo
	 *
	 * @return MinistryObjective del que se desprende el objetivo operativo
	 */
	public function getAntecessor() {
		return $this->getMinistryObjective();
	}

	/**
	 * Devuelve el InternalCode del objetivo Operativo
	 *
	 * @return string Codigo del Objetivo Operativo
	 */
	public function getStringCode() {
		$antecessor = $this->getAntecessor();
		if (is_object($antecessor)) {
			return str_pad($antecessor->getInternalCode(), 2, "00", STR_PAD_LEFT) . "." . str_pad($this->getInternalCode(), 2, "00", STR_PAD_LEFT);
		}
		else
			return "00.00." . str_pad($this->getInternalCode(), 2, "00", STR_PAD_LEFT);
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
			2 => 'Varón'
		);
		return $populationGender;
	}

} // OperativeObjective
