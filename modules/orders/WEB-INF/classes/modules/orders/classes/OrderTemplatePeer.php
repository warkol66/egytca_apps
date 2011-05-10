<?php

/**
 * Class OrderTemplatePeer
 *
 * @package OrderTemplate
 */
class OrderTemplatePeer extends BaseOrderTemplatePeer {


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
  * Crea un order template nuevo.
  *
  * @param string $name name del ordertemplate
  * @param int $userId userId del ordertemplate
  * @param int $affiliateId affiliateId del ordertemplate
  * @param float $total total del ordertemplate
  * @param int $branchId [optional] branchId del ordertemplate
  * @return int Id del template order creado
	*/
	function create($name,$userId,$affiliateId,$total,$branchId=null) {
    $ordertemplateObj = new OrderTemplate();
		$ordertemplateObj->setCreated(time());
    $ordertemplateObj->setName($name);
		$ordertemplateObj->setUserId($userId);
		$ordertemplateObj->setAffiliateId($affiliateId);
		if (!empty($branchId))
			$orderObj->setBranchId($branchId);
		$ordertemplateObj->setTotal($total);
		$ordertemplateObj->save();
		return $ordertemplateObj->getId();
	}

  /**
  * Actualiza la informacion de un order template.
  *
  * @param int $id id del ordertemplate
  * @param string $name name del ordertemplate
  * @param string $created created del ordertemplate
  * @param int $userId userId del ordertemplate
  * @param int $affiliateId affiliateId del ordertemplate
  * @param int $branchId branchId del ordertemplate
  * @param float $total total del ordertemplate
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name,$created,$userId,$affiliateId,$branchId,$total) {
  	$ordertemplateObj = OrderTemplatePeer::retrieveByPK($id);
    $ordertemplateObj->setname($name);
		$ordertemplateObj->setcreated($created);
		$ordertemplateObj->setuserId($userId);
		$ordertemplateObj->setaffiliateId($affiliateId);
		$ordertemplateObj->setbranchId($branchId);
		$ordertemplateObj->settotal($total);    
		$ordertemplateObj->save();
		return true;
  }

	/**
	* Elimina un order template a partir de los valores de la clave.
	*
  * @param int $id id del ordertemplate
	*	@return boolean true si se elimino correctamente el ordertemplate, false sino
	*/
  function delete($id) {
  	$ordertemplateObj = OrderTemplatePeer::retrieveByPK($id);
    $ordertemplateObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un order template.
  *
  * @param int $id id del ordertemplate
  * @return array Informacion del ordertemplate
  */
  function get($id) {
		$ordertemplateObj = OrderTemplatePeer::retrieveByPK($id);
    return $ordertemplateObj;
  }

  /**
  * Obtiene todos los order templates.
	*
	*	@return array Informacion sobre todos los ordertemplates
  */
	function getAll() {
		$cond = new Criteria();
		$alls = OrderTemplatePeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los order templates paginados.
	*
	*	@return array Informacion sobre los ordertemplates
  */
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	OrderTemplatePeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		require_once("lib/util/PropelPager.php");
		$cond = new Criteria();

		$pager = new PropelPager($cond,"OrderTemplatePeer", "doSelect",$page,$perPage);
		return $pager;
	 }
  
  /**
  * Obtiene todos los order templates de un afiliado.
	*
	* @param int $affiliateId Id del afiliado
	*	@return array Informacion sobre los ordertemplates
  */
	function getAllByAffiliateId($affiliateId) {
		$cond = new Criteria();
		$cond->add(OrderTemplatePeer::AFFILIATEID, $affiliateId);
		$alls = OrderTemplatePeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los order templates de un afiliado paginados.
	*
	* @param int $affiliateId Id del afiliado
	*	@return array Informacion sobre los ordertemplates
  */
	function getAllByAffiliateIdPaginated($affiliateId,$page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	OrderTemplatePeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		require_once("lib/util/PropelPager.php");
		$cond = new Criteria();
		$cond->add(OrderTemplatePeer::AFFILIATEID, $affiliateId);

		$pager = new PropelPager($cond,"OrderTemplatePeer", "doSelect",$page,$perPage);
		return $pager;
	 }
  




}
