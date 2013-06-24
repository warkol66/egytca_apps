<?php

// The parent class
require_once 'map/NewsletterMapBuilder.php';
require_once 'om/BaseNewsletterPeer.php';

// The object class
include_once 'Newsletter.php';

/**
 * Class NewsletterPeer
 *
 * @package Newsletter
 */
class NewsletterPeer extends BaseNewsletterPeer { 

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
  * Crea un newsletter nuevo.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se creo correctamente, false sino
  */  
  function create($params) {
    try {
      $newsletterObj = new Newsletter();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newsletterObj,$setMethod) ) {          
          if (!empty($value))
            $newsletterObj->$setMethod($value);
          else
            $newsletterObj->$setMethod(null);
        }
      }
      $newsletterObj->save();
      return $newsletterObj;
    } catch (Exception $exp) {
      return false;
    }         
  }  
  
  /**
  * Actualiza la informacion de un newsletter.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se actualizo la informacion correctamente, false sino
  */  
  function update($params) {
    try {
      $newsletterObj = NewsletterPeer::retrieveByPK($params["id"]);    
      if (empty($newsletterObj))
        throw new Exception();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newsletterObj,$setMethod) ) {          
          if (!empty($value))
            $newsletterObj->$setMethod($value);
          else
            $newsletterObj->$setMethod(null);
        }
      }
      $newsletterObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }    

	/**
	* Elimina un newsletter a partir de los valores de la clave.
	*
  * @param int $id id del newsletter
	*	@return boolean true si se elimino correctamente el newsletter, false sino
	*/
  function delete($id) {
  	$newsletterObj = NewsletterPeer::retrieveByPK($id);
    $newsletterObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un newsletter.
  *
  * @param int $id id del newsletter
  * @return array Informacion del newsletter
  */
  function get($id) {
		$newsletterObj = NewsletterPeer::retrieveByPK($id);
    return $newsletterObj;
  }

  /**
  * Obtiene todos los newsletters.
	*
	*	@return array Informacion sobre todos los newsletters
  */
	function getAll() {
		$cond = new Criteria();
		$alls = NewsletterPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los newsletters paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newsletters
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsletterPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"NewsletterPeer", "doSelect",$page,$perPage);
    return $pager;
   }

	/** 
	 * Devuelve la cantidad de Newsletters enviados de un cierto template.
	 * @param NewsletterTemplate instance
	 * @return integer
	 */
	public function getSentCount($newsletterTemplate) {
		
		$criteria = new Criteria();
		$criteria->add(NewsletterPeer::NEWSLETTERTEMPLATEID,$newsletterTemplate->getId());
		
		return NewsletterPeer::doCount($criteria);
	}

}
?>
