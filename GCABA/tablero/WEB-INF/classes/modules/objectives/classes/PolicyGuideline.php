<?php


/**
 * Skeleton subclass for representing a row from the 'objectives_policyGuideline' table.
 *
 * Policy Guidelines
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.objectives.classes
 */
class PolicyGuideline extends BasePolicyGuideline {

	/** the default item name for this class */
	const ITEM_NAME = 'Policy Guideline';
	
	private $colors;
	private $colorsCount;
	
	function __construct() {
		parent::__construct();
		global $system;
		$this->colors = $system["config"]["tablero"]["colors"];
	}

	/**
	* Modificaciones a datos previos a guardar un project
	* @param $con conexión a la base de datos
	*/
	public function preSave($con =null) {		
		if (method_exists($this,"setUserId"))
			$this->setUserId($_SESSION["loginUser"]->getId());
		return true;
	}

	/**
	 * Entrega el nombre de la dependecia
	 * @return nombre 
	 */	 
	function getDependencyName() {
		$dependency = TableroDependencyPeer::get($this->getAffiliateId());
		return $dependency->getName();
	}

	/**
	 * Entrega el nombre de la dependecia
	 * @return cantidad de objetivos asociados al objetivo estrat�gico 
	 */	 
	function getObjectivesCount() {
		$objectives = ObjectiveQuery::create()->filterByStrategicobjectiveid($this->getId())->count();
		return $objectives;
	}

	/**
	 * Entrega el nombre de la dependecia
	 * @return cantidad de objetivos asociados a la dependencia 
	 */	 
	function getObjectiveCountByDependency() {
		$dependency = TableroDependencyPeer::get($this->getAffiliateId());
		$objectives = ObjectiveQuery::create()->filterByAffiliateid($this->getAffiliateId())->count();
		return $objectives;
	}

 /**
	* Obtiene la velocidad de la policyGuideline
	* @return int $speed velocidad de la policyGuideline
	*/
	public function getSpeed() {
		$colorsWeight = $this->getProjectsByStatusColorWeightedByPriorityAssoc();
		$colorsCount = $this->getProjectsByStatusColorCountAssoc();
		
		$totalProjects = $colorsCount['red'] + $colorsCount['yellow'] + $colorsCount['green'] + $colorsCount['blue'] + $colorsCount['black'] + $colorsCount['white'];
		$totalWeight = $colorsWeight['red'] + $colorsWeight['yellow'] + $colorsWeight['green'] + $colorsWeight['blue'] + $colorsWeight['black'] + $colorsWeight['white'];
		
		$speed = round((1 - (( $colorsWeight['red']*2 + $colorsWeight['yellow'] ) / ($totalWeight) ))*100);

		if ($speed < 0) 
			$speed = 0;

		return $speed;
	}

 /**
	* Obtiene el entero de 10 en 10 de la clase de velocidad de la policyGuideline
	* @return int $class entero de 10 en 10 para la clase de la velocidad de la policyGuideline
	*/
	public function getSpeedClass() {
		$speed = $this->getSpeed();
		$class = round($speed / 10) * 10;
		return $class;
	}
	
//////////////
// Funciones para tablero, relacion con objetivos

	//mapea un status a la llamada del metodo que indica que estado tiene
	 private $objectiveStatus = array(
						'delayed'=>'isDelayed',
						'ended'=>'isEnded',
						'working'=>'isOnWork',
						'OnTime'=>'isOnTime',
						'Delayed'=>'isDelayed2',
						'Late'=>'isLate',
						'Canceled'=>'isCanceled'
		);

 /**
	* Obtiene el color acorde al estado de un objetivo
	* @return string $colors nombre del color a utilizar para cada estado de objetivos
	*/
	function statusColor() {
		global $system;
		$colors = $system["config"]["tablero"]["colors"];
		if ($this->isOnTime())
			return $colors["onTime"];
		if ($this->isDelayed2())
			return $colors["delayed"];
		if ($this->isLate())
			return $colors["late"];
		if ($this->isCanceled())
			return $colors["canceled"];
	}

 /**
	* Obtiene si la posicion tiene sus objetivos en tiempo
	* @return boolean si tiene objetivos en tiempo
	*/
	function isOnTime() {
		return ($this->getCountObjectivesDelayed() == 0 && $this->getCountObjectivesLate() == 0);
	}

 /**
	* Obtiene si la posicion tiene sus objetivos retrasados
	* @return boolean si tiene objetivos retrasados
	*/
	function isDelayed2() {
		return ($this->getCountObjectivesDelayed() != 0 && $this->getCountObjectivesLate() == 0);
	}

 /**
	* Obtiene si la posicion tiene sus objetivos demorados
	* @return boolean si tiene objetivos demorados
	*/
	function isLate() {
		return ($this->getCountObjectivesLate() != 0);
	}

 /**
	* Obtiene si la posicion tiene sus objetivos cancelados
	* @return boolean si tiene objetivos cancelados
	*/
	function isCanceled() {
		return ($this->getCountObjectivesCanceled() != 0);
	}

 /**
	* Obtiene la cantidad de objetivos por estado
	* @params string $status estado que se va a contar
	* @return int $count cantidad de objetivos en el estado solicitado
	*/
	private function countNumberObjectives($status) {

		//busco la llamada a hacer
		$method = $this->objectiveStatus[$status];

		$count = 0;

		foreach ($this->getObjectives() as $objective) {
			if ($objective->$method())
				$count++;
		}

		return $count;

	}

 /**
	* Obtiene los objetivos por estado
	* @params string $status tipo de estado que se va a obtener
	* @return int $count cantidad de objetivos en el estado solicitado
	*/
	private function getObjectivesByStatus($status) {

		//busco la llamada a hacer
		$method = $this->objectiveStatus[$status];

		$objectives = array(); //objetivos a devolver

		foreach ($this->getObjectives() as $objective) {
			if ($objective->$method())
				$objectives[] = $objective;
		}

		return $objectives;

	}
	/**
	* Obtiene la cantidad de objetivos en tiempo de la dependencia. Los objetivos en tiempo son los que poseen a todos sus proyectos en tiempo.
	*
	* @return int Cantidad de objetivos en tiempo.
	*/
	function getCountObjectivesOnTime() {
		return $this->countNumberObjectives('OnTime');
	}

	/**
	* Obtiene la cantidad de objetivos retrazados de la dependencia. Los objetivos retrazados son los que poseen algunos de sus proyectos retrazados y ninguno demorado.
	*
	* @return int Cantidad de objetivos retrazados.
	*/
	function getCountObjectivesDelayed() {
		return $this->countNumberObjectives('Delayed');
	}

	/**
	* Obtiene la cantidad de objetivos demorados de la dependencia. Los objetivos demorados son los que poseen algunos de sus proyectos demorados.
	*
	* @return int Cantidad de objetivos demorados.
	*/
	function getCountObjectivesLate() {
		return $this->countNumberObjectives('Late');
	}

	/**
	* Obtiene la cantidad de objetivos cancelados de la dependencia. Los objetivos cancelados son los que poseen algunos de sus proyectos demorados.
	*
	* @return int Cantidad de objetivos demorados.
	*/
	function getCountObjectivesCanceled() {
		return $this->countNumberObjectives('Canceled');
	}

	/**
	* Obtiene los objetivos en tiempo de la dependencia. Los objetivos en tiempo son los que poseen a todos sus proyectos en tiempo.
	*
	* @return array Objetivos en tiempo.
	*/
	function getObjectivesOnTime() {
		return $this->getObjectivesByStatus('OnTime');
	}

	/**
	* Obtiene los objetivos retrazados de la dependencia. Los objetivos retrazados son los que poseen algunos de sus proyectos retrazados y ninguno demorado.
	*
	* @return array Objetivos retrazados.
	*/
	function getObjectivesDelayed() {
		return $this->getObjectivesByStatus('Delayed');
	}

	/**
	* Obtiene los objetivos demorados de la dependencia. Los objetivos demorados son los que poseen algunos de sus proyectos demorados.
	*
	* @return array Objetivos demorados.
	*/
	function getObjectivesLate() {
		return $this->getObjectivesByStatus('Late');
	}

	/**
	* Obtiene los objetivos cancelados de la dependencia. Los objetivos demorados son los que poseen algunos de sus proyectos cancelados.
	*
	* @return array Objetivos cancelados.
	*/
	function getObjectivesCanceled() {
		return $this->getObjectivesByStatus('Canceled');
	}
	
	/**
	 * Obtiene todos los proyectos que estén debajo del eje de gestión.
	 * @return PropelCollection, los proyectos asociados con este eje de gestión.
	 */
	public function getAllProjects() {
		$projects = ProjectQuery::create()->join('Project.Objective')
							  			  ->join('Objective.StrategicObjective')
							  			  ->join('StrategicObjective.PolicyGuideline')
							  			  ->where('PolicyGuideline.Id = ?', $this->getId())
							  			  ->find();
		return $projects;
	}
	
	/**
	 * Obtiene un array asociativo con la cantidad de projects asignados al policyGuideline por cada color.
	 *
	 * @return array $colorsCount.
	 */
	public function getProjectsByStatusColorCountAssoc() {
		$projects = $this->getAllProjects();
		$colorsCount = array();
		foreach($projects as $project) {
			$color = $project->statusColor();
			if (!isset($colorsCount[$color]))
				$colorsCount[$color] = 1;
			else
				$colorsCount[$color] ++; 
		}
		// me aseguro de setear el resto de los colores disponibles que no hayan sido inicializados
		foreach($this->colors as $color) {
			if (!isset($colorsCount[$color]))
				$colorsCount[$color] = 0;
		}
		return $colorsCount;
	}
	
	/**
	 * Obtiene los proyectos asignadas a la policyGuideline con un determinado status color.
	 *
	 * @return array Projects
	 */
	public function getProjectsByStatusColor($color) {
		$projects = $this->getAllProjects();
		$filteredProjects = array();
		foreach ($projects as $project) {
			if ($project->isOfStatusColor($color)) {
				$filteredProjects[] = $project;
			}
		}
		return $filteredProjects;
	}
	
	/**
	 * Obtiene la cantidad de projects asignados al policyGuideline con un determinado status color.
	 *
	 * @return int $count
	 */
	public function getProjectsByStatusColorCount($color) {
		return getProjectsByStatusColor($color)->count();
	}
	
	/**
	 * Obtiene un array asociativo con el total ponderado de projects asignados al position por cada color.
	 *
	 * @return array $colorsCount.
	 */
	public function getProjectsByStatusColorWeightedByPriorityAssoc() {
		$projects = $this->getAllProjects();
		$colorsCount = array();
		foreach($projects as $project) {
			$color = $project->statusColor();
			if (!isset($colorsCount[$color]))
				$colorsCount[$color] = $project->getWeightBasedOnPriority();
			else
				$colorsCount[$color] += $project->getWeightBasedOnPriority(); 
		}
		// me aseguro de setear el resto de los colores disponibles que no hayan sido inicializados
		foreach($this->colors as $color) {
			if (!isset($colorsCount[$color]))
				$colorsCount[$color] = 0;
		}
		return $colorsCount;
	}
	
	public function hasAnyDisbursementIndicator() {
		$indicatorsCount = ProjectQuery::create()->filterByPolicyGuidelineId($this->getId())
												 ->select('Indicatorid')
												 ->where('Indicatorid IS NOT NULL')
												 ->count();
		return $indicatorsCount > 0;
	}
	
	public function getMonthsArray() {
		$monthsArray = array();
		$startingMonth = $this->getStartingYear() . "-01";
		$endingMonth = $this->getEndingYear(). "-12";

		while ($endingMonth > $startingMonth) {
			$month = array();
			$month["startingDate"] = $startingMonth . "-01";
			$month["endingDate"] = $startingMonth . "-" . date("t",mktime(1,0,0,substr($startingMonth,5,2),1,substr($startingMonth,0,4)));
			array_push($monthsArray,$month);
			$startingMonth = date("Y-m",mktime(1,0,0,substr($startingMonth,5,2)+1,1,substr($startingMonth,0,4)));
		}
		return $monthsArray;

	}

	/**
	 * Devuelve la información de navegación para listados
	 *
	 *	@return array información de navegación hacia arriba
	 */
	public function getParentLinkPath() {
		return null;
	}

} // PolicyGuideline
