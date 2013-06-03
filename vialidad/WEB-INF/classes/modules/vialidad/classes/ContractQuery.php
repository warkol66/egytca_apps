<?php



/**
 * Skeleton subclass for performing query and update operations on the 'vialidad_contract' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class ContractQuery extends BaseContractQuery {
	
	public function __construct($dbName = 'application', $modelName = 'Contract', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
		$user = Common::getLoggedUser();
		if (get_class($user) == "AffiliateUser")
			$this->filterByAffiliate($user->getAffiliate());
	}
	
	/**
	 * Permite agregar un filtro personalizado a la Query, que puede ser
	 * traducido al campo correspondiente.
	 * @param   type $filterName
	 * @param   type $filterValue
	 * @return  ModelCriteria 
	 */
	public function addFilter($filterName, $filterValue) {
		
		$filterName = ucfirst($filterName);
		
		// empty() no sirve porque algunos filtros admiten 0 como valor
		if (!isset($filterValue) || $filterValue == null)
			return $this;
		
		switch ($filterName) {
			case 'SearchString':
				$this->filterByName("%$filterValue%", Criteria::LIKE);
				break;
			default:
				if (in_array($filterName, ContractPeer::getFieldNames(BasePeer::TYPE_PHPNAME)))
					$this->filterBy($filterName, $filterValue);
				else {
					//Log - campo inexistente.
				}
				break;
		}
		return $this;
	}
	
	/**
	 * Agrega multiples filtros a la Query.
	 *
	 * @see     addFilter
	 * @param   type $filters
	 * @return  ModelCriteria
	 */
	public function addFilters($filters = array()) {
		foreach ($filters as $name => $value)
				$this->addFilter($name, $value);

		return $this;
	}

	/**
	 * Crea un pager.
	 *
	 * @param   array $filters
	 * @param   int $page
	 * @param   int $perPage
	 * @return  PropelModelPager
	 */
	public function createPager($filters, $page = 1, $perPage = 10) {
		return $this->addFilters($filters)->paginate($page, $perPage);
	}

	/**
	 * Agrega filtros por nombre y numero de contrato
	 *
	 * @param   type string $filterValue texto a buscar
	 * @return condicion de filtrado por texto a buscar
	 */
	public function searchString($filterValue) {
		return $this->filterByName("%$filterValue%", Criteria::LIKE)
				->_or()
					->filterByContractnumber("%$filterValue%", Criteria::LIKE);
	}

} // ContractQuery
