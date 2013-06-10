<?php



/**
 * Skeleton subclass for performing query and update operations on the 'headlines_tag' table.
 *
 * Etiquetas de titulares
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class HeadlineTagQuery extends BaseHeadlineTagQuery
{

	/**
	 * Agrega parametro de busqueda para el BaseQuery
	 *
	 * @return query
	 */
	public function searchString($searchString) {
		return $this->where("HeadlineTag.Name LIKE ?", "%$searchString%");
	}

}
