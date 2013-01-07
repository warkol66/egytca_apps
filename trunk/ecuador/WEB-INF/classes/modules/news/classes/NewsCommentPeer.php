<?php

// The parent class
require_once 'om/BaseNewsCommentPeer.php';

// The object class
include_once 'NewsComment.php';



/**
 * Class NewsCommentPeer
 *
 * @package NewsComment
 */
class NewsCommentPeer extends BaseNewsCommentPeer {


 
  /**
  * Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
  *
  * @return int Cantidad de filas por pagina
  */
  function getRowsPerPage() {
    global $system;
    return $system["config"]["system"]["rowsPerPage"];
  }
  
  /**
  * Obtiene todos los comentarios paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newscomments
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsCommentPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();
    $pager = new PropelPager($cond,"NewsCommentPeer", "doSelect",$page,$perPage);
    return $pager;
   }

	/**
	 * Obtiene todos los comentarios aprobados por articulo
	 * @param integer $articleId
	 * @return array instancias de NewsComment
	 */
	function getAllApprovedByArticle($articleId) {  
	
		$criteria = new Criteria();
		$criteria->add(NewsCommentPeer::ARTICLEID,$articleId);
		$criteria->add(NewsCommentPeer::STATUS,NEWSCOMMENT_APPROVED);
		return NewsCommentPeer::doSelect($criteria);
	
	}

	/**
	 * Devuelve una criteria para utilizar a partir de los valores de 
	 * filtro indicados en la instancia
	 * @return Criteria instancia de criteria.
	 */
	private function getCriteria() {
		
		$criteria = new Criteria();
		
		if (!empty($this->articleId)) {
			$criteria->add(NewsCommentPeer::ARTICLEID,$this->articleId);
		}
		
		if (!empty($this->status)) {
			$criteria->add(NewsCommentPeer::STATUS,$this->status);
		}
		
		if (!empty($this->fromDate) && ! empty($this->toDate)) {
			$criterion = $criteria->getNewCriterion(NewsCommentPeer::CREATIONDATE, $this->fromDate . ' 00:00:00', Criteria::GREATER_EQUAL);
			$criterion->addAnd($criteria->getNewCriterion(NewsCommentPeer::CREATIONDATE, $this->toDate . ' 24:59:59', Criteria::LESS_EQUAL));
			$criteria->add($criterion);
		}
		else {

			if (!empty($this->fromDate)) {
				$criteria->add(NewsCommentPeer::CREATIONDATE, $this->fromDate . ' 00:00:00', Criteria::GREATER_EQUAL);
			}

			if (!empty($this->toDate)) {

				$criteria->add(NewsCommentPeer::CREATIONDATE,$this->toDate . ' 24:59:59', Criteria::LESS_EQUAL);
			}
		}

		$criteria->addDescendingOrderByColumn(NewsCommentPeer::CREATIONDATE);
		
		return $criteria;

	}

  /**
  * Obtiene todos los comentarios paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newscomments
  */
  function getAllPaginatedFiltered($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsCommentPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = $this->getCriteria();
    $pager = new PropelPager($cond,"NewsCommentPeer", "doSelect",$page,$perPage);
    return $pager;
   }   

}
