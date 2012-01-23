<?php


/**
 * Class Query.
 *
 * @author nico
 */
class BaseQuery {

    /**
     * Instancia de la clase query a la que se le aplican los filtros.
     * 
     * @var ModelCriteria
     */
    private $query;
    
    public function BaseQuery($modelNameOrModelCriteria) {
        if ($modelNameOrModelCriteria instanceof ModelCriteria) {
            $this->query = $modelNameOrModelCriteria;
        }
        else {
            $queryClass  = $modelNameOrModelCriteria . "Query";
            $this->query = $queryClass::create();
        }
    }
    
    public static function create($modelNameOrModelCriteria) {
        return new BaseQuery($modelNameOrModelCriteria);
    }
    
	/**
	 * Permite agregar un filtro personalizado a la Query, que puede ser
	 * traducido al campo correspondiente.
	 *
	 * @param   string $filterName
	 * @param   mixed $filterValue
	 * @return  ModelCriteria
	 */
    public function addFilter($filterName, $filterValue) {
        
        /**
         * Si el $filterName existe como metodo en el objeto query,
         * entonces lo invoca.
         */
        if (method_exists($this->query, $filterName)) {
            call_user_func(array($this->query, $filterName), $filterValue);
            return $this->query;
        }
        
		switch ($filterName) {

			case 'searchString':
				$this->query->filterByName("%$filterValue%", Criteria::LIKE);
				break;

			default:
				$peer = $this->query->getModelPeerName();
				$filterName = ucfirst($filterName);
				if (in_array($filterName, $peer::getFieldNames(BasePeer::TYPE_PHPNAME)))
					$this->query->filterBy($filterName, $filterValue);
				else if (is_array($filterValue))
					$this->addFilters($filterValue); // Revisar

				break;
		}

		return $this->query;
    }
    
	/**
	 * Agrega multiples filtros a la Query.
	 *
	 * @see     addFilter
	 * @param   array $filters
	 * @return  Object ModelCriteria
	 */
	public function addFilters($filters = array()) {
		foreach ($filters as $name => $value)
			if ((isset($value) && $value != null) && $name != "perPage")
				$this->addFilter($name, $value);
		return $this->query;
	}

} // Query
