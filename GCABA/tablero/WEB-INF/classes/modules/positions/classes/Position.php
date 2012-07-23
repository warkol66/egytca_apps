<?php


/**
 * Skeleton subclass for representing a row from the 'positions_position' table.
 *
 * Cargos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.positions.classes
 */
class Position extends BasePosition {

	private $colors;
	private $colorsCount;
	
	function __construct() {
		parent::__construct();
		global $system;
		$this->colors = $system["config"]["tablero"]["colors"];
	}
	
	public function getChildren() {
		return $this->getImpactObjectives();
	}
	
	/**
	* Obtiene el nombre del padre de un position.
	*
	* @return array Informacion del position
	*/
	function getParentName() {
		$parent = $this->getParent();
		if (!empty($parent))
			return $parent->getName();
		else
			return;
	}

	/**
	* Obtiene el nombre del padre de un position.
	*
	* @return array Informacion del position
	*/
	function getParentId() {
		$parent = $this->getParent();
		if (!empty($parent))
			return $parent->getId();
		else
			return -1;
	}

	/**
	* Obtiene el nombre traducido fel tipo de position.
	*
	* @return array tipos de position
	*/
	function getPositionTypeTranslated() {
		$type = $this->getType();

		$positionTypes = PositionPeer::getPositionTypes();
		$positionTypeName = $positionTypes[$type];
		$positionTypeNameTranslated = Common::getTranslation($positionTypeName,'positions');
		return $positionTypeNameTranslated;

	}

	public function getActiveTenure() {
		$criteria = new Criteria();
		$criteria->add(PositionTenurePeer::DATETO,null);
		$tenures = $this->getPositionTenures($criteria);
		if (count($tenures) == 0) {
			$tenure = new PositionTenure();
			$tenure->setPosition($this);
		} else {
			$tenure = $tenures[0];
		}
		return $tenure;
	}

	public function getActiveTenureName() {
		$criteria = new Criteria();
		$criteria->add(PositionTenurePeer::DATETO,null);
		$tenures = $this->getPositionTenures($criteria);
		if (count($tenures) == 0) {
			$tenure = new PositionTenure();
			$tenure->setPosition($this);
		}
		else
			$tenure = $tenures[0];

		if ($tenure->getUserId() > 0)
			$tenure = UserQuery::create()->findOneById($tenure->getUserId());

		return $tenure;
	}

	public function getPositionTenure($tenureId) {
		$criteria = new Criteria();
		$criteria->add(PositionTenurePeer::ID,$tenureId);
		$tenures = $this->getPositionTenures($criteria);
		if (count($tenures) == 0)
			$tenure = null;
		else
			$tenure = $tenures[0];

		return $tenure;
	}

	public function createTenure($params) {
		//agrego la relacion con position
		$params["positionCode"] = $this->getCode();
		return PositionTenurePeer::create($params);
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
	* Obtiene el color acorde al estado
	* @return string $colors nombre del color que representa el estado
	*/
	function statusColor() {
		
		// el uso de este metodo nos asegura recorrer los proyectos de la position una unica vez por consulta.
		if (!isset($this->colorsCount))
			$this->colorsCount = $this->getProjectByStatusColorCountAssoc();	
		
		if ($this->isLate())
			return $colors["late"];
		if ($this->isDelayed2())
			return $colors["delayed"];
		return $colors["onTime"];

	}

 /**
	* Obtiene si la posicion tiene sus proyectos en tiempo
	* @return boolean si tiene proyectos en tiempo
	*/
	function isOnTime() {
		return (!$this->isDelayed2 && !$this->isLate());
	}

 /**
	* Obtiene si la posicion tiene sus proyectos retrasados
	* @return boolean si tiene proyectos retrasados
	*/
	function isDelayed2() {
		if (!isset($this->colorsCount))
			$this->colorsCount = $this->getProjectByStatusColorCountAssoc();
		return ($this->colorsCount[$this->colors["delayed"]] > 0);
	}

 /**
	* Obtiene si la posicion tiene sus proyectos fuera de término
	* @return boolean si tiene proyectos fuera de término
	*/
	function isLate() {
		if (!isset($this->colorsCount))
			$this->colorsCount = $this->getProjectByStatusColorCountAssoc();
		return ($this->colorsCount[$this->colors["late"]] > 0);
	}

 /**
	* @Deprecated
	* 
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
	* Obtiene la velocidad de la position
	* @return int $speed velocidad de la position
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
	* Obtiene el entero de 10 en 10 de la clase de velocidad de la position
	* @return int $class entero de 10 en 10 para la clase de la velocidad de la position
	*/
	public function getSpeedClass() {
		$speed = $this->getSpeed();
		$class = round($speed / 10) * 10;
		return $class;

	}
	
	/*
	* Obtiene los proyectos asignadas a la position con un determinado status color.
	*
	* @return array Projects
	*/
	public function getProjectsByStatusColor($color) {
		$projects = $this->getAllProjectsWithDescendants();
		$filteredProjects = array();
		foreach ($projects as $project) {
			if ($project->isOfStatusColor($color)) {
				$filteredProjects[] = $project;
			}
		}
		return $filteredProjects;
	}
	
	/*
	* Obtiene la cantidad de projects asignados al position con un determinado status color.
	*
	* @return int $count
	*/
	public function getProjectsByStatusColorCount($color) {
		return getProjectsByStatusColor($color)->count();
	}
	
	/*
	* Obtiene un array asociativo con la cantidad de projects asignados al position por cada color.
	*
	* @return array $colorsCount.
	*/
	public function getProjectsByStatusColorCountAssoc() {
		$projects = $this->getAllProjectsWithDescendants();
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
	
	/*
	* Obtiene todas los projects asociados a la instancia.
	*
	* @param Criteria $query, criteria para aplicar a los proyectos.
	* 
	* @return PropelCollection $projects
	*/
	public function getAllProjectsWithDescendants($query = null) {
		$positionCodes = array();
		$positionCodes[] = $this->getCode();
		if ($this->hasChildren()){
			$descendants = $this->getDescendants();
			foreach ($descendants as $descendant)
				$positionCodes[] = $descendant->getCode();
		}
		$projects = ProjectQuery::create(null, $query)->findByResponsibleCode($positionCodes);
		
		return $projects;
	}
	
	/*
	* Obtiene la cantidad total de projects asociados a la instancia.
	* 
	* @param Criteria $query, criteria para aplicar a los proyectos.
	*
	* @return int $count
	*/
	public function getAllProjectsCountWithDescendants($query = null) {
		$positionCodes = array();
		$positionCodes[] = $this->getCode();
		if ($this->hasChildren()){
			$descendants = $this->getDescendants();
			foreach ($descendants as $descendant)
				$positionCodes[] = $descendant->getCode();
		}
		$count = ProjectQuery::create(null, $query)->filterByResponsibleCode($positionCodes)->count();
		
		return $count;
	}
	
	/*
	* Obtiene todas los objectives asociados a la instancia.
	* 
	* @param Criteria $query, criteria para aplicar a los objetivos.
	* 
	* @return PropelCollection $objectives
	*/
	public function getAllObjectivesWithDescendants($query = null) {
		$positionCodes = array();
		$positionCodes[] = $this->getCode();
		if ($this->hasChildren()){
			$descendants = $this->getDescendants();
			foreach ($descendants as $descendant)
				$positionCodes[] = $descendant->getCode();
		}
		$objectives = ObjectiveQuery::create(null, $query)->findByResponsibleCode($positionCodes);
		
		return $objectives;
	}
	
	/*
	* Obtiene la cantidad total de objectives asociados a la instancia.
	* 
	* @param Criteria $query, criteria para aplicar a los objetivos.
	*
	* @return int $count
	*/
	public function getAllObjectivesCountWithDescendants($query = null) {
		$positionCodes = array();
		$positionCodes[] = $this->getCode();
		if ($this->hasChildren()){
			$descendants = $this->getDescendants();
			foreach ($descendants as $descendant)
				$positionCodes[] = $descendant->getCode();
		}
		$count = ObjectiveQuery::create(null, $query)->filterByResponsibleCode($positionCodes)->count();
		
		return $count;
	}
	
	/*
	* Obtiene todas los projects asociados a la instancia.
	*
	* @return PropelCollection $projects
	*/
	public function getAllProjects() {
		return ProjectQuery::create()->findByResponsibleCode($this->getCode());
	}
	
	/*
	* Obtiene la cantidad total de projects asociados a la instancia.
	*
	* @return int $count
	*/
	public function getAllProjectsCount() {
		return ProjectQuery::create()->filterByResponsibleCode($this->getCode())->count();
	}
	
	/*
	* Obtiene todas los objectives asociados a la instancia.
	*
	* @return PropelCollection $objectives
	*/
	public function getAllObjectives() {
		return ObjectiveQuery::create()->findByResponsibleCode($this->getCode());
	}
	
	/*
	* Obtiene la cantidad total de objectives asociados a la instancia.
	*
	* @return int $count
	*/
	public function getAllObjectivesCount() {
		return ObjectiveQuery::create()->filterByResponsibleCode($this->getCode())->count();		
	}
	
	/*
	* Obtiene un array asociativo con el total ponderado de projects asignados al position por cada color.
	*
	* @return array $colorsCount.
	*/
	public function getProjectsByStatusColorWeightedByPriorityAssoc() {
		$projects = $this->getAllProjectsWithDescendants();
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
	
	/**
	 * Redefinimos el método para que el userGroupId se setee en todos los descendientes.
	 * 
	 * @param int $userGroupId
	 */
	public function setUserGroupId($userGroupId) {
		if (empty($userGroupId) || $userGroupId <= 0)
			$userGroupId = NULL;
		parent::setUserGroupId($userGroupId);
		foreach ($this->getChildren() as $child) {
			$child->setUserGroupId($userGroupId)->save();
		}
		return $this;
	}	
} // Position
