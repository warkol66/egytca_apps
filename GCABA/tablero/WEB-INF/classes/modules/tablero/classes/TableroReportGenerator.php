<?php

require_once('TableroIndicatorPeer.php');
require_once('TableroMilestonePeer.php');
require_once('TableroProjectPeer.php');
require_once('TableroObjectivePeer.php');
require_once('TableroRegionPeer.php');
require_once('TableroCommunePeer.php');
require_once('TableroDependencyPeer.php');

class TableroReportGenerator {

	private  $dependencyId = 0;
	private  $objectives = false;
	private  $projects = false;
	private  $projectsEnded = false;
	private  $projectsDelayed = false;
	private  $projectsWorking = false;
	private  $indicators = false;
	private  $milestones = false;
	//opciones de filtrado
	private  $dateFromExpiration;
	private  $dateToExpiration;
	private  $dateFromCreation;
	private  $dateToCreation;


	function TableroReportGenerator() {
		;
	}


	/*
	 * Devuelve el nivel de reporte requerido
	 * @return string
	 */
	function getReportLevel() {

		if ($this->indicators && $this->milestones) {
			return "indicatorsAndMilestones";
		}

		if ($this->indicators) {
			return "indicators";
		}
		if ($this->milestones) {
			return "milestones";
		}
		if ($this->projects) {
			return "projects";
		}
		if ($this->objectives) {
			return "objectives";
		}
		return "";

	}

	/**
	* Indica el id de dependencia para los cuales habra que buscar resultados
	* @param $dependencyId id
	*
	*/
	function setSearchDependencyId($dependencyId) {
		$this->dependencyId = $dependencyId;
	}
	/**
	* Indica que el reporte debera buscar hasta el nivel de Objetivos
	*/
	function setSearchObjectives() {
		$this->objectives = true;
	}

	/**
	* Indica que el reporte debera buscar hasta el nivel de Proyectos
	*/
	function setSearchProjects() {
		$this->projects = true;
	}

	/**
	* Indica que el reporte debera buscar proyectos finalizados
	*/
	function setSearchProjectsEnded() {
		$this->projectsEnded = true;
	}

	/**
	* Indica que el reporte debera buscar proyectos retrasados
	*/
	function setSearchProjectsDelayed() {
		$this->projectsDelayed = true;
	}

	/**
	* Indica que el reporte debera buscar proyectos en ejecucion
	*/
	function setSearchProjectsWorking() {
		$this->projectsWorking = true;
	}

	/**
	* Indica que el reporte debera buscar hasta el nivel de indicadores
	*/
	function setSearchIndicators() {
		$this->indicators = true;
	}

	/**
	* Indica que el reporte debera buscar hasta el nivel de hitos
	*/
	function setSearchMilestones() {
		$this->milestones = true;
	}
	/**
	 * Indica que fecha de expiracion desde para el filtro del reporte
	 * @param string
	 */
	function setSearchDateFromExpiration($dateFrom) {
		$this->dateFromExpiration = $dateFrom;
	}

	/**
	 * Indica que fecha de hasta desde para el filtro del reporte
	 * @param string
	 */
	function setSearchDateToExpiration($dateTo) {
		$this->dateToExpiration = $dateTo;
	}

	/**
	 * Indica que fecha de creacion desde para el filtro del reporte
	 * @param string
	 */
	function setSearchDateFromCreation($dateFrom) {
		$this->dateFromCreation = $dateFrom;
	}

	/**
	 * Indica que fecha de creacion hasta para el filtro del reporte
	 * @param string
	 */
	function setSearchDateToCreation($dateTo) {
		$this->dateToCreation = $dateTo;
	}


	/**
	 * Obtiene una criteria con el ordenamiento necesario para el nivel de reporte que se este pidiendo
	 *
	 * @returns Criteria una instancia de criteria con el ordenamiento correcto
	 */
	private function getCriteriaWithOrder() {

		$cond = new Criteria();
		$cond->addAscendingOrderByColumn(TableroDependencyPeer::NAME);

		if ($this->objectives || $this->projects)
			$cond->addAscendingOrderByColumn(TableroObjectivePeer::NAME);

		if ($this->projects)
			$cond->addAscendingOrderByColumn(TableroProjectPeer::NAME);

		return $cond;
	}


	/**
	 * indica si tiene condiciones hay condiciones de fecha para generar el reporte
	 * @returns boolean true si las tiene, false sino
	 */
	private function hasDateConditions() {
		return ($this->dateFromExpiration != null || $this->dateToExpiration != null || $this->dateFromCreation != null || $this->dateToCreation != null);
	}

	/**
	 * Obtiene las condiciones de filtrado de fecha para un reporte que incluye nivel de proyecto
	 * (Este es el nivel mas bajo hasta el cual se consideran las fechas)
	 *
	 * @returns Criterion Un instanacia de Criterion con las condiciones de la fecha
	 */
	private function getDateConditionsForProjectReport() {

		$cond = new Criteria();

		//condicion inicial
		if ($this->dateFromExpiration != null)
			$criterion = $cond->getNewCriterion(TableroProjectPeer::GOALEXPIRATIONDATE, $this->dateFromExpiration." 00:00:00", Criteria::GREATER_EQUAL);

		//condicion final
		if ($this->dateToExpiration != null) {

			if (!isset($criterion))
				$criterion = $cond->getNewCriterion(TableroProjectPeer::GOALEXPIRATIONDATE, $this->dateToExpiration." 00:00:00", Criteria::LESS_EQUAL);
			else
				$criterion->addAnd($cond->getNewCriterion(TableroProjectPeer::GOALEXPIRATIONDATE, $this->dateToExpiration." 00:00:00", Criteria::LESS_EQUAL));

		}

		//TODO no se toman en consideracion las fechas de creacion, ya que solo son internas al sistema
		return $criterion;

	}

	/**
	 * Obtiene las condiciones de filtrado de fecha para un reporte que incluye nivel de objetivo
	 *
	 *
	 * @returns Criterion Un instancia de Criterion con las condiciones de la fecha
	 */
	private function getDateConditionsForObjectiveReport() {

		$cond = new Criteria();

		//creacion del criterion si es a nivel de objetivos.
		if ($this->dateFromExpiration != null)
			$criterion = $cond->getNewCriterion(TableroObjectivePeer::EXPIRATIONDATE, $this->dateFromExpiration." 00:00:00", Criteria::GREATER_EQUAL);

		if ($this->dateToExpiration != null) {

			if (!isset($criterion))
				$criterion = $cond->getNewCriterion(TableroObjectivePeer::EXPIRATIONDATE, $this->dateToExpiration." 00:00:00", Criteria::LESS_EQUAL);
			else
				$criterion->addAnd($cond->getNewCriterion(TableroObjectivePeer::EXPIRATIONDATE, $this->dateToExpiration." 00:00:00", Criteria::LESS_EQUAL));

		}
		if ($this->dateFromCreation != null) {
			if (!isset($criterion))
				$criterion = $cond->getNewCriterion(TableroObjectivePeer::DATE, $this->dateFromCreation ." 00:00:00", Criteria::GREATER_EQUAL);
			else
				$criterion->addAnd($cond->getNewCriterion(TableroObjectivePeer::DATE, $this->dateFromCreation." 00:00:00", Criteria::GREATER_EQUAL));

		}
		if ($this->dateToCreation != null) {

			if (!isset($criterion))
				$criterion = $cond->getNewCriterion(TableroObjectivePeer::DATE, $this->dateToCreation." 00:00:00", Criteria::LESS_EQUAL);
			else
				$criterion->addAnd($cond->getNewCriterion(TableroObjectivePeer::DATE, $this->dateToCreation." 00:00:00", Criteria::LESS_EQUAL));

		}

		return $criterion;

	}

	/*
	 * Obtiene un Criterion de condiciones de fecha, segun el nivel de reporte requerido
	 * @returns Criterion una instancia de Criterion con las condiciones de fecha
	 */
	private function getDateConditionsCriterion() {

		//creacion del criterion si es de proyectos
		if ($this->getReportLevel() != 'objectives')
			$criterion = $this->getDateConditionsForProjectReport();
		else
			$criterion = $this->getDateConditionsForObjectiveReport();

		return $criterion;
	}

	/**
	 * Obtiene una instancia de Criteria con todas las condiciones de nivel y filtro del reporte.
	 * @returns Criteria instancia de Criteria
	 */
	private function getCriteria() {

		$cond = $this->getCriteriaWithOrder();

		if ($this->dependencyId > 0)
			$cond->add(TableroDependencyPeer::ID,$this->dependencyId);

		if ($this->projectsDelayed) {

			//no finalizado y su fecha de de finalizacion es posterior a la actual.
			$criterion = $cond->getNewCriterion(TableroProjectPeer::GOALEXPIRATIONDATE, date('Y-m-d')." 00:00:00", Criteria::LESS_EQUAL);
			$criterion->addAnd($cond->getNewCriterion(TableroProjectPeer::FINISHED,0,Criteria::EQUAL));

		}
		if ($this->projectsEnded) {
			//buscamos finalizados
			if (empty($criterion))
				$criterion = $cond->getNewCriterion(TableroProjectPeer::FINISHED,1,Criteria::EQUAL);
			else
				$criterion->addOr($cond->getNewCriterion(TableroProjectPeer::FINISHED,1,Criteria::EQUAL));

		}
		if ($this->projectsWorking) {
			//buscamos no finalizados
			if (empty($criterion))
				$criterion = $cond->getNewCriterion(TableroProjectPeer::FINISHED,0,Criteria::EQUAL);
			else
				$criterion->addOr($cond->getNewCriterion(TableroProjectPeer::FINISHED,0,Criteria::EQUAL));
		}

		if (!empty($criterion))
			$cond->addOr($criterion);

		if ($this->hasDateConditions())
			//agregamos las condiciones de fecha
			$cond->addOr($this->getDateConditionsCriterion());

		return $cond;

	}

	/**
	 * Genera un reporte segun las opciones con las cuales se ha configurado a la instancia de
	 * ReportGenerator
	 *
	 * @returns array un array de instancias de Affiliate (depenedencias) con todas las relaciones dependiendo del nivel deseado de profundidad del reporte
	 */
	public function generateReport() {

		$criteria = $this->getCriteria();

		if ($this->projectsEnded || $this->projectsDelayed || $this->projectsWorking)
			//si se pide un filtro por proyectos, se pide el detalle de proyecto
			$this->projects = true;

		if (($this->milestones == true) && ($this->indicators == true))
			return TableroDependencyPeer::doSelectJoinIndicatorMilestone($criteria);

		if ($this->milestones == true)
			return TableroDependencyPeer::doSelectJoinMilestone($criteria);

		if ($this->indicators == true)
			return TableroDependencyPeer::doSelectJoinIndicator($criteria);

		if ($this->projects == true)
			return TableroDependencyPeer::doSelectJoinProject($criteria);

		if ($this->objectives == true)
			return TableroDependencyPeer::doSelectJoinObjective($criteria);

	}

}
