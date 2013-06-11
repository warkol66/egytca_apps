<?php

/**
 * Clase base de manejo de proyectos y obras
 *
 *
 * @package    planning.classes
 */

class BaseProject {

	private $child;
	public $colors;
	public $colorsCount;

	const CRITICAL    = 1;
	const HIGH        = 2;
	const MEDIUM_HIGH = 3;
	const MEDIUM      = 4;

	//nombre de los tipos de prioridad
	protected static $priorityTypes = array(
		self::CRITICAL      => 'Crítica',
		self::HIGH          => 'Alta',
		self::MEDIUM_HIGH   => 'Media alta',
		self::MEDIUM        => 'Media'
	);

	/**
	 * Devuelve el peso del proyecto basado en la prioridad. Devuelve 1 si no tiene una prioridad valida.
	 * @param integer Peso especifico basado en prioridad
	 */
	public function getWeightBasedOnPriority() {
		switch ($this->child->getPriority()) {
			case self::CRITICAL:  		// Equivale a proyectos A+
				return 81;  						// A+ era 6
			case self::HIGH:			  	// Equivale a proyectos A
				return 27;  						// era 4
			case self::MEDIUM_HIGH:  	// Equivale a proyectos B
				return 9;  							// B era 3
			case self::MEDIUM:				// Equivale a proyectos C
				return 3;  						  // C era 2
			default:									// Equivale a proyectos sin prioridad seleccionada
				return 1;  							// Sin prioridad era 1
		}
	}

	/**
	 * Devuelve los tipos de prioridad
	 * @param array Tipos de prioridad
	 */
	public static function getPriorityTypes() {
		$priorityTypes = ProjectPeer::$priorityTypes;
		return $priorityTypes;
	}

	public function __construct($child) {
		$this->child = $child;
		global $system;
		$this->colors = $system["config"]["tablero"]["colors"];
	}

	/**
	 * Devuelve el color acorde al estado del proyecto
	 * @param array Color acorde a estado
	 */
	public function statusColor() {
		if ($this->child->isCancelled())
			return $this->colors["cancelled"];
		if ($this->child->isEnded())
			return $this->colors["finished"];
		if ($this->child->isUndefined())
			return $this->colors["notDefined"];
		if ($this->child->isLate())
			return $this->colors["late"];
		if ($this->child->isDelayed())
			return $this->colors["delayed"];
		if (!$this->child->isStarted())
			return $this->colors["planned"];

		return $this->colors["onTime"];
	}

	/**
	 * Devuelve verdadero si el proyecto esta seteado como finished o si tiene fecha real de finalizacion.
	 * @param bool True si esta terminado, false si no lo esta
	 */
	function isEnded() {
		return ($this->child->getAcomplished() || !is_null($this->child->getRealEnd()));
	}

	/**
	 * Devuelve verdadero si el proyecto esta en desarrollo
	 * @param bool True si esta en ejecucion, false si no lo esta
	 */
	function isOnWork() {
		return (!$this->child->getAcomplished() && is_null($this->child->getRealEnd()));
	}

	/**
	 * Devuelve verdadero si el proyecto tiene fecha real de inicio.
	 * @param bool True si esta en iniciad, false si no lo esta
	 */
	function isStarted() {
		return !is_null($this->child->getRealStart());
	}

	/**
	 * Devuelve verdadero si el proyecto esta seteado como cancelado.
	 * @param bool True si esta cancelado, false si no lo esta
	 */
	function isCancelled() {
		return $this->child->getCancelled();
	}

	/**
	 * Devuelve verdadero si el proyecto no tiene actividades asociadas no canceladas.
	 * @param bool True si esta indefinido, false si no lo esta
	 */
	function isUndefined() {

		$activitiesCount = $this->child->countActivities();

		if (!isset($this->colorsCount))
			$this->colorsCount = $this->child->getActivitiesByStatusColorCountAssoc();

		return ($activitiesCount === 0 || $activitiesCount === $this->colorsCount[$this->colors["cancelled"]]);
	}

	/**
	 * Devuelve verdadero si hay retraso en las fechas de inicio pero menos que la tolerancia.
	 * O bien alguna de las actividades del proyecto esta demorada.
	 * @param bool True si esta demorado, false si no lo esta
	 */
	function isDelayed() {

		if (!isset($this->colorsCount))
			$this->colorsCount = $this->child->getActivitiesByStatusColorCountAssoc();

		if ($this->colorsCount[$this->colors["delayed"]] > 0)	 	// @BR: Si tiene actividades demoradas (delayed = amarillo) esta demorado (delayed = amarillo)
			return true;

		return false;																					 	// @BR: Solo esta demorado por sus actividades, no toma en cuenta su propias fechas
																														//			Todo calculo de sus fechas se comenta y no es tomado en cuenta

/*		$comparisonTime = time();
		global $system;
		// Tolerancia en dias
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["projects"]["delayed"];
			if ($days > 0)
				$comparisonTime = time() - ($days * 24 * 60 * 60);
		}

		$now = date('U') + (60 * 60 * $system["config"]["system"]["parameters"]["applicationTimeZoneGMT"]["value"]);
		$comparisonDate = strtotime(date('Y-m-d', $comparisonTime));								// tiempo del comienzo del dia (comparo contra un date, no un datetime)

		if ($this->child->isStarted())																							// @BR: Si esta iniciada
			return (($this->child->getEndingDate('U') <= $now)												// @BR: Si fecha de fin es menor a hoy
								&& ($this->child->getEndingDate('U') >= $comparisonDate));			//      y mayor a fecha de tolerancia
		else																																				// @BR: Si no esta iniciada
			return (($this->child->getStartingDate('U') <= $now)											// @BR: Si fecha de inicio es menor a hoy
								&& ($this->child->getStartingDate('U') >= $comparisonDate));		//      y mayor a fecha de tolerancia
*/
	}

	/**
	 * Devuelve verdadero si la fecha actual es posterior a la fecha planificada de finalizacion y no esta terminado el proyecto.
	 * O bien alguna de las actividades del proyecto esta fuera de plazo.
	 * @param bool True si esta retrasado, false si no lo esta
	 */
	function isLate() {

		if (!isset($this->colorsCount))
			$this->colorsCount = $this->child->getActivitiesByStatusColorCountAssoc();

		if ($this->colorsCount[$this->colors["late"]] > 0)	 		// @BR: Si tiene actividades retrasadas (late = rojo) esta retrasado (late = rojo)
			return true;

		return false;																					 	// @BR: Solo esta retrasado por sus actividades, no toma en cuenta sus propias fechas
																														//			Todo calculo de sus fechas se comenta y no es tomado en cuenta

/*		$comparisonTime = time();
		global $system;
		// Tolerancia en dias
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["projects"]["late"];
			if ($days > 0)
				$comparisonTime = time() - ($days * 24 * 60 * 60) + (60 + $system["config"]["system"]["parameters"]["applicationTimeZoneGMT"]["value"]);
		}

		$now = date('U') + (60 * 60 * $system["config"]["system"]["parameters"]["applicationTimeZoneGMT"]["value"]);
		$comparisonDate = strtotime(date('Y-m-d', $comparisonTime)); 							// tiempo del comienzo del dia (comparo contra un date, no un datetime)

		if ($this->child->isStarted())																						// @BR: Si esta iniciada
			return (($this->child->getEndingDate('U') < $now)		  									// @BR: Si fecha de fin es menor a hoy
								&& ($this->child->getEndingDate('U') < $comparisonDate));		  //      y menor a fecha de tolerancia
		else																															        // @BR: Si no esta iniciada
			return (($this->child->getStartingDate('U') < $now)											// @BR: Si fecha de inicio es menor a hoy
								&& ($this->child->getStartingDate('U') < $comparisonDate));		//      y menor a fecha de tolerancia
*/
	}

	/**
	 * Devuelve verdadero o falso si el proyecto tiene un color determinado
	 * @param $color color del proyecto
	 * @param bool True si tiene el estado suministrado (color), false si no lo esta
	 */
	function isOfStatusColor($color) {
		return ($this->child->statusColor() === $color);
	}

	/**
	 * Obtiene un array asociativo con la cantidad de activities asignadas al proyecto por cada color.
	 * @return array $colorsCount.
	 */
	public function getActivitiesByStatusColorCountAssoc() {
		$activities = $this->child->getActivities();
		$colorsCount = array();

		foreach ($this->colors as $color)							// Genero array con colores
			$colorsCount[$color] = 0;

		foreach ($activities as $activitiy)						// Lleno array con cantidad de actividades de cada color (status)
			$colorsCount[$activitiy->statusColor()]++;

		return $colorsCount;
	}

	/**
	 * Obtiene los activities asignadas al proyecto con un determinado status color.
	 * @return PropelObjectCollection Activities
	 */
	public function getActivitiesByStatusColor($color) {
		$activities = $this->child->getActivities();
		$filteredActivities = new PropelObjectCollection();
		foreach ($activities as $activity) {
			if ($activity->isOfStatusColor($color)) {
				$filteredActivities->append($activity);
			}
		}
		return $filteredActivities;
	}

	/**
	 * Obtiene la cantidad de activities asignadas al proyecto con un determinado status color.
	 * @return int $count
	 */
	public function countActivitiesByStatusColor($color) {
		return count($this->child->getActivitiesByStatusColor($color));
	}

} // BaseProject