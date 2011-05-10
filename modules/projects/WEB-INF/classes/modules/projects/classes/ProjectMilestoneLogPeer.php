<?php


/**
 * Skeleton subclass for performing query and update operations on the 'projects_milestoneLog' table.
 *
 * Milestone Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.projects.classes
 */
class ProjectMilestoneLogPeer extends BaseProjectMilestoneLogPeer {

	private  $milestoneId;

	/**
	 * Especifica un objetivo
	 * @param objectiveId id del objetivo estratégico.
	 */
	public function setMilestoneId($milestoneId) {
		$this->milestoneId = $milestoneId;
	}

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);

		if ($this->milestoneId)
			$criteria->add(ProjectMilestoneLogPeer::MILESTONEID,$this->milestoneId);

		return $criteria;

	}

	/**
	* Obtiene todas las activities paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los activities
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getCriteria();
		$pager = new PropelPager($cond,"ProjectMilestoneLogPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

} // ProjectMilestoneLogPeer
