<?php



/**
 * Skeleton subclass for performing query and update operations on the 'common_alertSubscription' table.
 *
 * Suscripciones de alerta
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class AlertSubscriptionPeer extends BaseAlertSubscriptionPeer {
	
	private $searchString;
	private $searchUserId;
	private $searchModuleEntityName;

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchString"=>"setSearchString",
		"searchUserId"=>"setSearchUserId",
		"searchModuleEntityName"=>"setSearchModuleEntityName"
	);
	
	function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	function setSearchUserId($searchUserId) {
		$this->searchUserId = $searchUserId;
	}

	function setSearchModuleEntityName($searchModuleEntityName) {
		$this->searchModuleEntityName = $searchModuleEntityName;
	}
	
	/**
	 * Obtiene un alertSubscription.
	 *
	 * @param int $id id del alertSubscription
	 * @return boolean true si se actualizo la informacion correctamente, false sino
	 */
	function get($id){
		$alertSubscription = AlertSubscriptionQuery::create()->findPk($id);
		return $alertSubscription;
	}
	
	/**
	 * Obtiene todas las alertSubscription.
	 *
	 * @return PropelCollection con todas las alertSubscription.
	 */
	function getAll(){
		$alertsSubscriptions = AlertSubscriptionQuery::create()->find();
		return $alertsSubscriptions;
	}
	
 	/**
	 * Crea un alertSubscription nuevo.
	 *
	 * @param array $params con los datos del proyecto
	 * @return boolean true si se creo el alertSubscription correctamente, false sino
	 */
	function create($params,$con = null) {
		$alertSubscription = new AlertSubscription();
		$alertSubscription = Common::setObjectFromParams($alertSubscription,$params);
		try {
			$alertSubscription->save($con);
			return $alertSubscription->getId();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Actualiza la informacion de un alertSubscription.
	 *
	 * @param int $id id del alertSubscription
	 * @param array $params datos del alertSubscription
	 * @return boolean true si se actualizo la informacion correctamente, false sino
	 */
	function update($id,$params){
		$alertSubscription = AlertSubscriptionQuery::create()->findPk($id);
		$alertSubscription = Common::setObjectFromParams($alertSubscription,$params);
		try {
			$alertSubscription->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Elimina un alertSubscription a partir de los valores de la clave.
	 *
	 * @param int $id id del alertSubscription
	 *	@return boolean true si se elimino correctamente el project, false sino
	 */
	function delete($id){
		$alertSubscription = AlertSubscriptionPeer::retrieveByPK($id);
		try {
			$alertSubscription->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Retorna el criteria generado a partir de los parámetros de búsqueda
	 *
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->addAscendingOrderByColumn(AlertSubscriptionPeer::ID);

		if ($this->searchString) {
			$criteria->add(AlertSubscriptionPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionDescription = $criteria->getNewCriterion(AlertSubscriptionPeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionDescription);
		}
		
		if ($this->searchUserId) {
			$criteria->useAlertSubscriptionUserQuery
					     ->filterByUserId($this->searchUserId)
					 ->endUse();
		}
		
		if ($this->searchModuleEntityName) {
			$criteria->filterByModuleEntityName($this->searchModuleEntityName);
		}
		
		return $criteria;
	}
	
	/**
	 * Obtiene todos los alertSubscription paginados segun la condicion de busqueda ingresada.
	 *
	 * @param int $page [optional] Numero de pagina actual
	 * @param int $perPage [optional] Cantidad de filas por pagina
	 * @return array Informacion sobre todos los projects
	 */
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"AlertSubscriptionPeer", "doSelect",$page,$perPage);
		return $pager;
	}
	
	public static function getPosibleNameFieldsByEntityName($entityName) {
		$textTypes = array_keys(ModuleEntityFieldPeer::getTextTypes());
		return ModuleEntityFieldQuery::create()->filterByType($textTypes)
											   ->findByEntityName($entityName);
	}
	
	public static function getPosibleTemporalFieldsByEntityName($entityName) {
		$temporalTypes = array_keys(ModuleEntityFieldPeer::getTemporalTypes());
		return ModuleEntityFieldQuery::create()->filterByType($temporalTypes)
											   ->findByEntityName($entityName);
	}

} // AlertSubscriptionPeer
