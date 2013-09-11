<?php
/**
 * PlanningSpeedDataAction
 *
 * Listado de Obras (PlanningSpeedDataAction)
 *
 * @package    planning
 * @subpackage    planningSpeedDataAction
 */

class PlanningSpeedDataAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Position');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";

	}

	protected function postList() {
		parent::postList();

		$this->results = PositionQuery::create()->find();
		foreach($this->results as $position) {

			$colorsWeight = $position->getProjectsByStatusColorWeightedByPriorityAssoc();
			$colorsCount = $position->getProjectsByStatusColorCountAssoc();
			
			$totalProjects = $colorsCount['red'] + $colorsCount['yellow'] + $colorsCount['green'] + $colorsCount['blue'] + $colorsCount['black'] + $colorsCount['white'];
			$totalWeight = $colorsWeight['red'] + $colorsWeight['yellow'] + $colorsWeight['green'] + $colorsWeight['blue'] + $colorsWeight['black'] + $colorsWeight['white'];
			
			$speed = round((1 - (( $colorsWeight['red']*2 + $colorsWeight['yellow'] ) / ($totalWeight) ))*100);
	
			if ($totalProjects > 0) {
				echo "<strong>Cargo: " . $position . "<br />Velocidad: " . $speed . "</strong><br />";
				echo "<strong>Cantidad de proyectos: " .$totalProjects. "</strong></br>";
				echo "rojos: " . $colorsCount['red'] ." - amarillos: ". $colorsCount['yellow'] ." - verdes: ". $colorsCount['green'] ." azules: ". $colorsCount['blue'] ." - negros: ". $colorsCount['black'] ." - blancos: ". $colorsCount['white'];
				echo "<strong></br>Pesos ponderados: " .$totalWeight. "</strong></br>";
				echo "rojos: " . $colorsWeight['red'] ." - amarillos: ". $colorsWeight['yellow'] ." - verdes: ". $colorsWeight['green'] ." azules: ". $colorsWeight['blue'] ." - negros: ". $colorsWeight['black'] ." - blancos: ". $colorsWeight['white'];
				echo "</br></br></br>";
			}
		}
		die;
	}
}
