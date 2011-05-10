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

	/**
	 * Especifica una fecha desde para una busqueda personalizada.
	 *
	 * @param $fromDate string YYYY-MM-DD
	 */
	public function setDateFrom($dateFrom) {
		$this->dateFrom = $dateFrom;
	}

	/**
	 * Especifica una fecha hasta para una busqueda personalizada.
	 *
	 * @param $toDate string YYYY-MM-DD
	 */
	public function setDateTo($dateTo) {
		$this->dateTo = $dateTo;
	}

	/**
	 * Especifica un usuario como criteriod e búsqueda
	 *
	 * @param $userId int 
	 */
	public function setUserId($userId) {
		$this->userId = $userId;
	}

	/**
	 * Especifica un módulo como criteriod e búsqueda
	 *
	 * @param $userId string 
	 */
	public function setModule($module) {
		$this->module = $module;
	}

	/**
	 * Especifica un afiliado como criteriod e búsqueda
	 *
	 * @param $userId int 
	 */
	public function setAffiliateId($affiliateId) {
		$this->affiliateId = $affiliateId;
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

		if (!empty($this->userId)) 
			$criteria->add(ActionLogPeer::USERID, $this->userId);

		if (!empty($this->affiliateId)) 
			$criteria->add(ActionLogPeer::AFFILIATEID, $this->affiliateId);

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
	*
	* selectAllByRequirementsPaginated
	*	Crea un filtro por requerimientos enviados a la funcion, devuelve un listado filtrado
	* @param datetime $dateFrom fecha filtro de inicio del listado
	* @param datetime $dateTo fecha filtro del fin de listado
	* @param int $selectUser usuario filtro seleccionado
	* @param string $module nombre del modulo seleccionado para el filtro
	* @param int $page pagina del paginado
	* @return object $pager listado filtrado y paginado
	*/

	function selectAllByRequirementsPaginated ($dateFrom,$dateTo,$selectUser,$module,$page=1,$perPage=25) {
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$cond->addAscendingOrderByColumn(ActionLogPeer::ID);

		$cond->addMultipleJoin(array(
			    array(ActionLogLabelPeer::FORWARD, ActionLogPeer::FORWARD),
			    array(ActionLogPeer::ACTION, ActionLogLabelPeer::ACTION)),
			    Criteria::LEFT_JOIN);

		$cond->add(ActionLogLabelPeer::LANGUAGE,Common::getCurrentLanguageCode());
		$cond->addJoin(ActionLogPeer::USERID, UserPeer::ID, Criteria::LEFT_JOIN);
		$cond->addJoin(ActionLogPeer::ACTION, SecurityActionLabelPeer::ACTION, Criteria::LEFT_JOIN);

		$criterion = $cond->getNewCriterion(ActionLogPeer::DATETIME, $dateTo, Criteria::LESS_EQUAL);
		$criterion->addAnd($cond->getNewCriterion(ActionLogPeer::DATETIME, $dateFrom, Criteria::GREATER_EQUAL ));
    $cond->add($criterion);

		////////
		// ultima version con afiliado = 0
		if ($selectUser != 0){
			$cond->add(ActionLogPeer::USERID, $selectUser);
			$cond->add(ActionLogPeer::AFFILIATEID, 0);
		}

		if($module != 0)
			$cond->add(ActionLogLabelPeer::ACTION, ucfirst($module) . '%', CRITERIA::LIKE);

		$pager = new PropelPager($cond,"ActionLogPeer", "doSelect",$page,$perPage);

		return $pager;

	}



	/**
	*
	* selectAllByRequirementsAndAffiliatePaginated
	*	Crea un filtro por requerimientos y afiliados enviados a la funcion, devuelve un listado filtrado
	* @param datetime $dateFrom fecha filtro de inicio del listado
	* @param datetime $dateTo fecha filtro del fin de listado
	* @param int $selectUser usuario filtro seleccionado
	* @param int $affiliate id del afiliado
	* @param string $module nombre del modulo seleccionado para el filtro
	* @param int $page pagina del paginado
	* @return object $pager listado filtrado y paginado
	*/
	function selectAllByRequirementsAndAffiliatePaginated  ($dateFrom,$dateTo,$selectUser,$affiliate,$module,$page=1,$perPage=25) {
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$cond->addAscendingOrderByColumn(ActionLogPeer::ID);

		$cond->addMultipleJoin(array(
			    array(ActionLogLabelPeer::FORWARD, ActionLogPeer::FORWARD),
			    array(ActionLogPeer::ACTION, ActionLogLabelPeer::ACTION)),
			    Criteria::LEFT_JOIN);

		$criterion = $cond->getNewCriterion(ActionLogPeer::DATETIME, $dateTo, Criteria::LESS_EQUAL);
		$criterion->addAnd($cond->getNewCriterion(ActionLogPeer::DATETIME, $dateFrom, Criteria::GREATER_EQUAL ));
    $cond->add($criterion);

		////////////
		// Version con afiliado
		@include_once('AffiliatePeer.php');
		if (class_exists('AffiliatePeer')){
			$cond->addJoin(ActionLogPeer::AFFILIATEID, AffiliatePeer::ID,Criteria::LEFT_JOIN);
			$cond->add(ActionLogPeer::AFFILIATEID, $affiliate,Criteria::EQUAL);
			$cond->addJoin(ActionLogPeer::USERID, AffiliateUserPeer::ID,Criteria::LEFT_JOIN);
		}

		if ($selectUser != 0)
			$cond->add(ActionLogPeer::USERID, $selectUser);

		if($module != 0)
			$cond->add(ActionLogLabelPeer::ACTION, ucfirst($module) . '%', CRITERIA::LIKE);

		$pager = new PropelPager($cond,"ActionLogPeer", "doSelect",$page,$perPage);

		return $pager;
	}


	/**
	* deleteLogs
	*	Purga datos de la lista de logs
	* @param datetime $dateFrom inicio de fecha de purgacion
	* @param datetime $dateTo fin de fecha de purgacion
	*/
	function deleteLogs($dateFrom,$dateTo) {
		try{
			$cond = new Criteria();

			$cond->add(ActionLogPeer::DATETIME, $dateFrom." 00:00:00", Criteria::GREATER_THAN );
			$cond->add(ActionLogPeer::DATETIME, $dateTo." 23:59:59", Criteria::LESS_THAN );
			$selectedLogs = ActionLogPeer::doSelect($cond);

			foreach($selectedLogs as $obj) {
					$obj->delete();
			}
		}catch (PropelException $e) {}
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
    $cond = $this->getCriteria();

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

} // ActionLogPeer
