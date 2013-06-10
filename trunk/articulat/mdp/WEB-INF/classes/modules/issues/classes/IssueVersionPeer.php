<?php



/**
 * Skeleton subclass for performing query and update operations on the 'issues_issueLog' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.issues.classes
 */
class IssueVersionPeer extends BaseIssueVersionPeer {
    
    /**
	 * Obtiene todas las versiones de un asunto a partir de su objectiveId ordenados por instante de creación y paginados.
	 *
	 * @param int $issueId id del asunto.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array versions correspondientes al asunto ordenados por instante de creación.
	 */
	public function getAllByIssueIdOrderedByUpdatedPaginated($issueId, $orderType = Criteria::ASC, $page=1, $maxPerPage=5) {
		 return IssueVersionQuery::create()->filterById($issueId)
                         ->orderByUpdatedAt($orderType)
                         ->paginate($page, $maxPerPage);
	}

} // IssueVersionPeer
