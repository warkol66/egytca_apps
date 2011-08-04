<?php



/**
 * Skeleton subclass for representing a row from the 'headlines_headline' table.
 *
 * Headline
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class Headline extends BaseHeadline {

	/** the default item name for this class */
	const ITEM_NAME = 'Headline';

	/**
	* Obtiene el id de todas las categor�as asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getAssignedCategoriesArray(){
		return HeadlineCategoryRelationQuery::create()->filterByHeadline($this)->select('Categoryid')->find()->toArray();
	}

	/**
	 * Determina la existencia de una relacion con un determindo actor.
	 * @param $actor Object
	 * @param $type Object[optional]
	 */
	public function hasActor($actor, $type = null) {
		$headlineActorQuery = HeadlineActorQuery::create()->filterByHeadline($this)
                        ->filterByActor($actor);
		if ($type !== null)
			$headlineActorQuery->filterByType($type);
		
		return ($headlineActorQuery->count() > 0);															 		
	}

	/**
	* Obtiene el id de todos los actores asignados.
	*
	*	@return array Id de todos los actor asignados
	*/
	function getAssignedActorsArray(){
		return HeadlineActorQuery::create()->filterByHeadline($this)->select('Actorid')->find()->toArray();
	}
        
        /**
	 * Determina la existencia de una relacion con un determindo issue.
	 * @param $issue Object
	 * @param $type Object[optional]
	 */
	public function hasIssue($issue) {
		$headlineIssueQuery = HeadlineIssueQuery::create()->filterByHeadline($this)
                        ->filterByIssue($issue);
		return ($headlineIssueQuery->count() > 0);															 		
	}
        
        /**
	* Obtiene el id de todos los actores asignados.
	*
	*	@return array Id de todos los actor asignados
	*/
	function getAssignedIssuesArray(){
		return HeadlineIssueQuery::create()->filterByHeadline($this)->select('Issueid')->find()->toArray();
	}


} // Headline
