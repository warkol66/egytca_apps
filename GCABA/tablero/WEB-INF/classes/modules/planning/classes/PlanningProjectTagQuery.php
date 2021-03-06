<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_projectTag' table.
 *
 * Etiquetas de titulares
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningProjectTagQuery extends BasePlanningProjectTagQuery
{
	/**
	 * Agrega parametro de busqueda para el BaseQuery
	 *
	 * @return query
	 */
	public function searchString($searchString) {
		return $this->where("PlanningProjectTag.Name LIKE ?", "%$searchString%");
	}
}
