<?php

/**
 * Class OrderItemPeer
 *
 * @package OrderItem
 */
class OrderItemPeer extends BaseOrderItemPeer {

  /**
  * Crea un order item nuevo.
  *
  * @param int $orderId orderId del orderitem
  * @param int $productCode productCode del orderitem
  * @param float $price price del orderitem
  * @param int $quantity quantity del orderitem
  * @return boolean true si se creo el orderitem correctamente, false sino
	*/
	function create($orderId,$productCode,$price,$quantity) {
    $orderitemObj = new OrderItem();
    $orderitemObj->setorderId($orderId);
		$orderitemObj->setProductCode($productCode);
		$orderitemObj->setprice($price);
		$orderitemObj->setquantity($quantity);
		    $orderitemObj->save();
		return $orderitemObj;
	}

  /**
  * Actualiza la informacion de un order item.
  *
  * @param int $id id del orderitem
  * @param int $orderId orderId del orderitem
  * @param int $productCode productCode del orderitem
  * @param float $price price del orderitem
  * @param int $quantity quantity del orderitem
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$orderId,$productCode,$price,$quantity) {
  	$orderitemObj = OrderItemPeer::retrieveByPK($id);
    $orderitemObj->setorderId($orderId);$orderitemObj->setProductCode($productCode);$orderitemObj->setprice($price);$orderitemObj->setquantity($quantity);    $orderitemObj->save();
		return true;
  }

	/**
	* Elimina un order item a partir de los valores de la clave.
	*
  * @param int $id id del orderitem
	*	@return boolean true si se elimino correctamente el orderitem, false sino
	*/
  function delete($id) {
  	$orderitemObj = OrderItemPeer::retrieveByPK($id);
    $orderitemObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un order item.
  *
  * @param int $id id del orderitem
  * @return array Informacion del orderitem
  */
  function get($id) {
/*		$orderitemObj = OrderItemPeer::retrieveByPK($id);
    return $orderitemObj;
*/
		$orderItem = OrderItemQuery::create()->findByPK($id);
		return $orderItem;
  }

  /**
  * Obtiene todos los order items.
	*
	*	@return array Informacion sobre todos los orderitems
  */
	function getAll() {
/*		$cond = new Criteria();
		$alls = OrderItemPeer::doSelect($cond);
		return $alls;
*/
		$orderItems = OrderItemQuery::create()->find();
		return $orderItems;
  }

  /**
  * Obtiene todos los order items por ordenes.
	*
	*	@return array Informacion sobre todos los orderitems
  */
	function getAllByOrders($ids) {
// Reemplazo por Query class mas abajo
/*		$criteria = new Criteria();
    $criteria->addJoin(OrderItemPeer::PRODUCTCODE,ProductPeer::CODE);
    $criteria->addAscendingOrderByColumn(ProductPeer::ORDERCODE);                  
		foreach($ids as $id){
			if (!isset($criterionId))
				$criterionId = $criteria->getNewCriterion(OrderItemPeer::ORDERID,$id);
			else
				$criterionId->addOr($criteria->getNewCriterion(OrderItemPeer::ORDERID,$id));		
		}
		$criteria->add($criterionId);
		$all = OrderItemPeer::doSelect($criteria);
		return $all;
*/
		$orderItems = OrderItemQuery::create()
										->innerJoinProduct()
										->useProductQuery()
											->orderByOrdercode()
										->endUse()
										->filterByOrderid($ids,Criteria::IN)
										->find();
		return $orderItems;
  }
}
