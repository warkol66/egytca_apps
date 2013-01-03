<?php

/**
 * Class NewsArticlePeer
 *
 * @package NewsArticle
 */
class NewsArticlePeer extends BaseNewsArticlePeer {

	private $orderByDate = false;
	private $orderByUpdateDate = false;
	private $archiveMode = false;
	private $publishedMode = false;
	private $fromDate;
	private $toDate;
	private $category;
	private $searchString;
	private $moduleConfig;
	private $newsInHome;

	/**
	 * Especifica una cadena de busqueda. Cada palabra de la cadena sera extraida y buscada en
	 * titulos, descripcion, copete, etc.
	 * @param string cadena de busqueda.
	 */
	public function setSearchString($string) {
		$this->searchString = $string;
	}


  /**
   * Aplica ordenamiento por fecha a las consultas
   */	
  public function setOrderByDate() {

    $this->orderByDate = true;
	
  }

  /**
   * Aplica ordenamiento por fecha de actualizacion a las consultas
   */	
  public function setOrderByUpdateDate() {

    $this->orderByUpdateDate = true;
	
  }

  /**
   * Aplica ordenamiento por fecha de creaci�n a las consultas
   */	
  public function setOrderByCreationDate() {

    $this->orderByCreationDate = true;
	
  }

  public function setArchiveMode() {

  	$this->archiveMode = true;
    $this->archiveAndpublishedMode = false;
	
  }
  
  public function setPublishedMode() {
	
	$this->publishedMode = true;
  $this->archiveAndpublishedMode = false;
	
  }

  public function setArchiveAndPublishedMode() {
  
    $this->archiveAndpublishedMode = true;
    $this->publishedMode = false;
    $this->archiveMode = false;
    
  }
  
  public function setCategory($category) {

	$this->category = $category;
	
  }
  
  public function setRegion($region) {

  $this->region = $region;

  }

  /**
   * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
   * @return Criteria instancia de criteria
   */
  private function getCriteria() {
	$criteria = new Criteria();
	
	$criteria->setIgnoreCase(true);

	if ($this->orderByDate)
		$criteria->addDescendingOrderByColumn(NewsArticlePeer::CREATIONDATE);

	if ($this->orderByCreationDate)
		$criteria->addDescendingOrderByColumn(NewsArticlePeer::CREATIONDATE);

	if ($this->orderByUpdateDate)
		$criteria->addDescendingOrderByColumn(NewsArticlePeer::LASTUPDATE);	
	
	if ($this->archiveMode) {
    $criteria->add(NewsArticlePeer::STATUS,NewsArticlePeer::ARCHIVED);		
	}
	
	if ($this->publishedMode)
		$criteria->add(NewsArticlePeer::STATUS,NewsArticlePeer::PUBLISHED);
    
  if (!empty($this->archiveAndpublishedMode)) {
    $criterion = $criteria->getNewCriterion(NewsArticlePeer::STATUS, NewsArticlePeer::ARCHIVED);
    $criterion->addOr($criteria->getNewCriterion(NewsArticlePeer::STATUS, NewsArticlePeer::PUBLISHED));
    $criteria->add($criterion);
  }
		
	if (!empty($this->fromDate) && ! empty($this->toDate)) {
		$criterion = $criteria->getNewCriterion(NewsArticlePeer::CREATIONDATE, $this->fromDate, Criteria::GREATER_EQUAL);
		$criterion->addAnd($criteria->getNewCriterion(NewsArticlePeer::CREATIONDATE, $this->toDate, Criteria::LESS_EQUAL));
		$criteria->add($criterion);
	}
	else {
		
		if (!empty($this->fromDate)) {
			$criteria->add(NewsArticlePeer::CREATIONDATE, $this->fromDate, Criteria::GREATER_EQUAL);
		}
		
		if (!empty($this->toDate)) {
			
			$criteria->add(NewsArticlePeer::CREATIONDATE,$this->toDate, Criteria::LESS_EQUAL);
		}
	}
	
	if (!empty($this->category)) {
		$category = $this->category;
		$criteria->add(NewsArticlePeer::CATEGORYID,$category->getId());
	}
  
  if (!empty($this->region)) {
    $region = $this->region;
    $criteria->add(NewsArticlePeer::REGIONID,$region->getId());
  }
	
	if (!empty($this->searchString)) {
		//separamos por palabras
		$words = explode(' ',$this->searchString);
		
		foreach ($words as $word) {
		
      $sql = "( ".NewsArticlePeer::TITLE." like '%".$word."%' )";
			if (!isset($criterionTitle))
				$criterionTitle = $criteria->getNewCriterion(NewsArticlePeer::TITLE,$sql,Criteria::CUSTOM);
			else {
				$criterionTitle->addOr($criteria->getNewCriterion(NewsArticlePeer::TITLE,$sql,Criteria::CUSTOM));
			}
			
      $sql = "( ".NewsArticlePeer::SUBTITLE." like '%".$word."%' )";
			if (!isset($criterionSubtitle))
				$criterionSubtitle = $criteria->getNewCriterion(NewsArticlePeer::SUBTITLE,$sql,Criteria::CUSTOM);
			else	$criterionSubtitle->addOr($criteria->getNewCriterion(NewsArticlePeer::SUBTITLE,$sql,Criteria::CUSTOM));
			
      $sql = "( ".NewsArticlePeer::BODY." like '%".$word."%' )";
			if (!isset($criterionBody))
				$criterionBody = $criteria->getNewCriterion(NewsArticlePeer::BODY,$sql,Criteria::CUSTOM);
			else {
	$criterionBody->addOr($criteria->getNewCriterion(NewsArticlePeer::BODY,$sql,Criteria::CUSTOM));
			}
			
			$sql = "( ".NewsArticlePeer::SUMMARY." like '%".$word."%' )";
      if (!isset($criterionSummary))
				$criterionSummary = $criteria->getNewCriterion(NewsArticlePeer::SUMMARY,$sql,Criteria::CUSTOM);
			else {
	$criterionSummary->addOr($criteria->getNewCriterion(NewsArticlePeer::SUMMARY,$sql,Criteria::CUSTOM));
			}			
														
		}
		
		$criterionTitle->addOr($criterionSubtitle);
		$criterionTitle->addOr($criterionBody);
		$criterionTitle->addOr($criterionSummary);		
		$criteria->add($criterionTitle);

	}

	return $criteria;
	
  }

  /**
   * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
   * @return Criteria instancia de criteria
   */
  private function getCriteriaForShow() {
		$criteria = new Criteria();
		
		$criteria->setIgnoreCase(true);
	
		if ($this->orderByDate)
			$criteria->addDescendingOrderByColumn(NewsArticlePeer::CREATIONDATE);
	
		if ($this->orderByCreationDate)
			$criteria->addDescendingOrderByColumn(NewsArticlePeer::CREATIONDATE);
	
		if ($this->orderByUpdateDate)
			$criteria->addDescendingOrderByColumn(NewsArticlePeer::LASTUPDATE);
	
		if ($this->archiveMode) 
	    $criteria->add(NewsArticlePeer::STATUS,NewsArticlePeer::ARCHIVED);
	
		if ($this->publishedMode)
			$criteria->add(NewsArticlePeer::STATUS,NewsArticlePeer::PUBLISHED);
	
	  if (!empty($this->archiveAndpublishedMode)) {
	    $criterion = $criteria->getNewCriterion(NewsArticlePeer::STATUS, NewsArticlePeer::ARCHIVED);
	    $criterion->addOr($criteria->getNewCriterion(NewsArticlePeer::STATUS, NewsArticlePeer::PUBLISHED));
	    $criteria->add($criterion);
	  }

		return $criteria;
	
  }

  /**
  * Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
  *
  * @return int Cantidad de filas por pagina
  */
  function getRowsPerPage() {
  	$moduleConfig = Common::getModuleConfiguration('News');
  	if ($moduleConfig["newsPerPage"] > 0)
	    return $moduleConfig["newsPerPage"];
	  else {
	  	$systemConfig = Common::getModuleConfiguration('System');
	  	return $systemConfig['rowsPerPage'];
	  }
  }

  /**
  * Obtiene todos los noticias aplicando los filtros correspondientes.
	*
	*	@return array Informacion sobre todos los newsarticles
  */
	function getAllFiltered() {
		$cond = $this->getCriteria(); 	
		$alls = NewsArticlePeer::doSelect($cond);
		return $alls;
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
      $perPage = 	NewsArticlePeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"NewsArticlePeer", "doSelect",$page,$perPage);
    return $pager;
   }

   
  /**
  * Obtiene todos los noticias paginados con las opciones de filtro asignadas al peer.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $start [optional] Salto de noticias en el home
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newsarticles
  */
  function getAllPaginatedFilteredForShow($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsArticlePeer::getRowsPerPage();
    $criteria = $this->getCriteriaForShow();     
		$moduleConfig = Common::getModuleConfiguration('News');

    $pager = new PropelPager($criteria,"NewsArticlePeer", "doSelect",$page,$perPage);

		//Hack para generar páginas si se quiere tener primera página diferente, implica uso de paginador especial
		$pager->setStart($moduleConfig["newsInHome"] + ($perPage * ($page - 1 )));
		$pager->setMax($moduleConfig["newsInHome"] + ($perPage * $page ));
		
    return $pager;
   }

  /**
  * Obtiene todos los noticias paginados para el home.
  *
  * @param int $newsInHome [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newsarticles
  */
  function getAllPaginatedFilteredForHome($newsInHome=5) {  
    $cond = $this->getCriteria();     
    $pager = new PropelPager($cond,"NewsArticlePeer", "doSelect",1,$newsInHome);
    return $pager;
   }

   /** 
   * Obtiene las noticias mas vistas 
   * 
   * @return array Informacion sobre los newsarticles mas vistos
   */
   function getMostViewed() {
    global $system;
    
    $newsInHome = $system["config"]["news"]["newsInHome"];
    $newsMostView = $system["config"]["news"]["newsMostViewed"];
    $newsMostViewPeriod = $system["config"]["news"]["newsMostViewPeriod"];

    $this->setOrderByCreationDate();
    $this->setPublishedMode();
    $pager = $this->getAllPaginatedFiltered(1,$newsInHome);
    $newsArticles = $pager->getResult();
    
    $IdsHome = array();
        foreach($newsArticles as $newsArticle) {
            $id = $newsArticle->getId();
            $IdsHome[] = $id;
        }		
           
     $criteria = new Criteria();
     
     $sql = "( ".NewsArticlePeer::CREATIONDATE." > DATE_SUB(now(),interval ".$newsMostViewPeriod." DAY))";
     $criteria->add(NewsArticlePeer::CREATIONDATE,$sql,Criteria::CUSTOM);        
     $criteria->addDescendingOrderByColumn(NewsArticlePeer::VIEWS);
     $criteria->setLimit($newsMostView);
     $criteria->add(NewsArticlePeer::ID, $IdsHome, Criteria::NOT_IN);
     
     return NewsArticlePeer::doSelect($criteria);
     
     
   }

	/**
	 * Obtiene los ultimos N articulos publicados
	 * @param integer cantidad de ultimos articulos publicados a obtener
	 * @return Array array de instancias de NewsArticle
	 */
	public function getLastArticles($quantity) {
		
		$criteria = new Criteria();
		$criteria->addDescendingOrderByColumn(NewsArticlePeer::CREATIONDATE);
		$criteria->add(NewsArticlePeer::STATUS,NewsArticlePeer::PUBLISHED);
		$criteria->setLimit($quantity);
		
		return NewsArticlePeer::doSelect($criteria);
		
	}
  
	/**
	 * Obtiene los ultimos N articulos actualizados
	 * @param integer cantidad de ultimos articulos publicados a obtener
	 * @return Array array de instancias de NewsArticle
	 */
	public function getLastUpdated($quantity) {
		
		$criteria = new Criteria();
		$criteria->addDescendingOrderByColumn(NewsArticlePeer::LASTUPDATE);
		$criteria->add(NewsArticlePeer::STATUS,NewsArticlePeer::PUBLISHED);
		$criteria->setLimit($quantity);
		
		return NewsArticlePeer::doSelect($criteria);
		
	}

/*
 * Seccion de Include
 */

  function getIncludeArticle() { 
		$criteria = new Criteria();
		$criteria->addDescendingOrderByColumn(NewsArticlePeer::LASTUPDATE);
		$criteria->add(NewsArticlePeer::STATUS,NewsArticlePeer::PUBLISHED);
		
		return NewsArticlePeer::doSelectOne($criteria);

  }

}
