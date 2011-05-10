<?php


/**
 * Skeleton subclass for performing query and update operations on the 'objectives_objectiveLog' table.
 *
 * Objective Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.objectives.classes
 */
class ObjectiveLogPeer extends BaseObjectiveLogPeer {

	private  $objectiveId;

	/**
	 * Especifica un objetivo
	 * @param objectiveId id del objetivo estrat�gico.
	 */
	public function setObjectiveId($objectiveId) {
		$this->objectiveId = $objectiveId;
	}

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);

		if ($this->strategicObjectiveId)
		$criteria->add(ObjectiveLogPeer::OBJECTIVEID,$this->objectiveId);

		return $criteria;

	}

	/**
	 * Obtiene todos los logs de un objetivo a partir de su objectiveId ordenados por instante de creación.
	 *
	 * @param int $objectiveId id del objetivo.
	 * @return array logs correspondientes al objetivo ordenados por instante de creación.
	 */
	public function getAllByObjectiveIdOrderedByUpdated($objectiveId, $orderType = 'asc') {
		 return ObjectiveLogQuery::create()->filterByObjectiveId($objectiveId)->orderByUpdated($orderType)->find();
	}

/**
	 * Obtiene todos los logs de un objetivo a partir de su objectiveId ordenados por instante de creación y paginados.
	 *
	 * @param int $objectiveId id del objetivo.
	 * @param string $orderType forma en que se ordena, 'asc' = ascendente 'desc' = descendente.
	 * @param int $page numero de pagina.
	 * @param int $maxPerPage cantidad maxima de elementos por pagina.
	 * @return array logs correspondientes al objetivo ordenados por instante de creación.
	 */
	public function getAllByObjectiveIdOrderedByUpdatedPaginated($objectiveId, $orderType = 'asc', $page=1, $maxPerPage=5) {
		 return ObjectiveLogQuery::create()->filterByObjectiveId($objectiveId)
											 ->orderByUpdated($orderType)
											 ->paginate($page, $maxPerPage);
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
		$pager = new PropelPager($cond,"ObjectiveLogPeer", "doSelect",$page,$perPage);
		return $pager;
	}

	/**
	 * Elimina todos los logs con fecha anterior o igual a la pasada por parametro.
	 * @param string $date fecha hasta la cual serán borrados todos los logs.
	 */
	public function purgeLogsOlderThan($date) {
		$logs = ObjectiveLogQuery::create()->filterByUpdated($date, CRITERIA::LESS_EQUAL)->delete();
	}

} // ObjectiveLogPeer
