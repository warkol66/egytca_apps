<?php



/**
 * Skeleton subclass for representing a row from the 'planning_indicator' table.
 *
 * Indicators
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningIndicator extends BasePlanningIndicator {


	/**
	 * Devuelve el nombre del tipo de indicador (IndicatorType)
	 *
	 * @return string tipo de indicador
	 */
	public function getIndicatorType() {
		$types = PlanningIndicator::getIndicatorTypes();
		return $types[$this->getType()];
	}

	/**
	 * Devuelve array con posibles tipos de indicador (IndicatorTypes)
	 *  id => tipo de indicador
	 *
	 * @return array tipos de indicador
	 */
	public static function getIndicatorTypes() {
		$productTypes = array(
			1 => 'Impacto',
			2 => 'Gestión'
		);
		return $productTypes;
	}
	/**
	 * Devuelve array con los meses para determinar la frecuencia de medicion (measureFrecuency)
	 *  id => tipo de indicador
	 *
	 * @return array tipos de indicador
	 */
	public static function getMeasureFrecuencyTypes() {
		$measureFrecuencyTypes = array(
			1 => 'Mensual',
			2 => 'Bimestral',
			5 => 'Trimestral',
			3 => 'Cuatrimestral',
			6 => 'Semestral',
			4 => 'Anual'
		);
		return $measureFrecuencyTypes;
	}

	/**
	 * Devuelve array con posibles resultados Esperados (expectedResults)
	 *  id => resultado esperado
	 *
	 * @return array resultados esperados
	 */
	public static function getExpectedResultsTypes() {
		$expectedResultsTypes = array(
			1 => 'Incremento',
			2 => 'Descenso',
			3 => 'Aceleracion',
			4 => 'Desaceleracion'
		);
		return $expectedResultsTypes;
	}

	/**
	 * Devuelve array con posibles tipos de meta (goalType)
	 *  id => resultado esperado
	 *
	 * @return array resultados esperados
	 */
	public static function getGoalTypes() {
		$goalTypes = array(
			1 => 'Cualitativa',
			2 => 'Cuantitativa'
		);
		return $goalTypes;
	}

	/**
	 * Devuelve array con posibles tendendicas esperadas (trend)
	 *  id => resultado esperado
	 *
	 * @return array resultados esperados
	 */
	public static function getTrendTypes() {
		$trendTypes = array(
			1 => 'Ascendente',
			2 => 'Descendente'
		);
		return $trendTypes;
	}

} // PlanningIndicator
