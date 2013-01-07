<?php

// The parent class
require_once 'om/BaseNewsMediaPeer.php';

// The object class
include_once 'NewsMedia.php';

/**
 * Class NewsMediaPeer
 *
 * @package NewsMedia
 */
class NewsMediaPeer extends BaseNewsMediaPeer {

  /**
   * Crea una criteria a partir de las condiciones de filtro seteadas en el NewsMediaPeer.
   *
   * @return Criteria instancia de Criteria
   */
  public function getCriteria() {
	
	$criteria = new Criteria();
	
	$criteria->addJoin(NewsMediaPeer::ARTICLEID,NewsArticlePeer::ID,Criteria::INNER_JOIN);
	
	if (!empty($this->mediaType)) {
		$criteria->add(NewsMediaPeer::MEDIATYPE,$this->mediaType);
	}
	
	if (!empty($this->category)) {
		$category = $this->category;
		$criteria->add(NewsArticlePeer::CATEGORYID,$category->getId());
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
	
	return $criteria;
	
  }

  /**
  * Obtiene todos los medias paginados aplicando la criteria de filtro.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newsmedias
  */
  public function getAllPaginatedFiltered($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsMediaPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = $this->getCriteria();
   
    $pager = new PropelPager($cond,"NewsMediaPeer", "doSelect",$page,$perPage);
    return $pager;
   }  
  
  /** Eliminarla al migrar cambio de orden
   * Cambia el orden de un newsmedia en su tipo
   * @param integer id del media a cambiar el orden
   * @param integer nueva posicion.
   */
  public function changeNewsMediaOrder($mediaId,$pos) {
	
	try {
		$newsMedia = NewsMediaPeer::get($mediaId);
		$newsMedia->setOrder($pos);
		$newsMedia->save();
	}
	catch (PropelException $exp) {
		return false;
	}
	
	return true;
	
  }

}
