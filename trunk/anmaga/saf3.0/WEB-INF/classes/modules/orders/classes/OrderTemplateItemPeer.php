<?php

/**
 * Class OderTemplateItemPeer
 *
 * @package OderTemplateItem
 */
class OrderTemplateItemPeer extends BaseOrderTemplateItemPeer {

  /**
  * Crea un order template item nuevo.
  *
  * @param int $orderTemplateId orderTemplateId del odertemplateitem
  * @param int $productCode productCode del odertemplateitem
  * @param float $price price del odertemplateitem
  * @param int $quantity quantity del odertemplateitem
  * @return boolean true si se creo el odertemplateitem correctamente, false sino
	*/
	function create($orderTemplateId,$productCode,$price,$quantity) {
    $ordertemplateitemObj = new OrderTemplateItem();
    $ordertemplateitemObj->setorderTemplateId($orderTemplateId);
		$ordertemplateitemObj->setproductCode($productCode);
		$ordertemplateitemObj->setprice($price);
		$ordertemplateitemObj->setquantity($quantity);
		$ordertemplateitemObj->save();
		return true;
	}

  /**
  * Actualiza la informacion de un order template item.
  *
  * @param int $id id del odertemplateitem
  * @param int $orderTemplateId orderTemplateId del odertemplateitem
  * @param int $productCode productCode del odertemplateitem
  * @param float $price price del odertemplateitem
  * @param int $quantity quantity del odertemplateitem
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$orderTemplateId,$productCode,$price,$quantity) {
  	$ordertemplateitemObj = OrderTemplateItemPeer::retrieveByPK($id);
    $ordertemplateitemObj->setorderTemplateId($orderTemplateId);$ordertemplateitemObj->setproductCode($productCode);$ordertemplateitemObj->setprice($price);$ordertemplateitemObj->setquantity($quantity);    $ordertemplateitemObj->save();
		return true;
  }

	/**
	* Elimina un order template item a partir de los valores de la clave.
	*
  * @param int $id id del odertemplateitem
	*	@return boolean true si se elimino correctamente el odertemplateitem, false sino
	*/
  function delete($id) {
  	$ordertemplateitemObj = OrderTemplateItemPeer::retrieveByPK($id);
    $ordertemplateitemObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un order template item.
  *
  * @param int $id id del odertemplateitem
  * @return array Informacion del odertemplateitem
  */
  function get($id) {
		$ordertemplateitemObj = OrderTemplateItemPeer::retrieveByPK($id);
    return $ordertemplateitemObj;
  }

  /**
  * Obtiene todos los order template items.
	*
	*	@return array Informacion sobre todos los ordertemplateitems
  */
	function getAll() {
		$cond = new Criteria();
		$alls = OrderTemplateItemPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Elimina todos los order template items pertenecientes a una order template.
	*
	* @param int $orderTemplateId Id del order template
	*	@return true
  */
	function deleteByOrderTemplateId($orderTemplateId) {
		$cond = new Criteria();
		$cond->add(OrderTemplateItemPeer::ORDERTEMPLATEID, $orderTemplateId);
		OrderTemplateItemPeer::doDelete($cond);
		return true;
  }

}
