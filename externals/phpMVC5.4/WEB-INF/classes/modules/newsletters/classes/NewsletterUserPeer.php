<?php
/**
 * Class NewsletterUserPeer
 *
 * @package NewsletterUser
 */
class NewsletterUserPeer extends BaseNewsletterUserPeer {

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
  * Crea un newsletter user nuevo.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se creo correctamente, false sino
  */  
  function create($params) {
    try {
      $newsletteruserObj = new NewsletterUser();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newsletteruserObj,$setMethod) ) {          
          if (!empty($value))
            $newsletteruserObj->$setMethod($value);
          else
            $newsletteruserObj->$setMethod(null);
        }
      }
      $newsletteruserObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }  
  
  /**
  * Actualiza la informacion de un newsletter user.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se actualizo la informacion correctamente, false sino
  */  
  function update($params) {
    try {
      $newsletteruserObj = NewsletterUserPeer::retrieveByPK($params["newsletterId"],$params["registrationUserId"]);    
      if (empty($newsletteruserObj))
        throw new Exception();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newsletteruserObj,$setMethod) ) {          
          if (!empty($value))
            $newsletteruserObj->$setMethod($value);
          else
            $newsletteruserObj->$setMethod(null);
        }
      }
      $newsletteruserObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }    

	/**
	* Elimina un newsletter user a partir de los valores de la clave.
	*
  * @param int $newsletterId newsletterId del newsletteruser
  * @param int $registrationUserId registrationUserId del newsletteruser
	*	@return boolean true si se elimino correctamente el newsletteruser, false sino
	*/
  function delete($newsletterId,$registrationUserId) {
  	$newsletteruserObj = NewsletterUserPeer::retrieveByPK($newsletterId,$registrationUserId);
    $newsletteruserObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un newsletter user.
  *
  * @param int $newsletterId newsletterId del newsletteruser
  * @param int $registrationUserId registrationUserId del newsletteruser
  * @return array Informacion del newsletteruser
  */
  function get($newsletterId,$registrationUserId) {
		$newsletteruserObj = NewsletterUserPeer::retrieveByPK($newsletterId,$registrationUserId);
    return $newsletteruserObj;
  }

  /**
  * Obtiene todos los newsletter users.
	*
	*	@return array Informacion sobre todos los newsletterusers
  */
	function getAll() {
		$cond = new Criteria();
		$alls = NewsletterUserPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los newsletter users paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newsletterusers
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsletterUserPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    //require_once("propel/util/PropelPager.php");
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"NewsletterUserPeer", "doSelect",$page,$perPage);
    return $pager;
   }    

}
?>
