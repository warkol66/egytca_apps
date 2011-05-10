<?php


/**
 * Skeleton subclass for representing a row from the 'objectives_strategic' table.
 *
 * Strategic Objective
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.objectives.classes
 */
class StrategicObjective extends BaseStrategicObjective {

	/** the default item name for this class */
	const ITEM_NAME = 'Strategic Objective';
	
	private $toLog;
	private $minorChange;

	/**
	 * Entrega el nombre de la dependecia
	 * @return nombre 
	 */	 
	function getDependencyName() {
		$dependency = TableroDependencyPeer::get($this->getAffiliateId());
		return $dependency->getName();
	}

	/**
	 * Entrega la cantidad de objetivos asociados al objetivo estratégico
	 * @return cantidad de objetivos asociados al objetivo estratégico 
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
	 * Devuelve el nombre del Eje de Gestión
	 *
	 *	@return string
	 */
	public function getPolicyGuideline(){
		$policyGuidelineId = $this->getPolicyGuidelineId();
		$$policyGuideline = "";

		if ($policyGuidelineId > 0)
			$policyGuideline = PolicyGuidelineQuery::create()->findOneById($policyGuidelineId);//findOneById($policyGuidelineId);

		if (empty($policyGuideline))
			$policyGuideline = new PolicyGuideline();

		return $policyGuideline->getName();
	}

	/**
	 * Entrega la cantidad de objetivos asociados al eje de gestión
	 * @return cantidad de objetivos asociados al objetivo estratógico 
	 */	 
	function getPolicyGuidelinesCount() {
		$guidelines = StrategicObjectiveQuery::create()->filterByPolicyGuidelinesid($this->getId())->count();
		return $guidelines;
	}

	/**
	 * Devuelve los logs para el objetivo ordenados en forma decreciente por fecha de creación.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @return array Logs para el objetivo ordenados en forma decreciente por fecha de creación.
	 */
	public function getLogsOrderedByUpdated($orderType = 'asc') {
		$objectiveLogPeer = new StrategicObjectiveLogPeer();
		return $objectiveLogPeer->getAllByObjectiveIdOrderedByUpdated($this->getId(), $orderType);
	}
	
	/**
	 * Devuelve los logs para el objetivo ordenados en forma decreciente por fecha de creación y paginados.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array Logs para el objetivo ordenados en forma decreciente por fecha de creación.
	 */
	public function getLogsOrderedByUpdatedPaginated($orderType = 'asc', $page=1, $maxPerPage=5) {
		$objectiveLogPeer = new StrategicObjectiveLogPeer();
		return $objectiveLogPeer->getAllByObjectiveIdOrderedByUpdatedPaginated($this->getId(), $orderType, $page, $maxPerPage);
	}
	
	public function getLogCount() {
		return StrategicObjectiveLogQuery::create()->filterByStrategicId($this->getId())->count();
	}

	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) { 
				parent::save($con);
				return true;
			} else {
				return false;
			}
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	public function setMinorChange($expr = true) {
		$this->minorChange = $expr;
	}
	
	public function hasToLog() {
		return ((ConfigModule::get("objectives","useLogs")) && !$this->isNew() &&
			 (((ConfigModule::get("objectives","useMinorChanges")) && !$this->minorChange ) ||
			 (!ConfigModule::get("objectives","useMinorChanges"))));
	}
	
	public function setToLog($objectLog) {
		$this->toLog = $objectLog;
	}

	public function postUpdate($con = null) {
		if ($this->hasToLog() && $this->toLog != null) {
			$objectLog = $this->toLog;
			$objectLog->setId(NULL);
			$objectLog->setStrategicId($this->getId());
			$objectLog->setUpdated(time());
			try {
				$objectLog->save();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
		}		
	}
	
	public function preUpdate($con =null) {		
		$this->setUpdated(time());
		//$this->setLastModification(time());
		$changes = $this->getChanges() + 1;
		$this->setChanges($changes);
		return true;
	}
	
	public function hasAnyDisbursementIndicator() {
		$indicatorsCount = ProjectQuery::create()->filterByStrategicObjectiveId($this->getId())
												 ->select('Indicatorid')
												 ->where('Indicatorid IS NOT NULL')
												 ->count();
		return $indicatorsCount > 0;
	}

	/**
	 * Obtiene todos los proyectos que estén debajo del objetivo estratégico.
	 * @return PropelCollection, los proyectos asociados con este eje de gestió.
	 */
	public function getAllProjects() {
		$projects = ProjectQuery::create()->join('Project.Objective')
							  			  ->join('Objective.StrategicObjective')
							  			  ->where('StrategicObjective.Id = ?', $this->getId())
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



	/**
	 * Devuelve la información de navegación para listados
	 *
	 *	@return array información de navegación hacia arriba
	 */
	public function getParentLinkPath() {
		$parentLinkInfo = array();

		$policyGuidelineId = $this->getPolicyGuidelineId();
		$policyGuideline = PolicyGuidelineQuery::create()->findOneById($policyGuidelineId);

		if(!empty($policyGuideline)){
			$parentLinkInfo['parentLink'] = "objectivesStrategicObjectivesList&filters[fromGuidelines]=true&filters[guideline]=";
			$parentLinkInfo['parentObject'] = $policyGuideline;
			$parentLinkInfo['parentId'] = $policyGuidelineId;
			return $parentLinkInfo;
		}
		else
			return;
	}

} // StrategicObjective
