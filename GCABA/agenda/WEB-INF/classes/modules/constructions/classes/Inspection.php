<?php



/**
 * Skeleton subclass for representing a row from the 'constructions_inspection' table.
 *
 * Inspecciones a la obra
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.constructions.classes
 */
class Inspection extends BaseInspection {

	/**
	 * Devuelve array con estados (statuses) de una obra
	 *  id => Estados posibles
	 *
	 * @return array tipos de estado de una obra
	 */
	public static function getStatuses() {
		$statuses = array(
			1 => 'Blanco',
			2 => 'Verde',
			3 => 'Amarillo',
			4 => 'Negro',
			5 => 'Azul'
		);
		return $statuses;
	}

	/**
	 * Devuelve array con ritmos de trabajo (workingRates) de una obra
	 *  id => Estados posibles
	 *
	 * @return array con ritmos de trabajo (workingRates) de una obra
	 */
	public static function getWorkingRates() {
		$workingRates = array(
			1 => 'Nulo',
			2 => 'Bajo',
			3 => 'Medio',
			4 => 'Alto'
		);
		return $workingRates;
	}

} // Inspection
