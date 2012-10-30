<?php


/**
 * Skeleton subclass for representing a row from the 'indicators_x' table.
 *
 * Valores del eje x
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class IndicatorX extends BaseIndicatorX {
/**
	* Obtiene los valores de la variable.
	*
	* @return array de valores Y de la variable
	*/
	function getYs()
	{
		$xId = $this->getId();
		$yPeer = new IndicatorYPeer();
		$xValues = $yPeer->getYsByX($xId);
		return $xValues;
	}
} // IndicatorX
