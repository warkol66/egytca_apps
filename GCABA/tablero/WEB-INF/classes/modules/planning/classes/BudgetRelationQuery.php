<?php



/**
 * Skeleton subclass for performing query and update operations on the 'planning_budgetRelation' table.
 *
 * Asociacion patridas presupuestarias y proyectos u obras
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class BudgetRelationQuery extends BaseBudgetRelationQuery {
	
	function filterByConstructionObjectWithId($constructionId) {
		return $this->filterByObjecttype('Construction')->filterByObjectid($constructionId);
	}
	
	function filterByProjectObjectWithId($projectId) {
		return $this->filterByObjecttype('Construction')->filterByObjectid($projectId);
	}

} // BudgetRelationQuery
