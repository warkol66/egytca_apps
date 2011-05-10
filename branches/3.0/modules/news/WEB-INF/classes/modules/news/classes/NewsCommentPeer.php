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

  private $articleId;
  private $status;
  private $toDate;
  private $fromDate;

  /**
   * Define un id de articulo para la creacion de una criteria de busqueda
   * @param integer id de articulo
   */
	public function setArticleId($articleId) {
		
		$this->articleId = $articleId;
		return true;
	}
	
	/**
	 * Define un status para la creacion de una criteria de busqueda
	 * @param integer status de comentario
	 */
	public function setStatus($status) {
		
		$this->status = $status;
		return true;
	}
	
	/**
	 * Especifica una fecha desde para una busqueda personalizada.
	 *
	 * @param $fromDate string YYYY-MM-DD
	 */
	public function setFromDate($fromDate) {
		
		$this->fromDate = $fromDate;
		
	}

	/**
	 * Especifica una fecha hasta para una busqueda personalizada.
	 *
	 * @param $toDate string YYYY-MM-DD
	 */
	public function setToDate($toDate) {
		
		$this->toDate = $toDate;
		
	}
		
	
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
  * Crea un comentario nuevo.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se creo correctamente, false sino
  */  
  function create($params) {
    try {
      $newscommentObj = new NewsComment();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newscommentObj,$setMethod) ) {          
          if (!empty($value) || $value == "0")
            $newscommentObj->$setMethod($value);
          else
            $newscommentObj->$setMethod(null);
        }
      }
	
	 //guardamos fecha de creacion
	 $newscommentObj->setCreationDate(date('Y-m-d H:m:s'));

	 //regla de negocio, si se indica un usuario de sistema el mensaje directamente se encuentra aprobado
	 //TODO: Cuando se incorpore usuarios por registracion, agregar verificacion de usuario existente.
	 if ($params['newscomment']['userId']) {
		$newscommentObj->setStatus(NEWSCOMMENT_APPROVED);
	 }
	 else {
		$newscommentObj->setStatus(NEWSCOMMENT_PENDING);
	 }

      $newscommentObj->save();
      return $newscommentObj;
    } catch (Exception $exp) {
      return false;
    }         
  }  
  
  /**
  * Actualiza la informacion de un comentario.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se actualizo la informacion correctamente, false sino
  */  
  function update($params) {
    try {

      $newscommentObj = NewsCommentPeer::retrieveByPK($params["id"]);    
      if (empty($newscommentObj))
        throw new Exception();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newscommentObj,$setMethod) ) {          
          if (!empty($value) || $value == "0")
            $newscommentObj->$setMethod($value);
          else
            $newscommentObj->$setMethod(null);
        }
      }

      $newscommentObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }    

	/**
	* Elimina un comentario a partir de los valores de la clave.
	*
  * @param int $id id del newscomment
	*	@return boolean true si se elimino correctamente el newscomment, false sino
	*/
  function delete($id) {
  	$newscommentObj = NewsCommentPeer::retrieveByPK($id);
    $newscommentObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un comentario.
  *
  * @param int $id id del newscomment
  * @return array Informacion del newscomment
  */
  function get($id) {
		$newscommentObj = NewsCommentPeer::retrieveByPK($id);
    return $newscommentObj;
  }

  /**
  * Obtiene todos los comentarios.
	*
	*	@return array Informacion sobre todos los newscomments
  */
	function getAll() {
		$cond = new Criteria();
		$alls = NewsCommentPeer::doSelect($cond);
		return $alls;
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
	 * Obtiene todos los comentarios por articulo
	 * @param integer $articleId
	 * @return array instancias de NewsComment
	 */
	function getAllByArticle($articleId) {  
	
		$criteria = new Criteria();
		$criteria->add(NewsCommentPeer::ARTICLEID,$articleId);
		return NewsCommentPeer::doSelect($criteria);
	
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
