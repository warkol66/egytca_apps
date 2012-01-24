<?php


/**
 * Clase BaseQuery.
 * 
 * Actua como Proxy de una ModelCriteria, y como Adapter adaptando funcionalidad
 * para el filtrado.
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
    
    /**
     * Constructor estatico usado para el encadenamiento.
     * 
     * @param  mixed $modelNameOrModelCriteria
     * @return BaseQuery 
     */
    public static function create($modelNameOrModelCriteria) {
        return new BaseQuery($modelNameOrModelCriteria);
    }
    
	/**
	 * Permite agregar un filtro personalizado a la Query, que puede ser
	 * traducido al campo correspondiente.
	 *
	 * @param   string $filterName
	 * @param   mixed $filterValue
	 * @return  BaseQuery
	 */
    public function addFilter($filterName, $filterValue) {
        
        /**
         * Si el $filterName existe como metodo en el objeto query,
         * entonces lo invoca.
         */
        if ($this->callIfPossible($filterName, $filterValue)) {
            return $this;
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
		return $this;
	}
    
    /**
     * Proxy method.
     * 
     * Redirecciona los llamados de metodos que no sean de la BaseQuery
     * a $this->query.
     * 
     * Devuelve un resultado, o $this.
     * 
     * @param   string $name
     * @param   mixed $arguments
     * @return  mixed
     */
    public function __call($name, $arguments) {
        
        $result = $this->callIfPossible($name, $arguments);
        
        if ($result instanceof ModelCriteria)
            return $this;
            
        return $result;
    }
    
    /**
     * De existir, invoca al $method de la $this->query.
     * 
     * @param   string $method
     * @param   mixed $arguments
     * @return  mixed 
     */
    private function callIfPossible($method, $arguments) {
        if (method_exists($this->query, $method)) {
            return call_user_func_array(array($this->query, $method), $arguments);
        }
        return FALSE;
    }
    
} // Query
