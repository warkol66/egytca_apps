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
			2 => 'Proyecto',
			3 => 'Otro'
		);
		return $productTypes;
	}


} // PlanningIndicator
