<?php



/**
 * Skeleton subclass for representing a row from the 'issues_issue' table.
 *
 * Asuntos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.issues.classes
 */
class Issue extends BaseIssue {

	/** the default item name for this class */
	const ITEM_NAME = 'Issue';

	/**
	* Obtiene el id de todas las categorías asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getAssignedCategoriesArray(){
		return IssueCategoryRelationQuery::create()->filterByIssue($this)->select('Categoryid')->find()->toArray();
	}

	/**
	 * Determina la existencia de una relacion con un determindo actor.
	 * @param $actor Object
	 * @param $type Object[optional]
	 */
	public function hasActor($actor, $type = null) {
		$issueActorQuery = IssueActorQuery::create()->filterByIssue($this)
															 ->filterByActor($actor);
		if ($type !== null)
			$issueActorQuery->filterByType($type);
		
		return ($issueActorQuery->count() > 0);															 		
	}

	/**
	* Obtiene el id de todas las categorías asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getAssignedActorsArray(){
		return IssueActorQuery::create()->filterByIssue($this)->select('Actorid')->find()->toArray();
	}


} // Issue
