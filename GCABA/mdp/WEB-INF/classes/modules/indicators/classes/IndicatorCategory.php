<?php


/**
 * Skeleton subclass for representing a row from the 'indicators_category' table.
 *
 * Categorias de Indicadores
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class IndicatorCategory extends BaseIndicatorCategory {

	/** the default item name for this class */
	const ITEM_NAME = 'Category';

	/**
	* Obtiene el nombre del padre de un IndicatorCategory.
	*
	* @return array Informacion del IndicatorCategory
	*/
	function getParentName(){
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getName();
		}
		else
			return;
	}

	/**
	* Obtiene el nombre del padre de un IndicatorCategory.
	*
	* @return array Informacion del IndicatorCategory
	*/
	function getParentId(){
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getId();
		}
		else
			return;
	}

} // IndicatorCategory
