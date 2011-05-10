<?php

/**
 * Class AdvertisementPeer
 *
 * @package Advertisement
 */
class AdvertisementPeer extends BaseAdvertisementPeer {

	//opciones para la busqueda personalizada
	private $searchClientId;
	private $searchThemeId;
	private $searchCircuitId;
	private $searchType;
	private $searchWorkforceId = '';
	private $searchFromDate;
	private $searchToDate;
	private $searchExactDate;
	
	private $allThemes = false;
	private $groupByAddressAndTheme = true;
	private $orderByCircuitOrder = false;
	
	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchClientId"=>"setSearchClientId",
		"searchThemeId"=>"setSearchThemeId",
		"searchCircuitId"=>"setSearchCircuitId",
		"searchType"=>"setSearchType",
		"searchWorkforceId"=>"setSearchWorkforceId",
		"searchFromDate"=>"setSearchFromDate",
		"searchToDate"=>"setSearchToDate",
		"searchExactDate"=>"setSearchExactDate",
	);
	
	/**
	 * Especifica un Client Id para una busqueda personalizada.
	 *
	 * @param $clientId integer id de cliente
	 */
	public function setSearchClientId($searchClientId) {
		$this->searchClientId = $searchClientId;
	}
	
	/**
	 * Especifica un ordenamiento por valor de ordenamiento del circuito
	 *
	 */	
	public function orderByCircuitOrder() {
		$this->orderByCircuitOrder = true;
	}
	
	/**
	 * Especifica un Theme Id para una busqueda personalizada.
	 *
	 * @param $themeId integer id de theme
	 */
	public function setSearchThemeId($searchThemeId) {
		$this->searchThemeId = $searchThemeId;
	}

	/**
	 * Especifica un Circuit para una busqueda personalizada.
	 *
	 * @param $circuitId integer id de circuit
	 */
	public function setSearchCircuitId($searchCircuitId) {
		$this->searchCircuitId = $searchCircuitId;
	}

	/**
	 * Especifica un Tipo de cartelera para una busqueda personalizada.
	 *
	 * @param $type integer id de type
	 */
	public function setSearchType($searchType) {
		$this->searchType = $searchType;
	}

	/**
	 * Especifica una fuerza de trabajo para una busqueda personalizada.
	 *
	 * @param $workforceId integer id de workforce
	 */
	public function setSearchWorkforceId($searchWorkforceId) {
		$this->searchWorkforceId = $searchWorkforceId;
	}

	/**
	 * Especifica una fecha desde para una busqueda personalizada.
	 *
	 * @param $fromDate string YYYY-MM-DD
	 */
	public function setSearchFromDate($searchFromDate) {
		if (!empty($searchFromDate))
			$this->searchFromDate = Common::convertToMysqlDateFormat($searchFromDate);
	}
	
	/**
	 * Especifica una fecha especifica para avisos.
	 *
	 * @param $fromDate string YYYY-MM-DD
	 */
	public function setSearchExactDate($searchExactDate) {
		if (!empty($searchExactDate))
			$this->searchExactDate = Common::convertToMysqlDateFormat($searchExactDate);
	}	

	/**
	 * Especifica una fecha hasta para una busqueda personalizada.
	 *
	 * @param $toDate string YYYY-MM-DD
	 */
	public function setSearchToDate($searchToDate) {
		if (!empty($searchToDate))
			$this->searchToDate = Common::convertToMysqlDateFormat($searchToDate);
	}
	
	/*
	 * Activa que el filtro muestre avisos relacionados a motivos inactivos
	 *
	 */
	public function setAllThemes() {
		$this->allThemes = true;
	}
	
	/*
	 * Agrupa por direccion y motivo
	 *
	 */
	public function setNoGroupByAddressAndTheme() {
		$this->groupByAddressAndTheme = false;
	}	
	
	public function getGroupByAddressAndTheme() {
		return $this->groupByAddressAndTheme;
	}
	
	/**
	 * Especifica busqueda de carteleras sextuples sin workforce asignada
	 *
	 */
	public function setWithoutWorkforce() {
		$this->workforceId = 0;
	}			

	/**
	 * Especifica busqueda de carteleras sextuples sin workforce asignada
	 *
	 */
	public function setForReport() {
		$this->forReport = 1;
	}			

	public function hasOverlapping($publishDate,$duration,$billboardId,$advertId = null) {
		$criteria = new AdvertisementQuery();		
		
		$criteria->filterByPublished($publishDate, $duration);
		$criteria->filterByBillboardId($billboardId);
		
		//Si tenemos $advertId, nos fijamos que al menos uno de los resultados sea distinto
		//del $advertId indicado.
		if ($advertId != null)
			$criteria->filterById($advertId, Criteria::NOT_EQUAL);
	  	
	  	return $criteria->count() > 0;
	}

  /**
  * Elimina un advertisement a partir de los valores de la clave.
  *
  * @param int $id id del advertisement
  *	@return boolean true si se elimino correctamente el advertisement, false sino
  */
  function delete($id) {
  	return AdvertisementQuery::create()->filterByPrimaryKey($id)->delete();
  }

  /**
  * Obtiene la informacion de un advertisement.
  *
  * @param int $id id del advertisement
  * @return array Informacion del advertisement
  */
  function get($id) {
  	return AdvertisementQuery::create()->findPk($id);
  }

  /**
  * Obtiene todos los advertisements.
  *
  *	@return array Informacion sobre todos los advertisements
  */
  function getAll() {
	return AdvertisementQuery::create()->find();
  }
  
  /**
  * Obtiene todos los advertisements paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los advertisements
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	AdvertisementPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new AdvertisementQuery();     
    
    $pager = new PropelPager($cond,"AdvertisementPeer", "doSelect",$page,$perPage);
    return $pager;
   }    

	public function getSearchCriteria() {
		$criteria = new AdvertisementQuery();
		
		$criteria->join('Billboard',Criteria::INNER_JOIN);
		$criteria->join('Theme',Criteria::INNER_JOIN);
		$criteria->join('Billboard.Address',Criteria::INNER_JOIN);
		$criteria->join('Address.Circuit',Criteria::INNER_JOIN);
		
		//condicion que solo se consideran los aviso relacionados a motivos activos
		if (!$this->allThemes)
			$criteria->useQuery('Theme')
						->filterByActive(1)
					 ->endUse();
		
		if (!empty($this->searchClientId)) {
			$criteria->useQuery('Theme')
						->filterByClientId($this->searchClientId)
					 ->endUse();
		}
		
		if (!empty($this->searchThemeId)) {
			$criteria->filterByThemeId($this->searchThemeId);
		}

		if (!empty($this->searchType)) {
			$criteria->useQuery('Billboard')
						->filterByType($this->searchType)
					 ->endUse();
		}

		if (!empty($this->searchCircuitId)) {
			$criteria->useQuery('Address')
						->filterByType($this->searchCircuitId)
					 ->endUse();
		}

		if ($this->searchWorkforceId >= 0 && $this->forReport !=1) {
			//las workforce solo son para sextuples
			$criteria->filterByWorkforceId($this->searchWorkforceId);
		}
	
		if (!empty($this->searchFromDate)) {			
			$sql = '('. "'" . $this->searchFromDate . "'" .' >= lausi_advertisement.publishDate) AND ('. "'" . $this->searchFromDate . "'" .' <= DATE_ADD(lausi_advertisement.publishDate,INTERVAL lausi_advertisement.duration DAY))';
			$criteria->where($sql);
		}
		
		if ($this->orderByCircuitOrder) {
			$criteria->useQuery('Circuit')
						->orderByOrderby()
					 ->endUse();
		}
		
		if (!empty($this->searchToDate)) {
			$sql = '('. "'" . $this->searchToDate . "'" .' >= lausi_advertisement.publishDate) AND ('. "'" . $this->searchToDate . "'" .' <= DATE_ADD(lausi_advertisement.publishDate,INTERVAL lausi_advertisement.duration DAY))';
			$criteria->where($sql);
		}
		
		if (!empty($this->searchExactDate)) {		
			$criteria->filterByPublishDate($this->searchExactDate);
		}
		
		if ($this->groupByAddressAndTheme) {
			$criteria->groupBy('Billboard.Addressid');
			$criteria->groupBy('Advertisement.Themeid');
			$criteria->withColumn("count(".AdvertisementPeer::ID.")", "themesCount");
		}
		
		return $criteria;
	}

  /**
  * Obtiene todos los advertisements paginados.
  * Si hay condiciones de filtrado aplicadas al AdvertisementPeer, las aplica
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los advertisements
  */
  function getAllPaginatedFiltered($page=1,$perPage=-1) {  
	if ($perPage == -1)
      $perPage = 	Common::getRowsPerPage();
    if (empty($page))
      $page = 1;

    $cond = $this->getSearchCriteria();	    

    $pager = new PropelPager($cond,"AdvertisementPeer", "doSelect",$page,$perPage);
    return $pager;
   }    
   
	/**
	* Obtiene todos los advertisements vigentes para una cierta direccion.
	*   @param integer Id de la direccion
	*	@return array Informacion sobre todos los advertisements
	*/
	function getAllCurrentByAddress($addressId) {
		$address = AddressPeer::get($addressId);
		if (empty($address))
			return false;
		
		return AdvertisementQuery::create()
			->filterByCurrent()
			->filterByAddress($address)
			->find();
	}
	
	/**
	 * Extiende un aviso una cantidad de dias
	 *
	 * @param integer id de advertisement
	 * @param integer extension de la duracion
	 */
	public function extendAdvertisement($id,$extension) {
		
		$advert = AdvertisementPeer::get($id);
		
		if (empty($advert))
			return false;
		
		//la extension debe ser mayor a cero
		if ($extension <= 0)
			return false;	

		$newDuration = $extension + ($advert->getDuration());
		$billboardId = $advert->getBillboardId();
		
		if (AdvertisementPeer::hasOverlapping($advert->getPublishDate(),$newDuration,$billboardId,$advert->getId())) {
			return false;
		}
		
		try {
			$advert->setDuration($newDuration);
			$advert->save();
		}
		catch(PropelException $exp) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * reduce un aviso una cantidad de dias
	 *
	 * @param integer id de advertisement
	 * @param integer reduccion de la duracion
	 */
	public function reduceAdvertisement($id,$reduction) {
		
		$advert = AdvertisementPeer::get($id);
		
		if (empty($advert))
			return false;
		
		//la reduccion debe ser mayor a cero
		if ($reduction <= 0)
			return false;	

		$newDuration = ($advert->getDuration()) - $reduction;
		// no puede su duracion ser menor o igual a cero
		if ($newDuration <= 0) {
			return false;
		}
		try {
			$advert->setDuration($newDuration);
			$advert->save();
		}
		catch(PropelException $exp) {
			return false;
		}
		
		return true;
	}
	
	/*
	 * Indica la cantidad de avisos que tiene un cierto motivo
	 * @param integer $themeId
	 * @return integer cantidad de avisos
	 *
	 */
	function getAllByThemeCount($themeId=0) {
		return AdvertisementQuery::create()
			->filterByThemeId($themeId)
			->count();
	}
	
	function getAllFiltered() {
		$criteria = $this->getSearchCriteria();
		return $criteria->find();
	}
}
