<?php



/**
 * Skeleton subclass for representing a row from the 'planning_activity' table.
 *
 * Actividades de las obras y proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningActivity extends BasePlanningActivity {

	private $colors;

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

		global $system;
		$this->colors = $system["config"]["tablero"]["colors"];

		$this->useRandomValues = ConfigModule::get('planning', 'useDemoValues');
	}

	/**
	 * Sobrecarga de postSave para guardar fechas de proyecto asociado
	 */
	public function postSave(\PropelPDO $con = null) {
		parent::postSave($con);
		if ($this->getProject())
			$this->getProject()->doUpdateRealDates();
	}

	// TODO: Deberia reemplazar a isOnWork()????
	public function isOnExecution() {
		return ( !$this->getRealEnd() && $this->getRealStart('U') && ($this->getRealStart('U') < date('U')) );
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
	 * Devuelve las actividades
	 * @return array Relacion las actividades
	 */
	public function getProject() {
		return BaseQuery::create('Planning'.$this->getObjecttype())->findOneById($this->getObjectid());
	}

	/**
	 * Devuelve el color "status" de una actividad
	 * @return string con el color "status" de una actividad
	 */
	function statusColor() {
		if ($this->isCancelled())													// @BR: Si esta cancelada
			return $this->colors["cancelled"];							//      Se cuenta como cancelada (cancelled = black)
		if ($this->isFinished())													// @BR: Si esta terminada
			return $this->colors["onTime"];									//      Se considera a tiempo (onTime = verde) !!! Regla especial solicitada de esa forma
		if ($this->isLate() && !$this->isUndefined())			// @BR: Si esta retrasada y no esta indefinida
			return $this->colors["late"];										//      Se cuenta como atrasada (late = red)
		if ($this->isUndefined() || $this->isDelayed())		// @BR: Si no tienen definiciones o esta demorada
			return $this->colors["delayed"];								//      Se cuenta como demorada (delayed = yellow)
		if (!$this->isStarted())													// @BR: Si no esta iniciada
			return $this->colors["planned"];								//      Esta planificada
		if ($this->isStarted())														// @BR: Si esta iniciada
			return $this->colors["onTime"];									//      Y no entro en los anteriores, esta a tiempo
		return $this->colors["planned"];									// @BR: Por defecto, si no esta en ningun otro estado, esta planificada
	}

	/**
	 * Devuelve true si la actividad esta cancelada
	 * @return bool si o no si esta cancelada
	 */
	function isCancelled() {
		return $this->getCancelled();
	}

	/**
	 * Devuelve true si la actividad esta terminada
	 * @return bool si o no si tiene fecha de fin real y marcada como cumplida
	 */
	function isFinished() {
		return ($this->getAcomplished() && !is_null($this->getRealEnd('U')));
	}

	/**
	 * Devuelve true si la actividade no tiene las fechas necesarias
	 * @return bool si tiene o no cargadas las fechas necesarias
	 */
	function isUndefined() {
		if ($this->getObjecttype() == "Construction")						// @BR: Si es obra operan diferentes fechas
			return (is_null($this->getEndingDate('U'))						// @BR: Si no tiene fecha de fin planificado
								&& is_null($this->getRescheduledEnd('U'))); //      y tampoco fecha modificada (rescheduledEnd)
		else																										// @BR: Si es proyecto hay fechas de inicio y fin
			return (is_null($this->getStartingDate('U'))					// @BR: Si no tiene fecha de inicio
								|| is_null($this->getEndingDate('U'))); 		//      o fin planificado.
	}

	/**
	 * Devuelve true si la actividad esta iniciada, en caso que sea hito, devuelve true siempre
	 * @return bool si se inicio o no la actividad
	 */
	function isStarted() {
		if ($this->getObjecttype() == "Construction")				// @BR: Si es obra operan diferentes fechas
			return false;																			// @BR: Nunca puede estar iniciada
		else																								// @BR: Si es proyecto hay fechas de inicio y fin
			return (!is_null($this->getRealStart('U')) 				// @BR: Si tienen fecha de inicio real
								&& is_null($this->getRealEnd('U'))); 		//      pero no de fin real
	}

	/**
	 * Devuelve true si la actividad esta demorada, su inicio o fin estan vencidas y menores a la tolerancia
	 * @return bool si o no dependiendo de si esta demorada
	 */
	function isDelayed() {
		$comparisonTime = time();
		global $system;
		// Tolerancia en dias
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["delayed"];
			if ($days > 0)
				$comparisonTime = time() - ($days * 24 * 60 * 60);
		}

		$now = date('U') + (60 * 60 * $system["config"]["system"]["parameters"]["applicationTimeZoneGMT"]["value"]);
		$toleranceDate = strtotime(date('Y-m-d', $comparisonTime));					// tiempo del comienzo del dia (comparo contra un date, no un datetime)

		if ($this->getObjecttype() == "Construction") {														// @BR: Si es de obra
			if (is_null($this->getRescheduledEnd('U')))															// @BR: Si no esta reprogramada (rescheduledEnd == null)
				return (($this->getEndingDate('U') < $now)														// @BR: Si fecha planificada de fin es menor a hoy
									&& ($this->getEndingDate('U') >= $toleranceDate));					//      y mayor a fecha de tolerancia
			else																																		// @BR: esta reprogramada (rescheduledEnd != null)
				return (($this->getRescheduledEnd('U') < $now)												// @BR: Si fecha reprogramada de fin es menor a hoy
									&& ($this->getRescheduledEnd('U') >= $toleranceDate));			//      y mayor a fecha de tolerancia
		}
		else {																																		// @BR: Si es de proyecto
			if ($this->isStarted()) {																								// @BR: Si esta iniciado
				if (is_null($this->getRescheduledEnd('U')))														// @BR: Si no esta reprogramada (rescheduledEnd == null)
					return (($this->getEndingDate('U') < $now)													// @BR: Si fecha de fin es menor a hoy
										&& ($this->getEndingDate('U') >= $toleranceDate));				//      y mayor a fecha de tolerancia
				else																																	// @BR: Si esta reprogramada (rescheduledEnd != null)
					return (($this->getRescheduledEnd('U') < $now)											// @BR: Si fecha de fin reprogramada es menor a hoy
										&& ($this->getRescheduledEnd('U') >= $toleranceDate));		//      y mayor a fecha de tolerancia
			}
			else {																																	// @BR: Si no esta iniciado
				if (is_null($this->getRescheduledStart('U')))													// @BR: Si no esta reprogramada (rescheduledStart == null)
					return (($this->getStartingDate('U') < $now)												// @BR: Si fecha de inicio es menor a hoy
										&& ($this->getStartingDate('U') >= $toleranceDate));			//      y mayor a fecha de tolerancia
				else																																	// @BR: Si esta reprogramada (rescheduledStart != null)	
					return (($this->getRescheduledStart('U') < $now)										// @BR: Si fecha de inicio reprogramado es menor a hoy
										&& ($this->getRescheduledStart('U') >= $toleranceDate));	//      y mayor a fecha de tolerancia
			}
		}
	}

	/**
	 * Devuelve true si la actividad esta retrasada, su inicio o fin estan vencidos y mayores a la tolerancia
	 * @return bool si o no dependiendo de si esta demorada
	 */
	function isLate() {
		$comparisonTime = time();
		global $system;
		// Tolerancia en dias
		if ($system["config"]["tablero"]["activities"]["parameterControl"]["value"] == "DAYS") {
			$days = $system["config"]["tablero"]["activities"]["delayed"];
			if ($days > 0)
				$comparisonTime = time() - ($days * 24 * 60 * 60);
		}
		$now = date('U') + (60 * 60 * $system["config"]["system"]["parameters"]["applicationTimeZoneGMT"]["value"]);
		$toleranceDate = strtotime(date('Y-m-d', $comparisonTime)); 					// tiempo del comienzo del dia (comparo contra un date, no un datetime)

		if ($this->getObjecttype() == "Construction") {												// @BR: Si es obra
			if (is_null($this->getRescheduledEnd('U')))													// @BR: Si no esta reprogramada (rescheduledEnd == null)
				return (($this->getEndingDate('U') < $now)												// @BR: Si fecha planificada de fin es menor a hoy
									&& ($this->getEndingDate('U') < $toleranceDate));				//      y menor a fecha de tolerancia
			else																																// @BR: Si esta reprogramada (rescheduledEnd != null)
				return (($this->getRescheduledEnd('U') < $now)										// @BR: Si fecha reprogramada de fin es menor a hoy
									&& ($this->getRescheduledEnd('U') < $toleranceDate));		//      y menor a fecha de tolerancia
		}
		else {																																		// @BR: Si es de proyecto
			if ($this->isStarted()) {																								// @BR: Si esta iniciado
				if (is_null($this->getRescheduledEnd('U')))														// @BR: Si no esta reprogramada (rescheduledEnd == null)
					return (($this->getEndingDate('U') < $now)													// @BR: Si fecha de fin es menor a hoy
										&& ($this->getEndingDate('U') < $toleranceDate));					//      y menor a fecha de tolerancia
				else																																	// @BR: Si esta reprogramada (rescheduledEnd != null)
					return (($this->getRescheduledEnd('U') < $now)											// @BR: Si fecha de fin reprogramada es menor a hoy
										&& ($this->getRescheduledEnd('U') < $toleranceDate));			//      y menor a fecha de tolerancia
			}
			else {																																	// @BR: Si no esta iniciado
				if (is_null($this->getRescheduledStart('U')))													// @BR: Si no esta reprogramada (rescheduledStart == null)
					return (($this->getStartingDate('U') < $now)												// @BR: Si fecha de inicio es menor a hoy
										&& ($this->getStartingDate('U') < $toleranceDate));				//      y menor a fecha de tolerancia
				else																																	// @BR: Si esta reprogramada (rescheduledStart != null)	
					return (($this->getRescheduledStart('U') < $now)										// @BR: Si fecha de inicio reprogramado es menor a hoy
										&& ($this->getRescheduledStart('U') < $toleranceDate));		//      y menor a fecha de tolerancia
			}
		}
	}


	/**
	 * Devuelve true si la actividad esta a termino
	 * @return bool si o no dependiendo de si esta a termino
	 */
	function isOnTime() {
		return (!$this->isDelayed() && !$this->isLate() && !$this->isFinished() && !$this->isCancelled());
	}
	/**
	 * Devuelve true la actividad es del color indicado
	 * @return bool si tiene o no el color indicado
	 */
	function isOfStatusColor($color) {
		return ($this->statusColor() === $color);
	}

} // PlanningActivity
