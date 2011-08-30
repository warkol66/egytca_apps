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
	* Obtiene el id de todas las categor�as asignadas.
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
	* Obtiene el id de todas las categor�as asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getAssignedActorsArray(){
		return IssueActorQuery::create()->filterByIssue($this)->select('Actorid')->find()->toArray();
	}

	/**
	* Obtiene el nombre del objeto que modifico el issue
	*
	*	@return string con nombre de quien modifico el issue
	*/
	function changedBy(){
		if ($this->getObjectType() != "") {
			$objectQueryName = ucfirst($this->getObjectType() . 'Query');
			if (class_exists($objectQueryName)) {
				$query = call_user_func(array($objectQueryName, 'create'));
				return $query->findPK($this->getObjectid());
			}
		}
	}

	/**
	* Obtiene el nombre traducido del tipo de impacto.
	*
	* @return array tipos de region
	*/
	function getImpactTypeTranslated() {
		$type = $this->getImpact();
		$issueImpactTypes = Common::getTranslatedArray(IssuePeer::getIssueImpactTypes(),'issues');
		return $issueImpactTypes[$type];
	}

	/**
	* Obtiene el nombre traducido del tipo de impacto.
	*
	* @return array tipos de region
	*/
	function getValorationTypeTranslated() {
		$type = $this->getValoration();
		$issueValorationTypes = Common::getTranslatedArray(IssuePeer::getIssueValorationTypes(),'issues');
		return $issueValorationTypes[$type];
	}

	/**
	* Obtiene el nombre traducido del tipo de impacto.
	*
	* @return array tipos de region
	*/
	function getEvolutionStageTranslated() {
		$type = $this->getEvolution();
		$issueEvolutionStages = Common::getTranslatedArray(IssuePeer::getIssueEvolutionStages(),'issues');
		return $issueEvolutionStages[$type];
	}
        
        /**
	 * Devuelve las versiones para el asunto ordenadas en por fecha de creación y paginadas.
	 * @param string $orderType forma en que se ordena, Criteria::ASC = ascendente Criteria::DESC = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array Versions para el proyecto ordenados en forma decreciente por fecha de creación.
	 */
	public function getVersionsOrderedByUpdatedPaginated($orderType = Criteria::ASC, $page=1, $maxPerPage=5) {
		$issueVersionPeer = new IssueVersionPeer();
		return $issueVersionPeer->getAllByIssueIdOrderedByUpdatedPaginated($this->getId(), $orderType, $page, $maxPerPage);
	}

	/**
	* Obtiene el id de todas las categor�as asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getParentIssue(){
		return IssueQuery::create()->findOneById($this->getParentId());
	}

} // Issue
