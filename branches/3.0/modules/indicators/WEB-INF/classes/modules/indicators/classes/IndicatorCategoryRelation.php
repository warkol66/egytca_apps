<?php


/**
 * Skeleton subclass for representing a row from the 'indicators_indicatorsCategory' table.
 *
 * Relacion Categorias e Indicadores
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class IndicatorCategoryRelation extends BaseIndicatorCategoryRelation {

	/**
	* Obtiene el nombre del padre de un IndicatorCategory.
	*
	* @return array Informacion del IndicatorCategory
	*/
	function getCategoryName()
	{
		$categoryId = $this->getCategoryId();
		$category = IndicatorCategoryQuery::create()->findPk($categoryId);
		return $category->getName();
	}

} // IndicatorCategoryRelation
