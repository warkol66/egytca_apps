<?php


/**
 * Clase BaseQuery.
 * 
 * Actua como Proxy de una ModelCriteria, y como Adapter adaptando funcionalidad
 * para el filtrado.
 */
class BaseQuery {
    
    private static $MAGIC_METHODS = array('findBy', 'findOneBy', 'filterBy', 'orderBy', 'groupBy');

    /**
     * Instancia de la clase query a la que se le aplican los filtros.
     * 
     * @var ModelCriteria
     */
    private $query;
    
    /**
     * Clase de la query a la que se le aplican los filtros.
     * 
     * @var string
     */
    private $queryClass;
    
    private $debugging;
    private $debugInfo;
    
    public function BaseQuery($modelNameOrModelCriteria) {
        $this->query = $this->createQuery($modelNameOrModelCriteria);
        $this->queryClass = get_class($this->query);
	$this->debugging = false;
	$this->debugInfo = array();
    }
    
    private function createQuery($modelNameOrModelCriteria) {
        if ($modelNameOrModelCriteria instanceof ModelCriteria) {
            return $modelNameOrModelCriteria;
        }
        
        $pieces = preg_split("/#/", $modelNameOrModelCriteria);
        $factoryMethod = !empty($pieces[1]) ? "create" . ucfirst($pieces[1]) : "create";
        $q = call_user_func(array($pieces[0] . "Query", $factoryMethod));
        
        return $q;
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
	 * Permite agregar un filtro a la Query, este filtro puede ser 
     * o bien un campo del modelo o bien un filtro personalizado.
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
        $result = $this->callIfPossible($filterName, $filterValue);
        if ($result instanceof ModelCriteria) {
            return $this;
        }
	
	$found = true;
	switch ($filterName) {

		case 'searchString':
			$this->query->filterByName("%$filterValue%", Criteria::LIKE);
		break;
	
		case 'entityFilter':
			$this->entityFilter($filterValue);
			break;
		
		default:
			$peer = $this->query->getModelPeerName();
			$filterName = ucfirst($filterName);
			if (in_array($filterName, $peer::getFieldNames(BasePeer::TYPE_PHPNAME)))
				$this->query->filterBy($filterName, $filterValue);
			else if (is_array($filterValue))
				$this->addFilters($filterValue); // Revisar
			else
				$found = false;

			break;
	}
	
	if ($this->debugging) {
		$this->debugInfo['filters'] []= array(
			'name' => $filterName,
			'params' => $filterValue,
			'found' => $found
		);
	}

	return $this;
    }
    
	/**
	 * Agrega multiples filtros a la Query.
	 *
	 * @see     addFilter
	 * @param   array $filters
	 * @return  Object ModelCriteria
	 */
	public function addFilters($filters = array()) {
		foreach ($filters as $name => $value) {
//            echo " existe filtro $name ? ". method_exists($this->queryClass, $name) . "<br />";
			if ((isset($value) && $value != null) && $name != "perPage")
				$this->addFilter($name, $value);
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
        
        if ($result instanceof ModelCriteria) {
            return $this;
        }
            
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
        if (method_exists($this->queryClass, $method) || ($this->isMagicMethod($method))) {
//            echo " invocando $method <br />";
	    if ($this->debugging) {
	        $this->debugInfo['filters'] []= array(
			'name' => $method,
			'params' => $arguments,
			'found' => true
		);
	    }
	    
            if (!is_array($arguments))
                $arguments = array($arguments);
            
            return call_user_func_array(array($this->query, $method), $arguments);
        }
        return FALSE;
    }
    
    /**
     * Se fija si $method es un metodo magico.
     * 
     * @param   string $method
     * @return  boolean
     */
    private function isMagicMethod($method) {
        foreach (self::$MAGIC_METHODS as $magicMethod) {
            if (preg_match("/^$magicMethod/", $method))
                return true;
        }
        return false;
    }
    
    public function entityFilter($filterValue) {

        $entityQueryClass = ucfirst($filterValue['entityType']) . "Query";
        if (!class_exists(ucfirst($filterValue['entityType'])) || !class_exists($entityQueryClass))
            return; // nothing to filter

        $entity = $entityQueryClass::create()->findOneById($filterValue['entityId']);
        if ($entity) {
        $filterByEntity = 'filterBy'.ucfirst($filterValue['entityType']);

        $queryClass = get_class($this);

        if ($filterValue['getCandidates']) {
            $alreadyRelated = $queryClass::create()->select("Id")->$filterByEntity($entity)->find()->toArray();
            $this->query->filterById($alreadyRelated, Criteria::NOT_IN);
        }
        else
            $this->query->$filterByEntity($entity);
       }
        
    }
    
    public function startDebug() {
	    $this->debugging = true;
	    return $this;
    }
    
    public function printDebugInfo($return = false) {
	    
	    if (!$this->debugging)
		    throw new Exception('must start debug first!! ($query->startDebug())');
	    
	    $this->debugInfo['sql'] = $this->query->toString();
	    
	    if ($return)
		    return $this->debugInfo;
	    else
		    echo "<pre>";print_r($this->debugInfo);echo "</pre>";die;
    }
    
} // Query
