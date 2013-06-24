<?php

// The parent class
require_once 'map/NewsletterTemplateExternalMapBuilder.php';
require_once 'om/BaseNewsletterTemplateExternalPeer.php';

// The object class
include_once 'NewsletterTemplateExternal.php';

/**
 * Class NewsletterTemplateExternalPeer
 *
 * @package NewsletterTemplateExternal
 */
class NewsletterTemplateExternalPeer extends BaseNewsletterTemplateExternalPeer {

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
  * Crea un newsletter external template nuevo.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se creo correctamente, false sino
  */  
  function create($params) {
    try {
      $newslettertemplateexternalObj = new NewsletterTemplateExternal();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newslettertemplateexternalObj,$setMethod) ) {          
          if (!empty($value))
            $newslettertemplateexternalObj->$setMethod($value);
          else
            $newslettertemplateexternalObj->$setMethod(null);
        }
      }
      $newslettertemplateexternalObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }  
  
  /**
  * Actualiza la informacion de un newsletter external template.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se actualizo la informacion correctamente, false sino
  */  
  function update($params) {
    try {
      $newslettertemplateexternalObj = NewsletterTemplateExternalPeer::retrieveByPK($params["id"]);    
      if (empty($newslettertemplateexternalObj))
        throw new Exception();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newslettertemplateexternalObj,$setMethod) ) {          
          if (!empty($value))
            $newslettertemplateexternalObj->$setMethod($value);
          else
            $newslettertemplateexternalObj->$setMethod(null);
        }
      }
      $newslettertemplateexternalObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }    

	/**
	* Elimina un newsletter external template a partir de los valores de la clave.
	*
  * @param int $id id del newslettertemplateexternal
	*	@return boolean true si se elimino correctamente el newslettertemplateexternal, false sino
	*/
  function delete($id) {
  	$newslettertemplateexternalObj = NewsletterTemplateExternalPeer::retrieveByPK($id);
    $newslettertemplateexternalObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un newsletter external template.
  *
  * @param int $id id del newslettertemplateexternal
  * @return array Informacion del newslettertemplateexternal
  */
  function get($id) {
		$newslettertemplateexternalObj = NewsletterTemplateExternalPeer::retrieveByPK($id);
    return $newslettertemplateexternalObj;
  }

  /**
  * Obtiene todos los newsletter external templates.
	*
	*	@return array Informacion sobre todos los newslettertemplateexternals
  */
	function getAll() {
		$cond = new Criteria();
		$alls = NewsletterTemplateExternalPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los newsletter external templates paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newslettertemplateexternals
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsletterTemplateExternalPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"NewsletterTemplateExternalPeer", "doSelect",$page,$perPage);
    return $pager;
   }


}
?>
