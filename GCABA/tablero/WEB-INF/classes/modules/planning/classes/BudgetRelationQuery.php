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
	
	function conditionForConstructionObjectWithId($constructionId) {
		return $this->conditionForObjectTypeWithId('Construction', $constructionId);
	}
	
	function filterByProjectObjectWithId($projectId) {
		return $this->filterByObjecttype('Project')->filterByObjectid($projectId);
	}
	
	function conditionForProjectObjectWithId($projectId) {
		return $this->conditionForObjectTypeWithId('Project', $projectId);
	}
	
	function conditionForObjectTypeWithId($objectType, $objectId) {
		
		// conditionForObjectTypeWithId($objectType, $objectId = array()) {...} doesn't work
		if (empty($objectId))
			$objectId = array();
		
		$cond1Name = uniqid('cond-');
		$cond2Name = uniqid('cond-');
		$condResultName = uniqid('cond-');
		$this->condition($cond1Name, BudgetRelationPeer::OBJECTTYPE . ' =  ?', $objectType);
		$this->condition($cond2Name, BudgetRelationPeer::OBJECTID . (is_array($objectId) ? ' IN ' : ' = ') . '?', $objectId);
		$this->combine(array($cond1Name, $cond2Name), 'and', $condResultName);
		return $condResultName;
	}

} // BudgetRelationQuery
