<?php



/**
 * Skeleton subclass for performing query and update operations on the 'panel_contractor' table.
 *
 * Base de Contratistas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class ContractorPeer extends BaseContractorPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Contractors';

	private $searchString;
	private $searchCuit;
	private $limit;
	private $projectId;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"searchCuit"=>"setSearchCuit",
					"limit" => "setLimit",
					'projectId' => 'setProjectId'
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

 /**
	 * Especifica un cuit para la busqueda
	 * @param $searchCuit cuit dle contratista
	 */
	function setSearchCuit($searchCuit){
		$this->searchCuit = $searchCuit;
	}
	
 	/**
	 * Especifica una cantidad maxima de registros.
	 * @param limit cantidad maxima de registros.
	 */
	function setLimit($limit){
		$this->limit = $limit;
	}
	
	/**
	 * Especifica un proyecto cuyos contratos no deben aparecer en la busqueda.
	 * @param int projectId, id del proyecto.
	 */
	function setProjectId($projectId){
		$this->projectId = $projectId;
	}

	/**
	* Obtiene un contractor.
	*
	* @param int $id id del contractor
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$contractor = ContractorQuery::create()->findPk($id);
		return $contractor;
	}

	/**
	* Obtiene todos los contractor.
	*
	* @param int $id id del contractor
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function getAll($id){
		$contractors = ContractorQuery::create()->orderByName()->find();
		return $contractors;
	}

 /**
	* Crea un contractor nuevo.
	*
	* @param array $params con los datos del proyecto
	* @return boolean true si se creo el contractor correctamente, false sino
	*/
	function create($params,$con = null) {
		$contractor = new Contractor();
		$contractor = Common::setObjectFromParams($contractor,$params);
		try {
			$contractor->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un contractor.
	*
	* @param int $id id del contractor
	* @param array $params datos del contractor
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$contractor = ContractorQuery::create()->findPk($id);
		$contractor = Common::setObjectFromParams($contractor,$params);
		try {
			$contractor->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Elimina un contractor a partir de los valores de la clave.
	*
	* @param int $id id del contractor
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$contractor = ContractorPeer::retrieveByPK($id);
		try {
			$contractor->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un contractor a partir del id.
	*
	* @param int $id Id del contractor
	* @return boolean true
	*/
  function hardDelete($id) {
		ContractorPeer::disableSoftDelete();
		$contractor = ContractorPeer::retrieveByPk($id);
		try {
			$contractor->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Obtiene todos los contractor desactivados.
	*
	*	@return array Informacion sobre los contractor
	*/
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(ContractorPeer::DELETED_AT, null, Criteria::ISNOTNULL);
		ContractorPeer::disableSoftDelete();
		$contractors = ContractorPeer::doSelect($criteria);
		return $contractors;
  }

	/**
	* Recupera del softdelete un contractor
	*
	* @param int $id Id del contractor
	* @return boolean true
	*/
  function recoverDeleted($id) {
		ContractorPeer::disableSoftDelete();
		$contractor = ContractorPeer::retrieveByPk($id);
		try {
			$contractor->unDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Retorna el criteria generado a partir de los par�metros de b�squeda
	 *
	 * @return criteria $criteria Criteria con par�metros de b�squeda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->setLimit($this->limit);
		$criteria->addAscendingOrderByColumn(ContractorPeer::ID);

		if ($this->searchString)
			$criteria->add(ContractorPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			
		if (!empty($this->projectId)) {
			$contractorsIds = ProjectContractorQuery::create()
									->filterByProjectId($this->projectId)
									->select('ContractorId')
									->find();
			$criteria->add(ContractorPeer::ID, $contractorsIds, Criteria::NOT_IN);
		}

		if ($this->searchCuit)
			$criteria->add(ContractorPeer::CUIT,$this->searchCuit);

		return $criteria;

	}

 /**
	* Obtiene todos los contractor paginados segun la condicion de busqueda ingresada.
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
		$pager = new PropelPager($criteria,"ContractorPeer", "doSelect",$page,$perPage);
		return $pager;
	}
	
   /**
	* Obtiene todos los contratistas paginados segun la condicion de busqueda ingresada.
	*
	* @return array Informacion sobre todos los contratistas
	*/
	function getAllFiltered()	{
		$criteria = $this->getSearchCriteria();
		$allObjects = ContractorPeer::doSelect($criteria);
		return $allObjects;
	}


} // ContractorPeer
