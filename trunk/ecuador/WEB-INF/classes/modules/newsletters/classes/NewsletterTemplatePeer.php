<?php
/**
 * Class NewsletterTemplatePeer
 *
 * @package NewsletterTemplate
 */
class NewsletterTemplatePeer extends BaseNewsletterTemplatePeer {
	
	const DYNAMIC_SUBJECT_MASK_DATE = 1;
	const DYNAMIC_SUBJECT_MASK_NUMBER = 2;
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
   * Construye la mascara correspondiente para subject dinamico a segun los parametros ingresados
   * @param array
   */
  private function processSubjectMask($params) {

	  $mask = 0;

	  if ($params['hasDeliveryDate'] == '1')
	     	$mask = $mask + NewsletterTemplatePeer::DYNAMIC_SUBJECT_MASK_DATE;
	
	  if ($params['hasDeliveryNumber'] == '1')
	     	$mask = $mask + NewsletterTemplatePeer::DYNAMIC_SUBJECT_MASK_NUMBER;
	
	  return $mask;
	
  }

  /**
  * Crea un newsletter template nuevo.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se creo correctamente, false sino
  */  
  function create($params) {
    try {
      $newslettertemplateObj = new NewsletterTemplate();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newslettertemplateObj,$setMethod) ) {          
          if (!empty($value))
            $newslettertemplateObj->$setMethod($value);
          else
            $newslettertemplateObj->$setMethod(null);
        }
      }
	  //procesamiento de los parametros de mascara de subject dinamico	  
	  $newslettertemplateObj->setDynamicSubjectMask(NewsletterTemplatePeer::processSubjectMask($params));
	
      $newslettertemplateObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }  
  
  /**
  * Actualiza la informacion de un newsletter template.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se actualizo la informacion correctamente, false sino
  */  
  function update($params) {
    try {
      $newslettertemplateObj = NewsletterTemplatePeer::retrieveByPK($params["id"]);    
      if (empty($newslettertemplateObj))
        throw new Exception();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newslettertemplateObj,$setMethod) ) {          
          if (!empty($value))
            $newslettertemplateObj->$setMethod($value);
          else
            $newslettertemplateObj->$setMethod(null);
        }
      }
	  //procesamiento de los parametros de mascara de subject dinamico 
	  $newslettertemplateObj->setDynamicSubjectMask(NewsletterTemplatePeer::processSubjectMask($params));
	
      $newslettertemplateObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }    

	/**
	* Elimina un newsletter template a partir de los valores de la clave.
	*
  * @param int $id id del newslettertemplate
	*	@return boolean true si se elimino correctamente el newslettertemplate, false sino
	*/
  function delete($id) {
  	$newslettertemplateObj = NewsletterTemplatePeer::retrieveByPK($id);
    $newslettertemplateObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un newsletter template.
  *
  * @param int $id id del newslettertemplate
  * @return array Informacion del newslettertemplate
  */
  function get($id) {
		$newslettertemplateObj = NewsletterTemplatePeer::retrieveByPK($id);
    return $newslettertemplateObj;
  }

  /**
  * Obtiene todos los newsletter templates.
	*
	*	@return array Informacion sobre todos los newslettertemplates
  */
	function getAll() {
		$cond = new Criteria();
		$alls = NewsletterTemplatePeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los newsletter templates paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newslettertemplates
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsletterTemplatePeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    //require_once("propel/util/PropelPager.php");
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"NewsletterTemplatePeer", "doSelect",$page,$perPage);
    return $pager;
   }    

}
?>
