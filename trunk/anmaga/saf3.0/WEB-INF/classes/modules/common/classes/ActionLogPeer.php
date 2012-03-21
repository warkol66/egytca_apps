<?php


/**
 * Skeleton subclass for performing query and update operations on the 'actionLogs_log' table.
 *
 * logs del sistema
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class ActionLogPeer extends BaseActionLogPeer {

	private $dateFrom;
	private $dateTo;
	private $userId;
	private $module;
	private $affiliateId;
	private $clientId;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"dateFrom"=>"setDateFrom",
					"dateTo" => "setDateTo",
					"userId"=>"setUserId",
					"module"=>"setModule",
					"affiliateId"=>"setAffiliateId",
					"clientId" => "setClientId"
				);


	/**
	 * Especifica una fecha desde para una busqueda personalizada.
	 * @param $fromDate string YYYY-MM-DD
	 */
	public function setDateFrom($dateFrom) {
		$this->dateFrom = $dateFrom;
	}

	/**
	 * Especifica una fecha hasta para una busqueda personalizada.
	 * @param $toDate string YYYY-MM-DD
	 */
	public function setDateTo($dateTo) {
		$this->dateTo = $dateTo;
	}

	/**
	 * Especifica un usuario como criterio de búsqueda
	 * @param $userId int
	 */
	public function setUserId($userId) {
		$this->userId = $userId;
	}

	/**
	 * Especifica un módulo como criterio de búsqueda
	 * @param $userId string
	 */
	public function setModule($module) {
		$this->module = $module;
	}

	/**
	 * Especifica un afiliado como criterio de búsqueda
	 * @param $affiliateId int
	 */
	public function setAffiliateId($affiliateId) {
		$this->affiliateId = $affiliateId;
	}

	/**
	 * Especifica un cliente como criterio de búsqueda
	 * @param $clientId int
	 */
	public function setClientId($clientId) {
		$this->clientId = $clientId;
	}

	/**
	 * Aplica ordenamiento por fecha de creación a las consultas
	 */
	public function setOrderByDatetime() {
		$this->orderByDatetime = true;
	}

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getCriteria() {
		$criteria = new Criteria();

		if ($this->orderByDatetime)
			$criteria->addDescendingOrderByColumn(ActionLogPeer::DATETIME);

		if (!empty($this->userId)) {
			$criteria->add(ActionLogPeer::USEROBJECTTYPE, "user");
			$criteria->add(ActionLogPeer::USEROBJECTID, $this->userId);
		}
		if (!empty($this->affiliateId)) {
			$criteria->add(ActionLogPeer::USEROBJECTTYPE, "affiliate");
			$criteria->add(ActionLogPeer::USEROBJECTID, $this->affiliateId);
		}
		if (!empty($this->clientId)) {
			$criteria->add(ActionLogPeer::USEROBJECTTYPE, "client");
			$criteria->add(ActionLogPeer::USEROBJECTID, $this->clientId);
		}
		if (!empty($this->module))
			$criteria->add(ActionLogPeer::ACTION, ucfirst($this->module) . '%', Criteria::LIKE);

		if (!empty($this->dateFrom) && !empty($this->dateTo)) {
			$criterion = $criteria->getNewCriterion(ActionLogPeer::DATETIME, $this->dateFrom, Criteria::GREATER_EQUAL);
			$criterion->addAnd($criteria->getNewCriterion(ActionLogPeer::DATETIME, $this->dateTo, Criteria::LESS_EQUAL));
			$criteria->add($criterion);
		}
		else {
			if (!empty($this->dateFrom))
				$criteria->add(ActionLogPeer::DATETIME, $this->dateFrom, Criteria::GREATER_EQUAL);
			if (!empty($this->dateTo))
				$criteria->add(ActionLogPeer::DATETIME,$this->dateTo, Criteria::LESS_EQUAL);
		}

		return $criteria;

	}

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		$systemConfig = Common::getModuleConfiguration('System');
		return $systemConfig['rowsPerPage'];
	}

	/**
	* deleteLogs
	*	Purga datos de la lista de logs
	* @param datetime $dateFrom inicio de fecha de purgacion
	* @param datetime $dateTo fin de fecha de purgacion
	*/
	function deleteLogs($dateFrom,$dateTo) {
		try {
			$cond = new Criteria();

			$cond->add(ActionLogPeer::DATETIME, $dateFrom." 00:00:00", Criteria::GREATER_THAN );
			$cond->add(ActionLogPeer::DATETIME, $dateTo." 23:59:59", Criteria::LESS_THAN );
			$selectedLogs = ActionLogPeer::doSelect($cond);

			foreach($selectedLogs as $obj)
				$obj->delete();

		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
		}
		return;
	}

	/**
	* getOldestLog
	*	Obtiene fecha del primer registro de log
	*/
	public function oldestLogDate(){
			$cond = new Criteria();

			$cond->addAscendingOrderByColumn(ActionLogPeer::DATETIME);
			$cond->setLimit(1);

			$logsObj = ActionLogPeer::doSelectOne($cond);

		if ( !empty($logsObj) )
			$oldestLogDate = $logsObj->getDatetime();

			return $oldestLogDate;
	}


	/**
	* Obtiene todos los logs paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los actionlogs
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	ActionLogPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getSearchCriteria();
		$pager = new PropelPager($cond,"ActionLogPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Obtiene todos los noticias paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los newsarticles
	*/
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	ActionLogPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$pager = new PropelPager($cond,"ActionLogPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	 * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	 * @return Criteria instancia de criteria
	 */
	private function getSearchCriteria() {
		$criteria = ActionLogQuery::create();

		if ($this->orderByDatetime)
			$criteria->addDescendingOrderByColumn(ActionLogPeer::DATETIME);

		if (!empty($this->userId)) {
			$criteria->add(ActionLogPeer::USEROBJECTTYPE, "user");
			$criteria->add(ActionLogPeer::USEROBJECTID, $this->userId);
		}
		if (!empty($this->affiliateId)) {
			$criteria->add(ActionLogPeer::USEROBJECTTYPE, "affiliate");
			$affiliate = AffiliatePeer::get($this->affiliateId);
			$affiliateUsers = AffiliateUserPeer::getIdsArray($affiliate);
			$criteria->add(ActionLogPeer::USEROBJECTID, $affiliateUsers, CRITERIA::IN);
		}
		if (!empty($this->clientId)) {
			$criteria->add(ActionLogPeer::USEROBJECTTYPE, "client");
			$client = ClientPeer::get($this->clientId);
			$clientUsers = ClientUserPeer::getIdsArray($client);
			$criteria->add(ActionLogPeer::USEROBJECTID, $clientUsers, CRITERIA::IN);
		}
		if (!empty($this->module))
			$criteria->add(ActionLogPeer::ACTION, ucfirst($this->module) . '%', Criteria::LIKE);

		if (!empty($this->dateFrom) && !empty($this->dateTo)) {
			$criterion = $criteria->getNewCriterion(ActionLogPeer::DATETIME, $this->dateFrom, Criteria::GREATER_EQUAL);
			$criterion->addAnd($criteria->getNewCriterion(ActionLogPeer::DATETIME, $this->dateTo . " 23:59:59", Criteria::LESS_EQUAL));
			$criteria->add($criterion);
		}
		else {
			if (!empty($this->dateFrom))
				$criteria->add(ActionLogPeer::DATETIME, $this->dateFrom, Criteria::GREATER_EQUAL);
			if (!empty($this->dateTo))
				$criteria->add(ActionLogPeer::DATETIME, $this->dateTo . " 23:59:59", Criteria::LESS_EQUAL);
		}

		return $criteria;

	}


} // ActionLogPeer
