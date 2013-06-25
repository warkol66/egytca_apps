<?php

/**
 * Class NewsArticlePeer
 *
 * @package NewsArticle
 */
class NewsArticlePeer extends BaseNewsArticlePeer {


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
	 *
	public function getLastArticles($quantity) {
		
		$criteria = new Criteria();
		$criteria->addDescendingOrderByColumn(NewsArticlePeer::CREATIONDATE);
		$criteria->add(NewsArticlePeer::STATUS,NewsArticlePeer::PUBLISHED);
		$criteria->setLimit($quantity);
		
		return NewsArticlePeer::doSelect($criteria);
		
	}*/
  
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
