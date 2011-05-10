<?php


/**
 * Skeleton subclass for performing query and update operations on the 'projects_projectLog' table.
 *
 * ProjectLog
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.projects.classes
 */
class ProjectLogPeer extends BaseProjectLogPeer {

	private  $projectId;

	/**
	 * Especifica un objetivo
	 * @param objectiveId id del objetivo estrat�gico.
	 */
	public function setProjectId($projectId) {
		$this->milestoneId = $projectId;
	}

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);

		if ($this->projectId)
			$criteria->add(ProjectLogPeer::MILESTONEID,$this->projectId);

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
		$pager = new PropelPager($cond,"ProjectLogPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	 * Obtiene todos los logs de un proyecto a partir de su projectId ordenados por instante de creación.
	 *
	 * @param int $projectId id del proyecto.
	 * @return array logs correspondientes al proyecto ordenados por instante de creación.
	 */
	public function getAllByProjectIdOrderedByUpdated($projectId, $orderType = 'asc') {
		 return ProjectLogQuery::create()->filterByProjectId($projectId)->orderByUpdated($orderType)->find();
	}

	/**
	 * Obtiene todos los logs de un proyecto a partir de su objectiveId ordenados por instante de creación y paginados.
	 *
	 * @param int $projectId id del proyecto.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array logs correspondientes al proyecto ordenados por instante de creación.
	 */
	public function getAllByProjectIdOrderedByUpdatedPaginated($projectId, $orderType = 'asc', $page=1, $maxPerPage=5) {
		 return ProjectLogQuery::create()->filterByProjectId($projectId)
											 ->orderByUpdated($orderType)
											 ->paginate($page, $maxPerPage);
	}

	/**
	 * Elimina todos los logs con fecha anterior o igual a la pasada por parametro.
	 * @param string $date fecha hasta la cual serán borrados todos los logs.
	 */
	public function purgeLogsOlderThan($date) {
		$logs = ProjectLogQuery::create()->filterByUpdated($date, CRITERIA::LESS_EQUAL)->delete();
	}

} // ProjectLogPeer
