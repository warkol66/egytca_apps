<?php

/**
 * Class OrderStateChangePeer
 *
 * @package OrderStateChange
 */
class OrderStateChangePeer extends BaseOrderStateChangePeer {

  /**
  * Crea un order state change nuevo.
  *
  * @param int $orderId orderId del orderstatechange
  * @param int $userId userId del orderstatechange
  * @param int $affiliateId affiliateId del orderstatechange
  * @param int $state state del orderstatechange
  * @param string $commnent Observaciones
  * @return OrderStateChange Objeto creado
	*/
	function create($orderId,$userId,$affiliateId,$state,$comment) {
    $orderStateChangeObj = new OrderStateChange();
    $orderStateChangeObj->setCreated(time());
		$orderStateChangeObj->setorderId($orderId);
		$orderStateChangeObj->setuserId($userId);
		$orderStateChangeObj->setaffiliateId($affiliateId);
    $orderStateChangeObj->setstate($state);
    $orderStateChangeObj->setComment($comment);
		$orderStateChangeObj->save();
		return $orderStateChangeObj;
	}

}
