<?php

/**
 * Skeleton subclass for representing a row from the 'indicators_indicator' table.
 *
 * Indicator
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class Indicator extends BaseIndicator {

	/** the default item name for this class */
	const ITEM_NAME = 'Indicator';

	/**
	* Obtiene el nombre traducido del tipo de indicador.
	*
	* @return array tipos de indicador
	*/
	function getIndicatorTypeTranslated()
	{
		$type = $this->getType();

		$indicatorPeer = new IndicatorPeer();
		$indicatorTypes = $indicatorPeer->getIndicatorTypesTranslated();
		$indicatorTypeName = $indicatorTypes[$type];
		return $indicatorTypeName;
	}

	/**
	* Obtiene las series del indicador.
	*
	* @return array de series del indicador
	*/
	function getSeries()
	{	
		// No podemos hacer una consulta a la DB porque puede tratarse
		// de un indicador no persistido.
		$indicatorSeries = $this->getIndicatorSeries();
		uasort($indicatorSeries, array('Indicator', 'compareByOrder'));
		return $indicatorSeries;
	}

	/**
	* Obtiene las series del indicador.
	*
	* @return array de series del indicador
	*/
	function getXs()
	{
		// No podemos hacer una consulta a la DB porque puede tratarse
		// de un indicador no persistido.
		$indicatorXs = $this->getIndicatorXs();
		uasort($indicatorXs, array('Indicator', 'compareByOrder'));
		return $indicatorXs;
	}
	
	private function compareByOrder($a, $b) {
	    if ($a->getOrder() == $b->getOrder()) {
	        return 0;
	    }
	    return ($a->getOrder() < $b->getOrder()) ? -1 : 1;
	}

} // Indicator
