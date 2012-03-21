<?php

/**
 * Class AffiliateProductCodePeer
 *
 * @package AffiliateProductCode
 */
class AffiliateProductCodePeer extends BaseAffiliateProductCodePeer {

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
  * Crea un codigo de producto por afiliado nuevo.
  *
  * @param int $affiliateId affiliateId del affiliateproductcode
  * @param int $productCode productCode del affiliateproductcode
  * @param string $productCodeAffiliate productCodeAffiliate del affiliateproductcode
  * @return boolean true si se creo el affiliateproductcode correctamente, false sino
	*/
	function create($affiliateId,$productCode,$productCodeAffiliate) {
    try {
      $affiliateproductcodeObj = new AffiliateProductCode();
      $affiliateproductcodeObj->setaffiliateId($affiliateId);
      $affiliateproductcodeObj->setproductCode($productCode);
      $affiliateproductcodeObj->setproductCodeAffiliate($productCodeAffiliate);
      $affiliateproductcodeObj->save();
    }
    catch (Exception $e) {
      return false;
    }        
		return true;
	}

  /**
  * Actualiza la informacion de un codigo de producto por afiliado.
  *
  * @param int $id id del affiliateproductcode
  * @param int $affiliateId affiliateId del affiliateproductcode
  * @param int $productCode productCode del affiliateproductcode
  * @param string $productCodeAffiliate productCodeAffiliate del affiliateproductcode
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$affiliateId,$productCode,$productCodeAffiliate) {
  	$affiliateproductcodeObj = AffiliateProductCodePeer::retrieveByPK($id);
    $affiliateproductcodeObj->setaffiliateId($affiliateId);
    $affiliateproductcodeObj->setproductCode($productCode);
    $affiliateproductcodeObj->setproductCodeAffiliate($productCodeAffiliate);    
    $affiliateproductcodeObj->save();
		return true;
  }

	/**
	* Elimina un codigo de producto por afiliado a partir de los valores de la clave.
	*
  * @param int $id id del affiliateproductcode
	*	@return boolean true si se elimino correctamente el affiliateproductcode, false sino
	*/
  function delete($id) {
  	$affiliateproductcodeObj = AffiliateProductCodePeer::retrieveByPK($id);
    $affiliateproductcodeObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un codigo de producto por afiliado.
  *
  * @param int $id id del affiliateproductcode
  * @return AffiliateProductCode Informacion del affiliateproductcode
  */
  function get($id) {
		$affiliateproductcodeObj = AffiliateProductCodePeer::retrieveByPK($id);
    return $affiliateproductcodeObj;
  }
  
  /**
  * Obtiene la informacion de un codigo de producto por afiliado a partir de un afiliado y un affiliateProductCode.
  *
  * @param int $affiliateId Id del affiliate
  * @param String $code Codigo del producto para el afliado
  * @return AffiliateProductCode Informacion del affiliateproductcode
  */
  function getByAffiliateAndCode($affiliateId,$code) {  
    $cond = new Criteria();
    $cond->add(AffiliateProductCodePeer::AFFILIATEID, $affiliateId);
    $cond->add(AffiliateProductCodePeer::PRODUCTCODEAFFILIATE, $code);
    $alls = AffiliateProductCodePeer::doSelect($cond);
    return $alls[0];  
  }

  /**
  * Obtiene todos los codigos de productos por afiliado.
	*
	*	@return array Informacion sobre todos los affiliateproductcodes
  */
	function getAll() {
		$cond = new Criteria();
		$alls = AffiliateProductCodePeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los codigos de productos por afiliado para un afiliado.
  *
  * @param int $affiliateId Id del affiliate  
  *	@return array Informacion sobre todos los affiliateproductcodes
  */
  function getAllByAffiliateId($affiliateId) {
    $cond = new Criteria();
    $cond->add(AffiliateProductCodePeer::AFFILIATEID, $affiliateId);    
    $alls = AffiliateProductCodePeer::doSelect($cond);
    return $alls;
  }  
  
  /**
  * Obtiene todos los codigos de productos por afiliado para un afiliado paginados.
  *
  * @param int $affiliateId Id del affiliate    
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los affiliateproductcodes
  */
  function getAllByAffiliateIdPaginated($affiliateId,$page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	AffiliateProductCodePeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();
    $cond->add(AffiliateProductCodePeer::AFFILIATEID, $affiliateId);        

    $pager = new PropelPager($cond,"AffiliateProductCodePeer", "doSelect",$page,$perPage);
    return $pager;
   }  

}
?>
