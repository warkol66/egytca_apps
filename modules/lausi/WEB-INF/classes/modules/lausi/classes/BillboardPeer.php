<?php


/**
 * Class BillboardPeer
 *
 * @package Billboard
 */
class BillboardPeer extends BaseBillboardPeer {

	const TYPE_DOBLE = 1;
	const TYPE_SEXTUPLE = 2;

	//opciones de busqueda
	private $searchRegionId;
	private $searchCircuitId;
	private $searchType;
	private $searchWorkforceId;
	private $searchThemeId;
	private $searchRating;
	private $searchGroupByAddress = false;
	private $searchGroupByType = false;

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchRegionId"=>"setSearchRegionId",
		"searchCircuitId"=>"setSearchCircuitId",
		"searchType"=>"setSearchType",
		"searchWorkforceId"=>"setSearchWorkforceId",
		"searchThemeId"=>"setSearchThemeId",
		"searchRating"=>"setSearchRating",
		"searchGroupByAddress"=>"setSearchGroupByAddress",
		"searchGroupByType"=>"setSearchGroupByType"
	);
	/**
	 * Especifica un Barrio para limitar una busqueda
	 * @param integer id de barrio
	 *
	 */
	public function setSearchRegionId($searchRegionId) {
		$this->searchRegionId = $searchRegionId;
	}

	/**
	 * Especifica un Circuito para limitar una busqueda
	 * @param integer id de circuit
	 *
	 */	
	public function setSearchCircuitId($searchCircuitId) {
		$this->searchCircuitId = $searchCircuitId;
	}
	
	/**
	 * Especifica una Valoracion para limitar una busqueda
	 * @param integer codigo de valoracion
	 *
	 */	
	public function setSearchType($searchType) {
		$this->searchType = $searchType;
	}
	
	/**
	 * Especifica un operario para limitar una busqueda
	 * @param integer id operario
	 *
	 */	
	public function setSearchWorkforceId($searchWorkforceId) {
		$this->searchWorkforceId = $searchWorkforceId;
	}
	
	/**
	 * Especifica un Motivo para limitar una busqueda
	 * @param integer id de Motivo
	 *
	 */	
	public function setSearchThemeId($searchThemeId) {
		$this->searchThemeId = $searchThemeId;
	}

	/**
	 * Especifica un Rating para limitar una busqueda
	 * @param integer Rating
	 *
	 */
	public function setSearchRating($searchRating) {
		$this->searchRating = $searchRating;
	}
	
	/**
	 * Especifica agrupamiento por direccion para una busqueda
	 * 
	 */
	public function setSearchGroupByAddress($searchGroupByAddress) {
		$this->searchGroupByAddress = $searchGroupByAddress;
	}

	/**
	 * Especifica agrupamiento por tipo para una busqueda
	 * 
	 */
	public function setSearchGroupByType() {
		$this->searchGroupByType = $searchGroupByType;
	}
	
	public static function getRadiusRanges($radius) {
		return array(0, $radius, $radius * 1.3, $radius * 1.6, $radius * 2);
	}

	/**
	 * Elimina un billboard a partir de los valores de la clave.
	 *
	 * @param int $id id del billboard
	 *	@return boolean true si se elimino correctamente el billboard, false sino
	 */
	function delete($id) {
		if (is_array($id))
			return BillboardQuery::create()->filterByPrimaryKeys($id)->delete();
		return BillboardQuery::create()->filterByPrimaryKey($id)->delete();
	}

	/**
	 * Obtiene la informacion de un billboard.
	 *
	 * @param int $id id del billboard
	 * @return array Informacion del billboard
	 */
	function get($id) {
		if (is_array($id))
			return BillboardQuery::create()->findPks($id);
  		return BillboardQuery::create()->findPk($id);
	}

	/**
	 * Obtiene todos los billboards.
	 *
	 * @return array Informacion sobre todos los billboards
	 */
	function getAll() {
		return BillboardQuery::create()->find();
	}
  
	/**
	 * Obtiene todos los billboards paginados.
	 *
	 * @param int $page [optional] Numero de pagina actual
	 * @param int $perPage [optional] Cantidad de filas por pagina
	 *	@return array Informacion sobre todos los billboards
	 */
	function getAllPaginated($page=1,$perPage=-1,$criteria = null) {  
    	if ($perPage == -1)
    		$perPage = Common::getRowsPerPage();
    	if (empty($page))
    		$page = 1;

    	if ($criteria == null)
    		$cond = new BillboardQuery;
    	else
    		$cond = $criteria;

    	$pager = new PropelPager($cond,"BillboardPeer", "doSelect",$page,$perPage);
    	return $pager;
	}

	/**
	 * Deprecated, use BillboardQuery::filterByAvailable() instead
	 */
	private function getAllAvailableCriteria($criteria = null,$fromDate,$duration) {
		if ($criteria == null) {
			$criteria = new BillboardQuery;
		}
		$criteria->filterByAvailable($fromDate,$duration);
		//hacemos un ordenamiento random de los resultados de la consulta
		$criteria->addAscendingOrderByColumn('RAND()');
		
		return $criteria;
	}

	public function getAllAvailableCount($criteria = null, $fromDate, $duration) {
		if ($criteria == null) {
			$criteria = new BillboardQuery;
		}
		$criteria->filterByAvailable($fromDate,$duration);
		
		return $criteria->count();
	}

	/**
    * Obtiene todos los disponibles para una fecha y duracion
    *
    * @param Criteria $criteria criteria de busqueda de Propel
    * @param string $fromDate fecha de inicio de disponibilidad
    * @param integer $duration disponibilidad de duracion
    */
	public function getAllAvailable(&$criteria = null, $fromDate, $duration) {
		try {
			//hacemos un ordenamiento random de los resultados de la consulta
			$criteria->addAscendingOrderByColumn('RAND()');
			return $criteria->filterByAvailable($fromDate, $duration)->find();
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	private function getDistributionStructure($billboards) {
		//devolvemos aquellos resultados que resultan disponibles realmente
		$available = array();
		
		foreach ($billboards as $billboard) {
			$added = false;

			//lo adicionamos
			if (!isset($available[$billboard->getAddressId()])) {
				$available[$billboard->getAddressId()] = array();
				$available[$billboard->getAddressId()]['elements'] = array();
				$available[$billboard->getAddressId()]['selected'] = 0;
				$available[$billboard->getAddressId()]['address'] = $billboard->getAddress();
			}
			
			array_push($available[$billboard->getAddressId()]['elements'],$billboard);
		}
		//seleccionamos de a dos en el orden de direccion que fue saliendo
		return $available;	
	}
	
	/**
	 * Calcula la cantidad real a publicar, dependiendo de la cantidad de 
	 * carteleras disponibles en la busqueda.
	 * @param integer cantidad de carteleras disponibles
	 * @param integer cantidad de carteleras que se pretenden ocupar.
	 */
	private function calculateQuantityToBePublished($availableCount,$quantityToBePublished) {
		//Si quiero distribuir menos o lo mismo de lo disponible, no hay problemas con la cantidad
		//Si la cantidad disponible es menor a lo que quiero distribuir
		//solo puedo distribuir lo disponible
		
		return min($availableCount, $quantityToBePublished);
	}
	
	/**
	 * Permite distribuir por direccion una cantidad de carteleras dadas.
	 *
	 * @param integer cantidad de carteleras a distribuir
	 * @param integer numero de carteleras a distribuir por direccion
	 */ 
	private function distributeByAddress($distributeStructure,$quantity,$numberByAddress = 1) {
		$pending = $quantity;

		foreach ($distributeStructure as $key => $addressHolder) {
			//si no hay pendientes, no sigo recorriendo
			if ($pending <= 0)
				break;

			//si hay mas elementos en la direccion que la cantidad que tengo que 
			//asignar por la direccion puedo realizar asignaciones
			if (sizeof($addressHolder['elements']) >= $numberByAddress) {
				$counter = $numberByAddress;
				$position = 0;
				while (($counter > 0) && ($position < (sizeof($addressHolder['elements'])))) {
					$billboard = $addressHolder['elements'][$position];
					
					if (!$billboard->isChecked()) {
						//realizo la asignacion
						$billboard->setChecked();
						$distributeStructure[$key]['selected']++;
						$pending--;
						$counter--;
						
						//caso especial a cuando se pide 2 para las dobles
						if ($numberByAddress == 2 && $pending == 1 && $counter == 0 && ($position < (sizeof($addressHolder['elements'])-1))) {
							$counter++;
						}
					}
					$position++;
				}
			}
		}

		return $pending;
	}

	/** 
	 * Distribucion de motivos sextuples
	 * @param integer cantidad a distribuir	
	 * @param array de instancias de Billboard
	 */
	private function distributeSextuples($quantity,$billboards) {
		$available = BillboardPeer::getDistributionStructure($billboards);
		
		$quantityToBePublished = BillboardPeer::calculateQuantityToBePublished(sizeof($billboards),$quantity);
		
		$pending = $quantityToBePublished;		

		while ($pending > 0) {
			$pending = BillboardPeer::distributeByAddress(&$available,$pending,1);
		}

		return $available;
	}

	/** 
	 * Distribucion de motivos sextuples
	 * @param integer cantidad a distribuir
	 * @param array de instancias de Billboard
	 */	
	private function distributeDoubles($quantity,$billboards) {
		$available = BillboardPeer::getDistributionStructure($billboards);

		$quantityToBePublished = BillboardPeer::calculateQuantityToBePublished(sizeof($billboards),$quantity);
		
		$pending = BillboardPeer::distributeByAddress(&$available,$quantityToBePublished,2);
		
		while ($pending > 0) {
			$pending = BillboardPeer::distributeByAddress(&$available,$pending,1);
		}
		
		return $available;
	}	
 
   /**
    * Obtiene todos los disponibles para una fecha y duracion
    *
    * @param Criteria $criteria criteria de busqueda de Propel
    * @param string $fromDate fecha de inicio de disponibilidad
    * @param integer $duration disponibilidad de duracion
    */
   public function getAllAvailableOrdered(&$criteria = null,$fromDate, $duration, $quantity, $type) {
		$result = BillboardPeer::getAllAvailable($criteria,$fromDate,$duration);

		$available = array();
		
		if ($type == BillboardPeer::TYPE_DOBLE)
			$available = BillboardPeer::distributeDoubles($quantity,$result);
		if ($type == BillboardPeer::TYPE_SEXTUPLE)
			$available = BillboardPeer::distributeSextuples($quantity,$result);
		
		return $available;
   }

   /**
    * Obtiene todos los disponibles para una fecha y duracion
    *
    * @param Criteria $criteria criteria de busqueda de Propel
    * @param string $fromDate fecha de inicio de disponibilidad
    * @param integer $duration disponibilidad de duracion
    */
   public function getAllAvailableOrderedByCircuitAndAddress($criteria = null,$fromDate, $duration, $quantity, $type) {
		$available = BillboardPeer::getAllAvailableOrdered($criteria,$fromDate,$duration,$quantity,$type);

		uasort($available,'BillboardPeer::comparisonByOrderCircuit');
		
		return $available;
   }

   /**
    * Obtiene todos los billboards disponibles para una direccion
    *
    */
   public function getAllAvailableByAddress($addressId, $quantity, $fromDate, $duration, $type = null) {
   		$criteria = new BillboardQuery();
	   	
	   	$criteria->filterByAddressId($addressId);
	
		//si se pide un tipo especifico se agrega a la consulta
   		if ($type != null)
			$criteria->filterByType($type);
	   	
		return BillboardPeer::getAllAvailableOrdered($criteria,$fromDate, $duration, $quantity, $type);
   }
   
   /**
    * Obtiene todos los billboards disponibles por region y tipo
    *
    * @param integer $regionId id de la region
    * @param integer $quantity cantidad requerida de disponibles
    * @param string $type tipo de billboard
	* @param date $fromDate fecha desde de la publicacion
	* @param integer $duration 
    */
   public function getAllAvailableByRegion($regionId, $quantity, $fromDate, $duration, $type = null) {
   		$criteria = new BillboardQuery();
   		
   		//si se pide un tipo especifico se agrega a la consulta
   		if ($type != null)
	   		$criteria->filterByType($type);

	   	$criteria->filterByRegionId($regionId);
	   	
		return BillboardPeer::getAllAvailableOrdered($criteria,$fromDate, $duration, $quantity, $type);
   }
   
   /**
    * Obtiene todos los billboards disponibles por circuito y tipo
    *
    * @param integer $circuitId id de la region
    * @param integer $quantity cantidad requerida de disponibles
    * @param string $type tipo de billboard
	* @param date $fromDate fecha desde de la publicacion
	* @param integer $duration
    */
   public function getAllAvailableByCircuit($circuitId, $fromDate, $duration, $quantity, $type = null) {
   		$criteria = new BillboardQuery();
	
   		//si se pide un tipo especifico se agrega a la consulta
   		if ($type != null)
	   		$criteria->filterByType($type);
	   	
	   	$criteria->filterByCircuitId($circuitId);
	   	
		return BillboardPeer::getAllAvailableOrderedByCircuitAndAddress($criteria,$fromDate, $duration, $quantity,$type);
   }

   /**
    * Obtiene todos los billboards disponibles por rating
    *
    * @param integer $rating rating
    * @param integer $quantity cantidad requerida de disponibles
    * @param string $type tipo de billboard
	* @param date $fromDate fecha desde de la publicacion
	* @param integer $duration
    */
   public function getAllAvailableByRating($rating, $fromDate, $quantity, $duration, $type = null) {
   		$criteria = new BillboardQuery();
   		
   		//si se pide un tipo especifico se agrega a la consulta
   		if ($type != null)
	   		$criteria->filterByType($type);
	
	   	$criteria->filterByRating($rating);
	
		return BillboardPeer::getAllAvailableOrdered($criteria,$fromDate,$duration,$quantity,$type);	   	
   }
   
   /**
    * Obtiene todos los billboards disponibles para una ubicacion geografica
    *
    * @param integer $rating rating
    * @param integer $quantity cantidad requerida de disponibles
    * @param string $type tipo de billboard
	* @param date $fromDate fecha desde de la publicacion
	* @param integer $duration
    */
   public function getAllAvailableByLocation($quantity, $longitude_0 , $latitude_0, $radius, $fromDate, $duration, $type = null, $quantity) {
   		$ranges = BillboardPeer::getRadiusRanges($radius);
   		$criteria = new BillboardQuery();
   		
   		//si se pide un tipo especifico se agrega a la consulta
   		if ($type != null)
	   		$criteria->filterByType($type);
			
		$prevCriteria = clone $criteria;
		
		$billboardsAvailable = array();
		$pending = $quantity;	
		
		$i = 0;
		
		while ($pending > 0 && ($i < count($ranges) - 1) ) {
			//Restauramos la criteria a un estado anterior a filtrar por radio.
			$criteria = clone $prevCriteria;
		
			$radiusFrom = $ranges[$i];
			$radiusTo = $ranges[$i+1];
		
			$criteria->filterByRadius($latitude_0, $longitude_0, $radiusFrom, $radiusTo);
			
			if ($i > 0)
				$billboardsAvailable[] = 'Separator'.$i;
				
			$billboardsExtra = BillboardPeer::getAllAvailableOrdered($criteria,$fromDate,$duration,$pending,$type);
			
			//un array merge no funciona como corresponde porque tienen claves numericas.
			foreach($billboardsExtra as $key => $billboardExtra) {
				$billboardsAvailable[$key] = $billboardExtra;
			}
			$pending -= $criteria->count();
			$i++;
		}
   		
		return $billboardsAvailable;
   }
   
  /**
   * Obtiene La cantidad total de carteleras.
   *
   * @returns integer cantidad de carteleras total
   */
  public function getAllCount() {
  		return BillboardQuery::create()->count();
  }

  /**
   * Obtiene La cantidad total de carteleras dentro de un circuito.
   *
   * @returns integer cantidad de carteleras total en un circuito
   */
  public function getAllByCircuitCount($circuitId) {
		return BillboardQuery::create()
			->filterByCirctuitId($circuitId)
			->count();
  }
  
	public function getSearchCriteria() {
  		$criteria = new BillboardQuery();
	
		$criteria->join('Address',Criteria::INNER_JOIN);
		
		if (!empty($this->searchRegionId))
			$criteria->useQuery('Address')
						->filterByRegionId($this->searchRegionId)
					 ->endUse();
	
		if (!empty($this->searchCircuitId))
			$criteria->useQuery('Address')
						->filterByCircuitId($this->searchCircuitId)
					 ->endUse();

		if (!empty($this->searchType))
			$criteria->filterByType($this->searchType);		

		if (!empty($this->searchRating))
			$criteria->useQuery('Address')
						->filterByRating($this->searchRating)
					 ->endUse();

		if (!empty($this->searchThemeId)) {
			$criteria->join('Advertisement');
			$criteria->useQuery('Advertisement')
						->filterByThemeId($this->searchThemeId)
						->filterByCurrent()
					 ->endUse();
		}
		
		if ($this->searchGroupByAddress)
			$criteria->groupByAddressid();
  
		if ($this->searchGroupByType) {
			$criteria->groupByType();			
		}
  		return $criteria;
  	}
  
	/**
	* Obtiene todos los billboards paginados aplicando condiciones de filtro.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los billboards
	*/
	public function getAllPaginatedFiltered($page=1,$perPage=-1) {
	
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		
		//obtenemos la criteria para realizar el filtrado
		$criteria = $this->getSearchCriteria();
		
		return $this->getAllPaginated($page,$perPage,$criteria);
		
	}
	
	public function getAllFiltered() {
		$cond = $this->getSearchCriteria();
		$alls = $cond->find();
		return $alls;
	}
	
	public static function comparisonByOrderCircuit($a,$b) {
		$addressA = $a['address'];
		$addressB = $b['address'];
		
		if ($addressA->getOrderCircuit() == $addressB->getOrderCircuit())
			return 0;
	
		if ($addressA->getOrderCircuit() < $addressB->getOrderCircuit())
			return -1;
		else
			return 1;
	}
  
}

?>
